<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        $roleMap = [
//            1 => 'superAdmin',
            2 => 'admin',
            3 => 'manager',
        ];

        $userRole = $roleMap[$user->position_id] ?? null;

        if (in_array($userRole, $roles)) {
            switch ($userRole->position_id) {
//                case 1:
//                    return redirect('');
                case 2:
                    return redirect('users');
                case 3:
                    return redirect('user-edit');
                default:
                    return redirect()->back();
            }
        }
        return $next($request);
    }
}
