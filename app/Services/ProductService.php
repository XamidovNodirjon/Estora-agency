<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\UserTrait;

class ProductService
{
    use UserTrait;

    public function storeProduct(array $data)
    {
        $user = $this->authUser();
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
}
