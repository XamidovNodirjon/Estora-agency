<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\ClientInterface;

class ClientRepository implements ClientInterface
{
    public function all()
    {
        return User::where('type', 'client')->get();
    }

    public function show($id, $withProducts = false)
    {
        $query = User::where('type', 'client');
        if ($withProducts) {
            $query->with([
                'products' => function ($q) {
                    $q->with(['category', 'region', 'city', 'productImages']);
                }
            ]);
        }
        return $query->find($id);
    }
}