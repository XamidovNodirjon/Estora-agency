<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use App\traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use UserTrait;


    public function index()
    {
        $users = User::with('position')->get();
        $positions = Position::all();

        return view('users.index', [
            'users' => $users,
            'positions' => $positions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'position_id' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'phone' => 'required|string',
            'passport' => 'required|string',
            'jshshir' => 'required|string|max:14',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->position_id = $request->position_id;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->passport = $request->passport;
        $user->jshshir = $request->jshshir;
        $user->save();

        return redirect()->back()->with(['user successful create']);
    }

    public function edit($id)
    {
        $user = $this->getUser($id);
        $positions = Position::all();
        return view('users.edit', [
            'user' => $user,
            'positions' => $positions,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = $this->getUser($id);
        if (!$user) {
            return redirect()->back()->withErrors(['User not found']);
        }
        $rules = [
            'name' => 'sometimes|required|string',
            'position_id' => 'sometimes|required|exists:positions,id',
            'username' => 'sometimes|required|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'sometimes|required|string',
            'passport' => 'sometimes|required|string',
            'jshshir' => 'sometimes|required|string|max:14|min:14',
        ];

        $validatedData = $request->validate($rules);

        foreach ($validatedData as $key => $value) {
            if ($key === 'password' && !empty($value)) {
                $user->password = Hash::make($value);
            } else if ($key !== 'password') {
                $user->$key = $value;
            }
        }

        $user->save();

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        $user = $this->getUser($id);

        if (!$user) {
            return redirect()->back()->with(['user not found'], 404);
        }
        $user->delete();
        return redirect()->back()->with(['user successful delete'], 200);
    }
}
