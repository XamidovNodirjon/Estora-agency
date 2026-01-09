<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use function back;
use function redirect;
use function view;

class AuthController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->position_id !== null) {
                return redirect()->intended('/users');
            } else {
                return redirect()->intended(route('get.client'));
            }
        }

        // 2) Agar user topilmasa -> clients.email dan qidiramiz
        $client = Client::where('email', $request->username)->first();

        if ($client && Hash::check($request->password, $client->password)) {
            Auth::guard('client')->login($client); // client guard ishlatamiz
            $request->session()->regenerate();

            return redirect()->intended(route('get.client'));
        }

        // 3) Agar ikkala joyda ham topilmasa
        return back()->withErrors([
            'username' => 'Login yoki parol noto‘g‘ri',
        ])->withInput($request->only('username'));
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard');
    }

    public function getRegister()
    {
        return view('Admin/Auth/Register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sure_name' => 'required|string|max:255',
            'phone' => 'required|unique:clients,phone',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|min:6|max:10',
        ]);

        $client = Client::create([
            'name' => $validated['name'],
            'sure_name' => $validated['sure_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);


         Auth::guard('client')->login($client);

        return redirect()->route('get.client');
    }

    public function redirectPath()
    {
        if (Auth::guard('admin')->check()) {
            return '/admin/users';
        }

        if (Auth::guard('client')->check()) {
            return '/client/dashboard';
        }

        return '/';
    }
}
