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
        $clientCount = Client::count();
        $total_users = User::count();
        $total_products = Product::count();
        $total_reservations = ReservationProduct::count();

        return view('admin.dashboard.dashboard',[
            'clientCount' => $clientCount,
            'total_users' => $total_users,
            'total_products' => $total_products,
            'total_reservations' => $total_reservations,
        ]);
    }
}
