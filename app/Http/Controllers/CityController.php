<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCities($regionId)
    {
        $cities = City::where('region_id', $regionId)->get(['id', 'name']);

        return response()->json($cities);
    }

}
