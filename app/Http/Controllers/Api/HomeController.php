<?php

namespace App\Http\Controllers\Api;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Region;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/dashboard",
     *     summary="Dashboard va mahsulotlarni filtrlash",
     *     tags={"Dashboard"},
     *     @OA\Parameter(name="ad_type", in="query", required=false, description="Sale yoki Rent", @OA\Schema(type="string")),
     *     @OA\Parameter(name="category", in="query", required=false, description="Kategoriya ID", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="region", in="query", required=false, description="Region ID", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="city", in="query", required=false, description="Shahar ID", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="rooms", in="query", required=false, description="Xonalar soni (masalan: 3 yoki 5+)", @OA\Schema(type="string")),
     *     @OA\Parameter(name="floors", in="query", required=false, description="Qavatlar soni (masalan: 2 yoki 6+)", @OA\Schema(type="string")),
     *     @OA\Parameter(name="price_from", in="query", required=false, description="Minimal narx", @OA\Schema(type="number")),
     *     @OA\Parameter(name="price_to", in="query", required=false, description="Maksimal narx", @OA\Schema(type="number")),
     *     @OA\Parameter(name="property_type", in="query", required=false, description="apartment, house, land, commercial", @OA\Schema(type="string")),
     *     @OA\Response(
     *         response=200,
     *         description="Muvaffaqiyatli",
     *         @OA\JsonContent(
     *             @OA\Property(property="categories", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="subCategories", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="regions", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="cities", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="mainCategories", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="products", type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="data", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="first_page_url", type="string"),
     *                 @OA\Property(property="from", type="integer"),
     *                 @OA\Property(property="last_page", type="integer"),
     *                 @OA\Property(property="last_page_url", type="string"),
     *                 @OA\Property(property="links", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="next_page_url", type="string"),
     *                 @OA\Property(property="path", type="string"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="prev_page_url", type="string"),
     *                 @OA\Property(property="to", type="integer"),
     *                 @OA\Property(property="total", type="integer")
     *             )
     *         )
     *     )
     * )
     */
    public function dashboard(Request $request)
    {
        $products = Product::query();

        // ad_type filter
        if ($request->filled('ad_type') && $request->input('ad_type') !== 'All') {
            $adType = $request->input('ad_type');
            $categoryNames = $adType === 'sale'
                ? [Constants::APARTMENT_SELLERS, Constants::HOME_LOT_SELLERS, Constants::COMMERCIAL_BUILDING_SALESPEOPLE]
                : ($adType === 'rent'
                    ? [Constants::APARTMENT_RENTERS, Constants::COMMERCIAL_BUILDING_LESSORS]
                    : []);
            $categoryIds = Category::whereIn('name', array_map('trim', $categoryNames))->pluck('id')->toArray();
            if (!empty($categoryIds)) {
                $products->whereIn('category_id', $categoryIds);
            }
        }

        // category filter - 'All' tekshirishni olib tashladim
        if ($request->filled('category') && $request->input('category') !== 'All') {
            $products->where('category_id', $request->input('category'));
        }

        // region filter - 'All' tekshirishni olib tashladim
        if ($request->filled('region') && $request->input('region') !== 'All') {
            $products->where('region_id', $request->input('region'));
        }

        // city filter - 'All' tekshirishni olib tashladim
        if ($request->filled('city') && $request->input('city') !== 'All') {
            $products->where('city_id', $request->input('city'));
        }

        // rooms filter
        if ($request->filled('rooms') && $request->input('rooms') !== 'All') {
            $rooms = $request->input('rooms');
            if ($rooms === '5+') {
                $products->where('rooms', '>=', 5);
            } else {
                $products->where('rooms', (int)$rooms);
            }
        }

        // floors filter
        if ($request->filled('floors') && $request->input('floors') !== 'All') {
            $floors = $request->input('floors');
            if ($floors === '6+') {
                $products->where('building_floor', '>=', 6);
            } else {
                $products->where('building_floor', (int)$floors);
            }
        }

        // price filter
        if ($request->filled('price_from') || $request->filled('price_to')) {
            $priceFrom = $request->filled('price_from') ? (float)$request->input('price_from') : 0;
            $priceTo = $request->filled('price_to') ? (float)$request->input('price_to') : PHP_FLOAT_MAX;
            $products->whereBetween('price', [$priceFrom, $priceTo]);
        }

        // property_type filter
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
                $products->whereIn('category_id', $categoryIds);
            }
        }

        // natijani olish
        $filteredProducts = $products->with(['features', 'category', 'region', 'city'])->latest()->paginate(10);

        return response()->json([
            'categories'     => Category::all(),
            'subCategories'  => SubCategory::all(),
            'regions'        => Region::all(),
            'cities'         => City::all(),
            'mainCategories' => Category::whereIn('name', [
                trim(Constants::APARTMENT_RENTERS),
                trim(Constants::APARTMENT_SELLERS),
                'Office',
                'Room',
                'Expats',
                'Business Space',
            ])->get(),
            'products'       => $filteredProducts,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Mahsulotlarni filtrlash",
     *     tags={"Products"},
     *     @OA\Parameter(name="ad_type", in="query", required=false, description="Sale yoki Rent", @OA\Schema(type="string")),
     *     @OA\Parameter(name="category", in="query", required=false, description="Category ID", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="region", in="query", required=false, description="Region ID", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="city", in="query", required=false, description="City ID", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="rooms", in="query", required=false, description="Xonalar soni", @OA\Schema(type="string")),
     *     @OA\Parameter(name="floors", in="query", required=false, description="Qavatlar soni", @OA\Schema(type="string")),
     *     @OA\Parameter(name="min_price", in="query", required=false, description="Minimal narx", @OA\Schema(type="number")),
     *     @OA\Parameter(name="max_price", in="query", required=false, description="Maksimal narx", @OA\Schema(type="number")),
     *     @OA\Parameter(name="property_type", in="query", required=false, description="apartment, house, land, commercial", @OA\Schema(type="string")),
     *     @OA\Response(
     *         response=200,
     *         description="Muvaffaqiyatli",
     *         @OA\JsonContent(
     *             @OA\Property(property="products", type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="data", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="first_page_url", type="string"),
     *                 @OA\Property(property="from", type="integer"),
     *                 @OA\Property(property="last_page", type="integer"),
     *                 @OA\Property(property="last_page_url", type="string"),
     *                 @OA\Property(property="links", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="next_page_url", type="string"),
     *                 @OA\Property(property="path", type="string"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="prev_page_url", type="string"),
     *                 @OA\Property(property="to", type="integer"),
     *                 @OA\Property(property="total", type="integer")
     *             )
     *         )
     *     )
     * )
     */
    public function filterProducts(Request $request)
    {
        $products = Product::query();

        // ✅ AD TYPE filter
        if ($request->filled('ad_type') && $request->input('ad_type') !== 'All') {
            $adType = strtolower($request->input('ad_type'));

            $categoryNames = $adType === 'sale'
                ? [Constants::APARTMENT_SELLERS, Constants::HOME_LOT_SELLERS, Constants::COMMERCIAL_BUILDING_SALESPEOPLE]
                : ($adType === 'rent'
                    ? [Constants::APARTMENT_RENTERS, Constants::COMMERCIAL_BUILDING_LESSORS]
                    : []);

            if (!empty($categoryNames)) {
                $categoryIds = Category::whereIn('name', array_map('trim', $categoryNames))
                    ->pluck('id')
                    ->toArray();
                if (!empty($categoryIds)) {
                    $products->whereIn('category_id', $categoryIds);
                }
            }
        }

        // ✅ CATEGORY filter
        if ($request->filled('category') && $request->input('category') !== 'All') {
            $products->where('category_id', $request->input('category'));
        }

        // ✅ REGION filter
        if ($request->filled('region') && $request->input('region') !== 'All') {
            $products->where('region_id', $request->input('region'));
        }

        // ✅ CITY filter
        if ($request->filled('city') && $request->input('city') !== 'All') {
            $products->where('city_id', $request->input('city'));
        }

        // ✅ ROOMS filter (5+ kabi qiymatlar uchun)
        if ($request->filled('rooms') && $request->input('rooms') !== 'All') {
            $rooms = $request->input('rooms');
            if ($rooms === '5+') {
                $products->where('rooms', '>=', 5);
            } else {
                $products->where('rooms', (int)$rooms);
            }
        }

        // ✅ FLOORS filter (6+ kabi qiymatlar uchun)
        if ($request->filled('floors') && $request->input('floors') !== 'All') {
            $floors = $request->input('floors');
            if ($floors === '6+') {
                $products->where('building_floor', '>=', 6);
            } else {
                $products->where('building_floor', (int)$floors);
            }
        }

        // ✅ BUDGET filter
        if ($request->filled('min_price')) {
            $products->where('price', '>=', (float)$request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $products->where('price', '<=', (float)$request->input('max_price'));
        }

        // ✅ PROPERTY TYPE filter
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
                $products->whereIn('category_id', $categoryIds);
            }
        }

        // ✅ Natijani olish
        $filteredProducts = $products->with(['features', 'category', 'region', 'city'])
            ->latest()
            ->paginate(10);

        return response()->json([
            'products' => $filteredProducts,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Bitta mahsulotni ko'rish",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mahsulot ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muvaffaqiyatli",
     *         @OA\JsonContent(
     *             @OA\Property(property="product", type="object"),
     *             @OA\Property(property="relatedProducts", type="array", @OA\Items(type="object"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mahsulot topilmadi"
     *     )
     * )
     */
    public function showProduct($id)
    {
        $product = Product::with(['features', 'category', 'region', 'city', 'user'])->find($id);
        
        if (!$product) {
            return response()->json(['message' => 'Mahsulot topilmadi'], 404);
        }

        $relatedProducts = Product::where('region_id', $product->region_id)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['features', 'category', 'region', 'city'])
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return response()->json([
            'product'         => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }


}
