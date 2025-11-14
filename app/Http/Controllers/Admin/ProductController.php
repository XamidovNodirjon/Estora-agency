<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Metro;
use App\Models\Product;
use App\Models\ProductFeatures;
use App\Models\Region;
use App\Models\SubCategory;
use App\Models\University;
use App\Services\ProductService;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
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

    public function index()
    {
        $data = $this->productService->getIndexData();
        return view('Admin.products.index', $data);
    }

    public function create()
    {
        return view('Admin.products.create', [
            'categories' => Category::with('subcategories')->get(),
            'address' => Region::with('cities')->get(),
            'product_features' => ProductFeatures::all(),
            'metros' => Metro::all(),
            'university' => University::all(),
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
        try {
            $product = $this->productService->storeProduct($data);
            return redirect()->route('products')->with('success', 'Mahsulot muvaffaqiyatli yaratildi!');
        }catch (\Exception $exception){
            return Redirect::back()->with('error', $exception->getMessage());
        }

    }

    public function edit(Request $request, $id)
    {
        try {
            $product = $this->productService->getProductById($id);
            return view('Admin.products.edit', [
                'categories' => Category::with('subcategories')->get(),
                'address' => Region::with('cities')->get(),
                'product' => $product,
                'images' => $product->images ? json_decode($product->images, true) : [],
            ]);
        }catch (\Exception $exception){
            return Redirect::back()->with('error', $exception->getMessage());
        }
    }

    public function show($id)
    {
        $product = $this->getProductById($id);
        $category = Category::with('subcategories')->get();
        $address = Region::with('cities')->get();
        return view('Admin.products.show', [
            'product' => $product,
            'category' => $category,
            'address' => $address,
        ]);
    }

    public function destroy($id)
    {
        try {
            $this->productService->destroyProduct($id);
            return redirect()->route('products')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = $this->productService->getProductById($id);
            $this->productService->updateProduct($product, $request->all());
            return redirect()->route('products')->with('success', 'Product update successfully!');
        }catch (\Exception $exception){
            return Redirect::back()->with('error', $exception->getMessage());
        }
    }

}
