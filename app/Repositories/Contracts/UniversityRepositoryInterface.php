<?php

namespace App\Repositories\Contracts;

use App\Models\University;
use Illuminate\Database\Eloquent\Collection;

interface UniversityRepositoryInterface
{
    public function getAll(): Collection;

    public function create(array $data): University;

    public function findById(int $id): ?University;

    public function update(University $university, array $data): University;

    public function delete(University $university): bool;
}