<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    use UserTrait;

    public function index()
    {
        $user = Auth::user();
        $products = $user->products()->with('user')->get();
        $categories = Category::with('subcategories')->get();

        return view('managers.products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
