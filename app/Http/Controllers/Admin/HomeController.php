<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CurrencyRate;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Region;
use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        // Redirect if already logged in
        if (auth()->guard('web')->check()) {
            $user = auth()->user();
            if ($user->type === 'super_admin' || $user->username === 'super_admin') {
                return redirect()->route('admin-dashboard');
            } elseif ($user->type === 'admin' || $user->username === 'admin') {
                return redirect()->route('products'); // Or another appropriate admin route
            } elseif ($user->type === 'manager' || $user->username === 'manager') {
                return redirect()->route('manager');
            }
        } elseif (auth()->guard('client')->check()) {
            return redirect()->route('get.client');
        }

        try {
            $categories = Category::all();
            $subCategories = SubCategory::all();
            $regions = Region::all();
            $cities = City::all();

            // Random 10 ta eng yaxshi uylar
            $bestOffers = Product::with(['region', 'city', 'category', 'productImages'])
                ->inRandomOrder()
                ->limit(10)
                ->get();

            $mainCategories = Category::whereIn('name', [
                trim(Constants::APARTMENT_RENTERS),
                trim(Constants::APARTMENT_SELLERS),
                'Office',
                'Room',
                'Expats',
                'Business Space',

            ])->get();

            // Statistics for cards
            $statistics = [
                'sale_apartments' => Product::whereHas('category', function ($query) {
                    $query->whereIn('name', [
                        trim(Constants::APARTMENT_SELLERS),
                        trim(Constants::HOME_LOT_SELLERS)
                    ]);
                })->count(),

                'rent_apartments' => Product::whereHas('category', function ($query) {
                    $query->whereIn('name', [
                        trim(Constants::APARTMENT_RENTERS),
                        trim(Constants::COMMERCIAL_BUILDING_LESSORS)
                    ]);
                })->count(),

                'roommates' => Product::whereHas('category', function ($query) {
                    $query->where('name', 'Room');
                })->count(),

                'business_space' => Product::whereHas('category', function ($query) {
                    $query->whereIn('name', [
                        trim(Constants::COMMERCIAL_BUILDING_SALESPEOPLE),
                        trim(Constants::COMMERCIAL_BUILDING_LESSORS),
                        'Business Space'
                    ]);
                })->count()
            ];
            return view('dashboard', compact('categories', 'subCategories', 'regions', 'cities', 'mainCategories', 'request', 'bestOffers', 'statistics'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

    public function filterProducts(Request $request)
    {
        try {
            $query = Product::with(['features', 'productImages', 'region', 'city', 'category', 'universities', 'metros']);

            if ($request->filled('ad_type') && $request->input('ad_type') !== 'All') {
                $adType = $request->input('ad_type');
                $categoryNames = $adType === 'sale' ? [
                    Constants::APARTMENT_SELLERS,
                    Constants::HOME_LOT_SELLERS,
                    Constants::COMMERCIAL_BUILDING_SALESPEOPLE
                ] : ($adType === 'rent' ? [
                        Constants::APARTMENT_RENTERS,
                        Constants::COMMERCIAL_BUILDING_LESSORS
                    ] : []);

                $categoryIds = !empty($categoryNames)
                    ? Category::whereIn('name', array_map('trim', $categoryNames))->pluck('id')->toArray()
                    : [];

                if (!empty($categoryIds)) {
                    $query->whereIn('category_id', $categoryIds);
                }
            }

            if ($request->filled('category')) {
                $query->where('category_id', $request->input('category'));
            }

            if ($request->filled('region') && $request->input('region') !== 'All') {
                $query->where('region_id', $request->input('region'));
            }

            if ($request->filled('city') && $request->input('city') !== 'All') {
                $query->where('city_id', $request->input('city'));
            }

            if ($request->filled('rooms') && $request->input('rooms') !== 'All') {
                $query->where(
                    'rooms',
                    $request->input('rooms') === '5+' ? '>=' : '=',
                    $request->input('rooms') === '5+' ? 5 : (int) $request->input('rooms')
                );
            }

            if ($request->filled('floors') && $request->input('floors') !== 'All') {
                $query->where(
                    'building_floor',
                    $request->input('floors') === '6+' ? '>=' : '=',
                    $request->input('floors') === '6+' ? 6 : (int) $request->input('floors')
                );
            }

            if ($request->filled('price_from') || $request->filled('price_to')) {
                $priceFrom = $request->filled('price_from') ? (float) $request->input('price_from') : 0;
                $priceTo = $request->filled('price_to') ? (float) $request->input('price_to') : PHP_FLOAT_MAX;
                $query->whereBetween('price', [$priceFrom, $priceTo]);
            }

            if ($request->filled('product_id')) {
                $query->where('id', $request->input('product_id'));
            }

            if ($request->filled('property_type') && $request->input('property_type') !== 'All') {
                $propertyType = $request->input('property_type');
                $categoryIds = $propertyType === 'apartment'
                    ? Category::whereIn('name', [trim(Constants::APARTMENT_SELLERS), trim(Constants::APARTMENT_RENTERS)])->pluck('id')->toArray()
                    : ($propertyType === 'house' || $propertyType === 'land'
                        ? Category::where('name', trim(Constants::HOME_LOT_SELLERS))->pluck('id')->toArray()
                        : ($propertyType === 'commercial'
                            ? Category::whereIn('name', [trim(Constants::COMMERCIAL_BUILDING_SALESPEOPLE), trim(Constants::COMMERCIAL_BUILDING_LESSORS)])->pluck('id')->toArray()
                            : []));

                if (!empty($categoryIds)) {
                }
            }

            // 👇 Rasm va feature larni ham birga yuklaymiz
            $filteredProducts = $query
                ->latest()
                ->paginate(10);

            $categories = Category::all();
            $subCategories = SubCategory::all();
            $regions = Region::all();
            $cities = $request->filled('region') && $request->input('region') !== 'All'
                ? City::where('region_id', $request->input('region'))->get()
                : [];

            return view('filtered_products', compact(
                'filteredProducts',
                'categories',
                'subCategories',
                'regions',
                'cities',
                'request'
            ));
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
                'relatedProducts' => $relatedProducts,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }


}
