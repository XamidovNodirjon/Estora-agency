<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Region;
use App\Models\SubCategory;
use App\Services\ProductService;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use function dd;
use function redirect;
use function response;
use function view;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    use ProductTrait;

    public function index()
    {
        $products = Product::with(['user'])->get();
        $categories = Category::with('subcategories')->get();

        return view('Admin.products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('Admin.products.create', [
            'categories' => Category::with('subcategories')->get(),
            'address' => Region::with('cities')->get()
        ]);
    }

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        dd($data);

        $data['images'] = $request->file('images');

        $this->productService->storeProduct($data);
        return redirect()->route('products')->with('success', 'Product created!');
    }

    public function edit(Request $request, $id)
    {
        $product = $this->getProductById($id);

        return view('products.edit', [
            'categories' => Category::with('subcategories')->get(),
            'address' => Region::with('cities')->get(),
            'product' => $product,
            'images' => $product->images ? json_decode($product->images, true) : [],
        ]);
    }

    public function show($id)
    {

    }

}
