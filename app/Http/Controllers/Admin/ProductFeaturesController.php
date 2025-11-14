<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Metro;
use App\Models\ProductFeatures;
use App\Models\University;
use Illuminate\Http\Request;

class ProductFeaturesController extends Controller
{
    public function index()
    {
        $features = ProductFeatures::all();
        $metros = Metro::all();
        $universities = University::all();

        return view('Admin.product_features.index', [
            'features' => $features,
            'metros' => $metros,
            'universities' => $universities // Blade'ga ham 'universities' (ko'plik) nomi bilan yuboring
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'feature_name' => 'required|string|max:255',
        ]);

        ProductFeatures::create(['feature_name' => $validatedData['feature_name']]);

        return redirect()->route('product.features')->with('success', 'Feature created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $feature = ProductFeatures::findOrFail($id);
        $feature->update(['feature_name' => $validatedData['name']]);

        return redirect()->route('product.features')->with('success', 'Feature updated successfully.');
    }

    public function destroy($id)
    {
        $feature = ProductFeatures::findOrFail($id);
        $feature->delete();

        return redirect()->route('product.features')->with('success', 'Feature deleted successfully.');
    }

}
