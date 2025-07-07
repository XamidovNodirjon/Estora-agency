<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Region;
use App\Models\SubCategory;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use ProductTrait;

    public function index()
    {
        $products = Product::with(['user'])->get();
        $categories = Category::with('subcategories')->get();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }


    public function create()
    {
        return view('products.create', [
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
        $user = Auth::user();
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->region_id = $request->region_id;
        $product->city_id = $request->city_id;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->phone = $request->phone;
        $product->floor = $request->floor;
        $product->building_floor = $request->building_floor;
        $product->square = $request->square;
        $product->rooms = $request->rooms;
        $product->repair = $request->repair;
        $product->sotix = $request->sotix;
        $product->user_id = $user->id;
        $product->long_id = $request->long_id;
        $product->latitude_id = $request->latitude_id;

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('home', 'public');
                $imagePaths[] = $path;
            }
        }
        $product->images = json_encode($imagePaths);

        $product->save();

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
