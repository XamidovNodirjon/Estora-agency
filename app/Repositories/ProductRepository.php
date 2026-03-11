<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAllPublishedWithRelations()
    {
        return Product::where('status', \App\Constants::STATUS_ACTIVE)
            ->with(['user', 'category', 'subcategory', 'productImages'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        // Statusni fillable bo'lsa avtomat yangilaydi. 
        // Agar status faqat repository orqali o'zgarsin desak, quyidagicha qilsa ham bo'ladi:
        // if (isset($data['status'])) { $product->status = $data['status']; }
        
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    public function updateStatus(Product $product, string $status): bool
    {
        return $product->update(['status' => $status]);
    }

}