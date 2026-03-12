<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use App\Models\ReservationProduct;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_users = User::count();
        $clientCount = User::where('type', 'client')->count();
        $total_products = Product::count();
        $total_reservations = ReservationProduct::count();

        return view('Admin.dashboard.dashboard',[
            'total_users' => $total_users,
            'clientCount' => $clientCount,
            'total_products' => $total_products,
            'total_reservations' => $total_reservations,
        ]);
    }
}
