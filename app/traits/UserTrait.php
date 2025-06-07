<?php

namespace App\traits;

use App\Models\User;

trait UserTrait
{
    public function getUser($id)
    {
        return User::with('position')->findOrFail($id);
    }
}
