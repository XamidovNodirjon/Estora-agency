<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Region;
use App\Models\SubCategory;
use App\Repositories\Contracts\HomeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HomeRepository implements HomeRepositoryInterface
{

    /**
     * @return array
     */
    public function getBaseData(): array
    {
        return [
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'regions' => Region::all(),
            'cities' => City::all(),
        ];
    }

    /**
     * @param array $constants
     * @return array
     */
    public function getStatistics(array $constants): array
    {
        $apartmentSellers = trim($constants['APARTMENT_SELLERS']);
        $homeLotSellers = trim($constants['HOME_LOT_SELLERS']);
        $apartmentRenters = trim($constants['APARTMENT_RENTERS']);
        $commercialBuildingLessors = trim($constants['COMMERCIAL_BUILDING_LESSORS']);
        $commercialBuildingSalespeople = trim($constants['COMMERCIAL_BUILDING_SALESPEOPLE']);

        return [
            'sale_apartments' => Product::whereHas('category', function ($query) use ($apartmentSellers, $homeLotSellers) {
                $query->whereIn('name', [$apartmentSellers, $homeLotSellers]);
            })->count(),

            'rent_apartments' => Product::whereHas('category', function ($query) use ($apartmentRenters, $commercialBuildingLessors) {
                $query->whereIn('name', [$apartmentRenters, $commercialBuildingLessors]);
            })->count(),

            'roommates' => Product::whereHas('category', function ($query) {
                $query->where('name', 'Room');
            })->count(),

            'business_space' => Product::whereHas('category', function ($query) use ($commercialBuildingSalespeople, $commercialBuildingLessors) {
                $query->whereIn('name', [$commercialBuildingSalespeople, $commercialBuildingLessors, 'Business Space']);
            })->count()
        ];
    }

    /**
     * @return Collection
     */
    public function getBestOffers(): Collection
    {
        return Product::with(['region', 'city', 'category'])
            ->inRandomOrder()
            ->limit(10)
            ->get();
    }
}