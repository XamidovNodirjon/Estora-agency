<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (!filter_var($request->username, FILTER_VALIDATE_EMAIL) && is_numeric($request->username)) {
            $loginField = 'phone';
        }

        $credentials = [
            $loginField => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended($this->redirectPath());
        }

        return back()->withErrors([
            'username' => 'Login yoki parol noto‘g‘ri',
        ])->withInput($request->only('username'));
    }

    protected function redirectPath()
    {
        $user = Auth::user();

        switch ($user->position_id) {
            case 1:
                return '/users';
            case 2:
                return '/products';
            case 3:
                return '/manager';
            default:
                return '/';
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard');
    }

}
