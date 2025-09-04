<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductFeatures;
use App\Models\Region;
use App\Models\SubCategory;
use App\Services\ProductService;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $product_features = \App\Models\ProductFeatures::with('products')->get();
        $categories = Category::with('subcategories')->get();
    

        return view('Admin.products.index', [
            'products' => $products,
            'categories' => $categories,
            'product_features' => $product_features,
        ]);
    }

    public function create()
    {
        $product_features = ProductFeatures::all();

        return view('Admin.products.create', [
            'categories' => Category::with('subcategories')->get(),
            'address' => Region::with('cities')->get(),
            'product_features' => $product_features
        ]);
    }

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    public function store(Request $request)
    {
        $data     = $request->except('features');
        $features = $request->input('features', []);

        DB::transaction(function () use ($data, $features) {
            $product = $this->productService->storeProduct($data);

            if (!empty($features)) {
                $product->features()->attach($features);
            }
        });

        return redirect()->route('products')->with('success', 'Mahsulot muvaffaqiyatli yaratildi!');
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
    public function update(Request $request, $id)
    {
        $product = $this->getProductById($id);
        try {
            $newProduct = $this->productService->updateProduct($product, $request->all());
            return redirect()->route('products')->with(['messages' => 'Product updated successfully!']);
        }
        catch (\Exception $e) {
            return redirect()->route('products')->with('errors', 'Xatolik: ' . $e->getMessage());
        }
    }

}
