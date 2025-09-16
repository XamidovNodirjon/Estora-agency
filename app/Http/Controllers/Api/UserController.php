<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Foydalanuvchilar ro‘yxatini olish",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Muvaffaqiyatli"
     *     )
     * )
     */
    public function index(){
        return User::all();
    }
}
