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
use Exception;
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
            $data = $this->productService->getIndexData();
            $data['user'] = Auth::user();

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

    public function dashboard()
    {
        $user = Auth::user();
        $productsCount = Product::where('status', \App\Constants::STATUS_ACTIVE)->count();
        $leadsCount = \App\Models\Lisd::where('user_id', $user->id)->count();
        $ballsCount = $user->balls->amount ?? 0;

        return view('managers.dashboard', compact('user', 'productsCount', 'leadsCount', 'ballsCount'));
    }

    public function leads()
    {
        $user = Auth::user();
        $leads = \App\Models\Lisd::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('managers.leads.index', compact('leads'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['status'] = \App\Constants::STATUS_PENDING;
        $data['images'] = $request->file('images'); // Filelarni to'g'ridan-to'g'ri Service'ga uzatamiz

        try {
            $this->productService->storeProduct($data);

            return redirect()->route('manager-products')->with('success', 'Product created!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Mahsulot yaratishda xatolik: ' . $e->getMessage());
        }
    }

    public function tasks()
    {
        $user = Auth::user();
        $products = Product::with(['region', 'city', 'productImages'])
            ->where('manager_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('managers.products.tasks', compact('products'));
    }

    public function updateTaskStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:' . \App\Constants::STATUS_ACTIVE . ',' . \App\Constants::STATUS_PENDING . ',' . \App\Constants::STATUS_INACTIVE,
        ]);

        try {
            $product = Product::findOrFail($id);
            
            // Allow update only if the user is the assigned manager
            if ($product->manager_id !== Auth::id()) {
                return back()->with('error', 'Sizda bu ruxsat yo\'q!');
            }

            $product->status = $request->status;
            
            // If the status is changed, we can also remove the manager assignment so it unassigns from them (optional). 
            // In the requirement: "When a manager changes a product's status, it should be removed from their view".
            // To remove from view and reappear in admin panel as unassigned, we set manager_id to null.
            $product->manager_id = null;
            
            $product->save();

            return back()->with('success', 'Mahsulot holati yangilandi va ro\'yxatdan olib tashlandi!');
        } catch (Exception $e) {
            return back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productService->getProductById($id);
            return view('managers.products.show', compact('product'));
        } catch (Exception $e) {
            return back()->with('error', 'Mahsulot topilmadi: ' . $e->getMessage());
        }
    }
}
