<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{


    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
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
        return view('clients.create_product');
    }

    public function storeProduct(Request $request)
    {
        $data     = $request->except('features');
        $features = $request->input('features', []);

        DB::transaction(function () use ($data, $features) {
            $product = $this->productService->storeProduct($data);

            if (!empty($features)) {
                $product->features()->attach($features);
            }
        });

    return redirect()->route('get.client')->with('success', 'Mahsulot muvaffaqiyatli yaratildi!');
    }

}
