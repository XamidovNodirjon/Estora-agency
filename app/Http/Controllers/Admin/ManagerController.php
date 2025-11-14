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

    public function index(Request $request)
    {
        try {
            $data = $this->productService->getManagerIndexData($request);

            return view('managers.products.index', $data);

        } catch (\Exception $e) {
            return back()->with('error', 'Ro‘yxatni yuklashda xatolik: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $data = $this->productService->getProductCreationData();

            return view('managers.products.create', $data);
        } catch (Exception $e) {
            return back()->with('error', 'Formani yuklashda xatolik: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['images'] = $request->file('images'); // Filelarni to'g'ridan-to'g'ri Service'ga uzatamiz

        try {
            $this->productService->storeProduct($data);

            return redirect()->route('manager')->with('success', 'Product created!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Mahsulot yaratishda xatolik: ' . $e->getMessage());
        }
    }

    public function revealPhone(Product $product)
    {
        $managerId = Auth::id();

        try {
            $this->productService->revealPhoneLogic($product, $managerId);

            return back()->with('success', 'Telefon raqam ko‘rsatildi.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
