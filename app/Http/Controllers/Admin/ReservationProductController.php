<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

use App\Models\ReservationProduct;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReservationProductController extends Controller
{
    /**
     * Barcha rezervatsiyalarni ko'rsatadi.
     */
    public function index()
    {
        $reservations = ReservationProduct::with(['product', 'user'])
            ->whereHas('user', fn($q) => $q->where('position_id', 3))
            ->latest()
            ->get();

        $users = User::where('position_id', 3)->get();
        $searchedProduct = null;

        return view('Admin.reservation.index', compact('reservations', 'users', 'searchedProduct'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'phone' => 'required|string|max:20',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'reserved_at' => 'required|date|after_or_equal:now',
            'reserved_until' => 'required|date|after:reserved_at',
            'notes' => 'nullable|string|max:1000',
        ]);

        $product = Product::findOrFail($validatedData['product_id']);

        if (!$product->status) {
            return back()->withErrors(['product_id' => 'This product is currently unavailable or already reserved.'])
                ->withInput();
        }

        DB::transaction(function () use ($validatedData, $product) {
            ReservationProduct::create([
                'user_id' => $validatedData['user_id'],
                'product_id' => $validatedData['product_id'],
                'phone' => $validatedData['phone'],
                'reserved_at' => $validatedData['reserved_at'],
                'reserved_until' => $validatedData['reserved_until'],
                'notes' => $validatedData['notes'],
            ]);

            $product->status = false;
            $product->save();
        });

        return redirect()->route('reservations')->with('success', 'Reservation created successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $searchedProduct = null;
        $users = User::where('position_id', 3)->get();

        if ($query) {
            if (is_numeric($query)) {
                $searchedProduct = Product::find($query);
                if ($searchedProduct && !$searchedProduct->status) {
                    $searchedProduct = null;
                }
            }
        }

        $reservationsQuery = ReservationProduct::with(['product', 'user'])
            ->whereHas('user', fn($q) => $q->where('position_id', 3));

        if ($query) {
            if (!is_numeric($query)) {
                $reservationsQuery->where('phone', 'like', '%' . $query . '%');
            } else {
                $reservationsQuery->where('product_id', $query)
                    ->orWhere('phone', 'like', '%' . $query . '%');
            }
        }

        $reservations = $reservationsQuery->latest()->get();

        return view('Admin.reservation.index', compact('reservations', 'searchedProduct', 'users', 'query'));
    }

    public function destroy(ReservationProduct $reservationProduct)
    {
        DB::transaction(function () use ($reservationProduct) {
            $product = $reservationProduct->product;

            // Agar mahsulot mavjud bo'lsa, statusini qayta faollashtirish
            if ($product) {
                $product->status = true; // Statusni qayta TRUE qilish
                $product->save();
            }

            // Rezervatsiyani o'chirish
            $reservationProduct->delete();
        });

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
    }
}
