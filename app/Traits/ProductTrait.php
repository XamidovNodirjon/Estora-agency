<?php

namespace App\Traits;

use App\Models\Product;
use http\Env\Request;

trait ProductTrait
{
    public function getProductById($id)
    {
        return $product = Product::findOrFail($id);
    }
}
