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
        $products = Product::where('status', true)->with(['user', 'category', 'subcategory'])->get();
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
        try {
            $data = $request->all();
            $data['images'] = $request->file('images');

            $this->productService->storeProduct($data);

            return redirect()->route('products')->with('success', 'Product created!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $product = $this->getProductById($id);

        return view('Admin.products.edit', [
            'categories' => Category::with('subcategories')->get(),
            'address' => Region::with('cities')->get(),
            'product' => $product,
            'images' => $product->images ? json_decode($product->images, true) : [],
        ]);
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
            $product = Product::find($id);

            if (!$product) {
                return redirect()->route('products')->with('error', 'Product not found!');
            }

            if ($product->images) {
                $images = json_decode($product->images, true);
                foreach ($images as $imagePath) {

                    \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
                }
            }
            $product->delete();

            return redirect()->route('products')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

}
