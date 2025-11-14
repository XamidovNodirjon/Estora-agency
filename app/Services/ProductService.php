<?php

namespace App\Services;

use App\Models\Metro;
use App\Models\Product;
use App\Models\University;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getIndexData(): arrayr
    {
        $products = $this->productRepository->getAllPublishedWithRelations();

        return [
            'products' => $products,
            'categories' => \App\Models\Category::with('subcategories')->get(),
            'product_features' => \App\Models\ProductFeatures::with('products')->get(),
        ];
    }

    public function storeProduct(array $data) : Product
    {
        $features = $data['features'] ?? [];
        $metor = $data['metro'] ?? [];
        $universities = $data['university'] ?? [];
        
        $productData = collect($data)->except(['features','metro','university'])->toArray();

        return DB::transaction(function() use ($productData,$features,$metor,$universities){
            $product = $this->productRepository->create($productData);

            if(!empty($features)){
                $product->features()->attach($features);
            }

            if(!empty($metor)){
                Metro::whereIn('id', $metor)->update([
                    'product_id' => $product->id
                ]);
            }

            if (!empty($universities)) {
                University::whereIn('id', $universities)->update([
                    'product_id' => $product->id,
                ]);
            }
        });
    }

    public function getProductById(int $id): Product
    {
        $product = $this->productRepository->findById($id);

        if(!$product){
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
            throw new Exception("Product not found!");
        }

        // 1. Rasmlarni Storage'dan o'chirish (Biznes mantiqining bir qismi)
        if ($product->images) {
            $images = json_decode($product->images, true);
            foreach ($images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        
        // 2. Mahsulotni o'chirish
        return $this->productRepository->delete($product);
    }
       


}