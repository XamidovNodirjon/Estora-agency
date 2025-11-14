<?php

namespace App\Repositories\Contracts;

use App\Models\Metro;
use Illuminate\Database\Eloquent\Collection;

interface MetroRepositoryInterface
{
    public function getAll(): Collection;

    public function create(array $data): Metro;

    public function findById(int $id): ?Metro;

    public function update(Metro $metro, array $data): Metro;

    public function delete(Metro $metro): bool;

}