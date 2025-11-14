<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductFilterRepositoryInterface
{
    public function getFilteredProducts(Request $request, array $constants): LengthAwarePaginator;
}