<?php

namespace App\Repositories;

use App\Models\University;
use App\Repositories\Contracts\UniversityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UniversityRepository implements UniversityRepositoryInterface
{
    public function getAll(): Collection
    {
        return University::all();
    }

    public function create(array $data): University
    {
        return University::create($data);
    }

    public function findById(int $id): ?University
    {
        return University::findOrFail($id);
    }

    public function update(University $university, array $data): University
    {
        $university->update($data);
        return $university;
    }

    public function delete(University $university): bool
    {
        return $university->delete();
    }
}