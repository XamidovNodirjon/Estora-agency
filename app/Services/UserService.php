<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserService
{
    public function userStore(array $data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->position_id = $data['position_id'];
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->phone = $data['phone'];
        $user->passport = $data['passport'];
        $user->jshshir = $data['jshshir'];
        $user->save();

        return $user;
    }
}
