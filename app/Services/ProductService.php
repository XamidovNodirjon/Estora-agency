<?php

namespace App\Services;

use App\Models\Metro;
use App\Models\Product;
use App\Models\University;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getIndexData(): array
    {
        $products = $this->productRepository->getAllPublishedWithRelations();

        return [
            'products' => $products,
            'categories' => \App\Models\Category::with('subcategories')->get(),
            'product_features' => \App\Models\ProductFeatures::with('products')->get(),
            'product_images' => \App\Models\ProductImage::with('product')->get(),
        ];
    }

    public function getProductCreationData(): array
    {
        return [
            'categories' => \App\Models\Category::with('subcategories')->get(),
            'address' => \App\Models\Region::with('cities')->get(),
            'product_features' => \App\Models\ProductFeatures::all(),
            'metros' => \App\Models\Metro::all(),
            'university' => \App\Models\University::all(),
            'product' => new Product(),
        ];
    }



    public function storeProduct(array $data): Product
    {
        $images = $data['images'] ?? [];
        $features = $data['features'] ?? [];
        $metros = $data['metro'] ?? [];
        $universities = $data['university'] ?? [];

        $productData = collect($data)
            ->only((new Product)->getFillable())
            ->toArray();

        return DB::transaction(function () use ($productData, $images, $features, $metros, $universities) {

            $product = $this->productRepository->create($productData);

            foreach ($images as $image) {
                $path = $this->storeImage($image);

                $product->productImages()->create([
                    'path' => $path,
                ]);
            }

            if (!empty($features)) {
                $product->features()->sync($features);
            }

            if (!empty($metros)) {
                Metro::whereIn('id', $metros)
                    ->update(['product_id' => $product->id]);
            }

            if (!empty($universities)) {
                University::whereIn('id', $universities)
                    ->update(['product_id' => $product->id]);
            }

            return $product;
        });
    }

    private function storeImage(mixed $image): string
    {
        if ($image instanceof UploadedFile) {
            return $image->store('products', 'public');
        }

        if (is_array($image)) {
            return $image['path'] ?? reset($image);
        }

        return (string) $image;
    }


    public function getProductById(int $id): Product
    {
        $product = $this->productRepository->findById($id);

        if (!$product) {
            throw new Exception('Product not found');
        }

        return $product;
    }

    public function updateProduct(Product $product, array $data): Product
    {
        return $this->productRepository->update($product, $data);
    }

    public function destroyProduct(int $id): bool
    {
        $product = $this->productRepository->findById($id);

        if (!$product) {
            throw new \Exception("Product not found!");
        }

        return DB::transaction(function () use ($product) {
            // 1. Rasmlarni Storage'dan (fayllarni) o'chirish
            // Eslatib o'taman: productImages - bu sizning yangi relationshipingiz
            foreach ($product->productImages as $image) {
                if (Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
            }

            // 2. Bog'langan ma'lumotlarni tozalash
            // Metro va University product_id sini null qilish (agar kerak bo'lsa)
            // Agar migratsiyada onDelete('cascade') ishlatmagan bo'lsangiz:
            $product->productImages()->delete(); // Bazadagi rasm qatorlarini o'chirish
            $product->features()->detach();     // Pivot table (features) bog'liqligini uzish

            // 3. Mahsulotni o'chirish
            return $this->productRepository->delete($product);
        });
    }

    public function revealPhoneLogic(Product $product, int $managerId): bool
    {
        // 1. Agar avval ko'rgan bo'lsa, hech narsa qilmaymiz (ball yechilmaydi)
        $alreadyViewed = \App\Models\ProductView::where('manager_id', $managerId)
            ->where('product_id', $product->id)
            ->exists();

        if ($alreadyViewed) {
            return true;
        }

        // 2. Ball yetarli ekanligini tekshirish
        $managerBall = \App\Models\Balls::where('user_id', $managerId)->first();

        if (!$managerBall || $managerBall->amount < 1) {
            return false;
        }

        // Transaction to ensure atomicity
        DB::transaction(function () use ($managerBall, $managerId, $product) {
            // 3. Ballni kamaytirish
            $managerBall->decrement('amount', 1);

            // 4. Ko'rilganlar tarixiga qo'shish
            \App\Models\ProductView::create([
                'manager_id' => $managerId,
                'product_id' => $product->id,
            ]);
        });

        return true;
    }
}
