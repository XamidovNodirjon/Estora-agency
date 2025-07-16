<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Product;
use App\Models\ReservationProduct;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationProductController extends Controller
{
    public function index()
    {
        $reservations = ReservationProduct::with(['product', 'user'])
            ->whereHas('user', fn($q) => $q->where('position_id', 3))
            ->get();

        return view('Admin.reservation.index', [
            'reservations' => $reservations
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        ReservationProduct::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'phone' => $request->phone,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('reservations')->with('success', 'Reservation created.');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);

        $query = $request->search;

        $searchedProduct = Product::where('id', $query)
            ->orWhereHas('reservations', fn($q) => $q->where('phone', $query))
            ->first();

        $reservations = ReservationProduct::with(['product', 'user'])
            ->whereHas('user', fn($q) => $q->where('position_id', 3))
            ->get();

        $users = User::where('position_id', 3)->get();

        return view('Admin.reservation.index', [
            'reservations' => $reservations,
            'searchedProduct' => $searchedProduct,
            'query' => $query,
            'users' => $users
        ]);
    }


}
