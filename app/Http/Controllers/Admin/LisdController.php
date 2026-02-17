<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lisd;
use App\Models\User;
use Illuminate\Http\Request;

class LisdController extends Controller
{
    public function index(Request $request)
    {
        $query = Lisd::with('user')->latest();

        if ($request->has('filter_user_id') && $request->filter_user_id != '') {
            if ($request->filter_user_id == 'unassigned') {
                $query->whereNull('user_id');
            } else {
                $query->where('user_id', $request->filter_user_id);
            }
        }

        $lisds = $query->paginate(10);
        $users = User::all();
        return view('admin.lisds.index', compact('lisds', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.lisds.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Lisd::create($request->all());

        return redirect()->route('lisds.index')
            ->with('success', 'Lead created successfully.');
    }

    public function edit(Lisd $lisd)
    {
        $users = User::all();
        return view('admin.lisds.edit', compact('lisd', 'users'));
    }

    public function update(Request $request, Lisd $lisd)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $lisd->update($request->all());

        return redirect()->route('lisds.index')
            ->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lisd $lisd)
    {
        $lisd->delete();

        return redirect()->route('lisds.index')
            ->with('success', 'Lead deleted successfully.');
    }
}
