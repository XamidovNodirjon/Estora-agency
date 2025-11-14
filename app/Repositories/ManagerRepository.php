<?php

namespace App\Repositories;

use App\Models\Balls;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\Region;
use App\Repositories\Contracts\ManagerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as BaseCollection;

class ManagerRepository implements ManagerRepositoryInterface
{

    public function getFilteredProductsForManager(Request $request): BaseCollection
    {
        $query = Product::where('status', true)
            ->with(['user', 'category', 'subcategory', 'region', 'city']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                if (is_numeric($searchTerm)) {
                    $q->where('id', $searchTerm);
                }
                $q->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        return $query->select([
            'id', 'name', 'price', 'phone', 'square', 'rooms', 'floor', 'sotix', 'building_floor',
            'repair', 'exchange', 'pay_in_installments', 'credit', 'status', 'user_id',
            'category_id', 'subcategory_id', 'region_id', 'city_id', 'created_at', 'images'
        ])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getCreationFormData(): array
    {
        return [
            'categories' => Category::with('subcategories')->get(),
            'address' => Region::with('cities')->get()
        ];
    }

    public function recordPhoneView(int $managerId, Product $product): bool
    {
        $alreadySeen = ProductView::where('manager_id', $managerId)
            ->where('product_id', $product->id)
            ->exists();

        if ($alreadySeen) {
            return true; // Already seen, no further action needed
        }

        $ball = Balls::where('user_id', $managerId)->first();

        if (!$ball || $ball->amount < 1) {
            throw new \Exception('Sizda yetarli ball mavjud emas.');
        }

        $ball->decrement('amount');

        ProductView::create([
            'manager_id' => $managerId,
            'product_id' => $product->id,
        ]);

        return true;
    }

    public function getSeenProducts(int $managerId): Collection
    {
        return Product::whereIn('id', function ($q) use ($managerId) {
            $q->select('product_id')
                ->from('product_views')
                ->where('manager_id', $managerId);
        })->get();
    }

    public function getProductByIdWithRelations(int $id): ?Product
    {
        return Product::with(['category.subcategories', 'region.cities'])
            ->find($id);
    }
}