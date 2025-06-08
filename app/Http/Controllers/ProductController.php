<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['user', 'category.subcategory'])->get();
        return view('products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $products = Product::with(['user', 'category.subcategory'])->get();
        $categories = Category::with('subcategories')->get();
        return view('products.create', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    public function store(Request $request)
    {

    }

}
