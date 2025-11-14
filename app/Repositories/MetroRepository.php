<?php

namespace App\Repositories;

use App\Models\Metro;
use App\Repositories\Contracts\MetroRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MetroRepository implements MetroRepositoryInterface
{

    public function getAll(): Collection
    {
        return Metro::all();
    }

    public function create(array $data): Metro
    {
        return Metro::create($data);
    }

    public function findById(int $id): ?Metro
    {
        return Metro::find($id);
    }

    public function update(Metro $metro, array $data): Metro
    {
        $metro->update($data);
        return $metro;
    }

    public function delete(Metro $metro): bool
    {
        return $metro->delete();
    }
}