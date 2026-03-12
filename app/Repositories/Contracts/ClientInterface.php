<?php

namespace App\Repositories\Contracts;

interface ClientInterface
{
    public function all();
    public function show($id, $withProducts = false);
}