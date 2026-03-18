<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
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
        if (Auth::guard('web')->check() || Auth::guard('client')->check()) {
            return redirect()->route('dashboard');
        }
        return view('Admin.Auth.login');
    }

    public function login(Request $request)
    {
        $isEmployee = $request->input('is_employee', '0') === '1';

        if ($isEmployee) {
            // Xodim login (Username orqali)
            $credentials = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('username', $request->username)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();

                if ($user->username == 'manager' || $user->type == 'manager') {
                    return redirect()->intended('/manager');
                } elseif ($user->username == 'admin' || $user->type == 'admin') {
                    return redirect()->intended('/admin');
                } elseif ($user->username == 'super_admin' || $user->type == 'super_admin') {
                    return redirect()->intended('/admin-dashboard');
                }

                return redirect()->intended('/admin');
            }

            return back()->withErrors([
                'username' => 'Foydalanuvchi nomi yoki parol noto‘g‘ri',
            ])->withInput($request->only('username', 'is_employee'));

        } else {
            // Mijoz login (Email orqali)
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $client = User::where('email', $request->email)->first();

            if ($client && Hash::check($request->password, $client->password)) {
                Auth::guard('client')->login($client);
                $request->session()->regenerate();

                return redirect()->intended(route('get.client'));
            }

            return back()->withErrors([
                'email' => 'Email yoki parol noto‘g‘ri',
            ])->withInput($request->only('email', 'is_employee'));
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('client')->check()) {
            Auth::guard('client')->logout();
        } else {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard');
    }

    public function getRegister()
    {
        if (Auth::guard('web')->check() || Auth::guard('client')->check()) {
            return redirect()->route('dashboard');
        }
        return view('Admin/Auth/Register');
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|unique:users,phone',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:10',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
            ]);

            Auth::guard('client')->login($user);

            return redirect()->route('get.client');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log the actual error for debugging
            \Illuminate\Support\Facades\Log::error('Registration error: ' . $e->getMessage());

            return back()->withErrors([
                'error' => 'Ro‘yxatdan o‘tishda kutilmagan xatolik yuz berdi. Iltimos, keyinroq qayta urinib ko‘ring.',
            ])->withInput();
        }
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
