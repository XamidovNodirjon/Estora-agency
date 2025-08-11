<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Region;
use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function dashboard(Request $request)
    {
        try {
            $categories = Category::all();
            $subCategories = SubCategory::all();
            $regions = Region::all();
            $cities = City::all();

            $mainCategories = Category::whereIn('name', [
                trim(Constants::APARTMENT_RENTERS),
                trim(Constants::APARTMENT_SELLERS),
                'Office',
                'Room',
                'Expats',
                'Business Space',

            ])->get();

            return view('dashboard', compact('categories', 'subCategories', 'regions', 'cities', 'mainCategories', 'request'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

    public function filterProducts(Request $request)
    {
        try {
            $products = Product::query();

            if ($request->filled('ad_type')) {
                $adType = $request->input('ad_type');
                $categoryNames = [];

                if ($adType === 'sale') {
                    $categoryNames = [
                        Constants::APARTMENT_SELLERS,
                        Constants::HOME_LOT_SELLERS,
                        Constants::COMMERCIAL_BUILDING_SALESPEOPLE
                    ];
                } elseif ($adType === 'rent') {
                    $categoryNames = [
                        Constants::APARTMENT_RENTERS,
                        Constants::COMMERCIAL_BUILDING_LESSORS
                    ];
                }

                $trimmedCategoryNames = array_map('trim', $categoryNames);
                $categoryIds = Category::whereIn('name', $trimmedCategoryNames)->pluck('id')->toArray();

                if (!empty($categoryIds)) {
                    $products->whereIn('category_id', $categoryIds);
                }
            }

            if ($request->filled('category')) {
                $products->where('category_id', $request->input('category'));
            }

            if ($request->filled('region')) {
                $products->where('region_id', $request->input('region'));
            }

            if ($request->filled('rooms')) {
                if ($request->input('rooms') === '3+') {
                    $products->where('rooms', '>=', 3);
                } else {
                    $products->where('rooms', (int)$request->input('rooms'));
                }
            }

            if ($request->filled('floors')) {
                if ($request->input('floors') === '3+') {
                    $products->where('building_floor', '>=', 3);
                } else {
                    $products->where('building_floor', (int)$request->input('floors'));
                }
            }

            if ($request->filled('budget')) {
                $budgetRange = explode('-', str_replace(' ', '', $request->input('budget')));
                if (count($budgetRange) == 2) {
                    $priceFrom = (float)$budgetRange[0];
                    $priceTo = (float)$budgetRange[1];
                    $products->whereBetween('price', [$priceFrom, $priceTo]);
                } elseif (count($budgetRange) == 1 && is_numeric($budgetRange[0])) {
                    $products->where('price', '>=', (float)$budgetRange[0]);
                }
            }

            if ($request->filled('property_type')) {
                $propertyType = $request->input('property_type');
                $categoryIdsForPropertyType = [];

                if ($propertyType === 'apartment') {
                    $categoryIdsForPropertyType = Category::whereIn('name', [
                        trim(Constants::APARTMENT_SELLERS),
                        trim(Constants::APARTMENT_RENTERS)
                    ])->pluck('id')->toArray();
                } elseif ($propertyType === 'house' || $propertyType === 'land') {
                    $categoryIdsForPropertyType = Category::where('name', trim(Constants::HOME_LOT_SELLERS))->pluck('id')->toArray();
                } elseif ($propertyType === 'commercial') {
                    $categoryIdsForPropertyType = Category::whereIn('name', [
                        trim(Constants::COMMERCIAL_BUILDING_SALESPEOPLE),
                        trim(Constants::COMMERCIAL_BUILDING_LESSORS)
                    ])->pluck('id')->toArray();
                }

                if (!empty($categoryIdsForPropertyType)) {
                    $products->whereIn('category_id', $categoryIdsForPropertyType);
                }
            }

            $filteredProducts = $products->latest()->paginate(10);

            $categories = Category::all();
            $subCategories = SubCategory::all();
            $regions = Region::all();
            $cities = City::all();


            return view('filtered_products', compact('filteredProducts', 'categories', 'subCategories', 'regions', 'cities', 'request'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }


    public function showProduct(Product $product)
    {
        try {
            $relatedProducts = Product::where('region_id', $product->region_id)
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->inRandomOrder()
                ->limit(4)
                ->get();

            return view('product_details', [
                'product' => $product,
                'relatedProducts' => $relatedProducts
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }
}
