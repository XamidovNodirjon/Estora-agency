<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\User;

class ProductViewController extends Controller
{
    public function byUser(User $user)
    {
        $products = ProductView::with('product')
            ->where('manager_id', $user->id)
            ->get();

        return view('Admin.product_view.index', compact('user', 'products'));
    }

    public function deleteViewProduct($id)
    {
        $view = ProductView::findOrFail($id);
        $view->delete();
        return back()->with('Product view success delete');
    }
}
