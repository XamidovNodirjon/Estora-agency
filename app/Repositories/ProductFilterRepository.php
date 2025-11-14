<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductFilterRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductFilterRepository implements ProductFilterRepositoryInterface
{

    /**
     * @param Request $request
     * @param array $constants
     * @return LengthAwarePaginator
     */
    public function getFilteredProducts(Request $request, array $constants): LengthAwarePaginator
    {
        $product = Product::query();
        $apartmentSellers = trim($constants['APARTMENT_SELLERS']);
    }
}