<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    use UserTrait;

    public function storeProduct(array $data)
    {
        $user = Auth::user();
        $product = new Product();
        $product->name = $data['name'];
        $product->category_id = $data['category_id'];
        $product->subcategory_id = $data['subcategory_id'];
        $product->region_id = $data['region_id'];
        $product->city_id = $data['city_id'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->phone = $data['phone'];
        $product->floor = $data['floor'];
        $product->building_floor = $data['building_floor'];
        $product->square = $data['square'];
        $product->rooms = $data['rooms'];
        $product->repair = $data['repair'];
        $product->sotix = $data['sotix'];
        $product->user_id = $user->id;

        $product->exchange = $data['exchange'] ?? false;
        $product->pay_in_installments = $data['pay_in_installments'] ?? false;
        $product->credit = $data['credit'] ?? false;

        $imagePaths = [];
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $image->store('home', 'public');
                $imagePaths[] = $path;
            }
        }

        $product->images = json_encode($imagePaths);
        $product->save();

        return $product;
    }


    public function updateProduct(Product $product, array $data)
    {
        $product->name = $data['name'] ?? $product->name;
        $product->category_id = $data['category_id'] ?? $product->category_id;
        $product->subcategory_id = $data['subcategory_id'] ?? $product->subcategory_id;
        $product->region_id = $data['region_id'] ?? $product->region_id;
        $product->city_id = $data['city_id'] ?? $product->city_id;
        $product->price = $data['price'] ?? $product->price;
        $product->description = $data['description'] ?? $product->description;
        $product->phone = $data['phone'] ?? $product->phone;
        $product->floor = $data['floor'] ?? $product->floor;
        $product->building_floor = $data['building_floor'] ?? $product->building_floor;
        $product->square = $data['square'] ?? $product->square;
        $product->rooms = $data['rooms'] ?? $product->rooms;
        $product->repair = $data['repair'] ?? $product->repair;
        $product->sotix = $data['sotix'] ?? $product->sotix;
        $product->user_id = auth()->id();
        $product->exchange = $data['exchange'] ?? $product->exchange;
        $product->pay_in_installments = $data['pay_in_installments'] ?? $product->pay_in_installments;
        $product->credit = $data['credit'] ?? $product->credit;

        $existingImages = !empty($product->images) ? json_decode($product->images, true) : [];

        $removeImages = [];
        if (!empty($data['remove_images'])) {
            $removeImages = is_string($data['remove_images'])
                ? json_decode($data['remove_images'], true)
                : (is_array($data['remove_images']) ? $data['remove_images'] : []);
        }

        if (!empty($removeImages)) {
            foreach ($removeImages as $index) {
                if (isset($existingImages[$index])) {
                    Storage::disk('public')->delete($existingImages[$index]);
                    unset($existingImages[$index]);
                }
            }
            $existingImages = array_values($existingImages);
        }

        if (isset($data['images']) && is_array($data['images']) && !empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $image->store('home', 'public');
                $existingImages[] = $path;
            }
        }

        $product->images = json_encode($existingImages);

        $product->save();
        return $product;
    }

}
