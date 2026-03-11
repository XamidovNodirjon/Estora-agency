<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Metro;
use App\Models\ProductFeatures;
use App\Models\Region;
use App\Models\University;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{

    public function __construct(
        private ProductService $productService
    )
    {
    }

    public function index()
    {
        $client = Auth::user();
        return view('clients.index', [
            'client' => $client
        ]);

    }

    public function createProduct()
    {

        return view('clients.create_product',
            [
                'categories' => Category::has('subcategories')->with('subcategories')->get(),
                'address' => Region::with('cities')->get(),
                'product_features' => ProductFeatures::all(),
                'metros' => Metro::all(),
                'university' => University::all(),
            ]);
    }

    public function storeProduct(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth('client')->id();
        $data['status'] = \App\Constants::STATUS_PENDING; 
        $data['images'] = $request->file('images');

        try {
            $this->productService->storeProduct($data);
            return redirect()->route('get.client')->with('success', 'Mahsulot muvaffaqiyatli yaratildi!');
        } catch (\Exception $exception) {
            return Redirect::back()->withInput()->with('error', $exception->getMessage());
        }
    }

}
