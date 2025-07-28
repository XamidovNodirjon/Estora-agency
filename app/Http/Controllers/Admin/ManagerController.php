<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balls;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\Region;
use App\Services\ProductService;
use App\Traits\ProductTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function back;
use function redirect;
use function view;

class ManagerController extends Controller
{
    use ProductTrait;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = Product::where('status', true)->with(['user', 'category', 'subcategory'])->get();
        $categories = Category::with('subcategories')->get();
        $user = Auth::user();

        return view('managers.products.index', [
            'products' => $products,
            'categories' => $categories,
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('managers.products.create', [
            'categories' => Category::with('subcategories')->get(),
            'address' => Region::with('cities')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['images'] = $request->file('images');

        $this->productService->storeProduct($data);

        return redirect()->route('manager')->with('success', 'Product created!');
    }

    public function revealPhone(Product $product)
    {
        $manager = Auth::user();
        $alreadySeen = ProductView::where('manager_id', $manager->id)
            ->where('product_id', $product->id)
            ->exists();

        if (!$alreadySeen) {
            $ball = Balls::where('user_id', $manager->id)->first();
            if (!$ball || $ball->amount < 1) {
                return back()->with('error', 'Sizda yetarli ball mavjud emas.');
            }

            $ball->decrement('amount');

            ProductView::create([
                'manager_id' => $manager->id,
                'product_id' => $product->id,
            ]);
        }

        return back()->with('success', 'Telefon raqam ko‘rsatildi.');
    }

    public function seenProducts()
    {
        $manager = Auth::user();

        $products = Product::whereIn('id', function ($q) use ($manager) {
            $q->select('product_id')
                ->from('product_views')
                ->where('manager_id', $manager->id);
        })->get();

        return view('managers.products.seen', compact('products'));
    }

    public function show($id)
    {
        $product = $this->getProductById($id);
        $category = Category::with('subcategories')->get();
        $address = Region::with('cities')->get();
        return view('managers.products.show', [
            'product' => $product,
            'category' => $category,
            'address' => $address,
        ]);
    }

}
