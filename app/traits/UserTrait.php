<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    public function authUser()
    {
        $user = Auth::user();
    }


    public function getUser($id)
    {
        return User::with('position')->findOrFail($id);
    }
}
