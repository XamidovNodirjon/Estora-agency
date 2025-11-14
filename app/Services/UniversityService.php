<?php

namespace App\Services;

use App\Models\University;
use App\Repositories\UniversityRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UniversityService
{
    protected $universityRepository;

    public function __construct(UniversityRepository $universityRepository){
        $this->universityRepository = $universityRepository;
    }

    public function createUniversity(array $data): University
    {
        return $this->universityRepository->create($data);
    }

    public function  updateUniversity(University $university, array $data): University
    {
        $university = $this->universityRepository->findById($id);

        if (!$university) {
            throw new ModelNotFoundException("University not found, ID: $id");
        }
        return $this->universityRepository->update($university, $data);

    }

    public function destroyUniversity(int $id): bool
    {
        $metro = $this->universityRepository->findById($id);

        if (!$metro) {
            throw new ModelNotFoundException("University not found, ID: $id");
        }

        return $this->universityRepository->delete($metro);
    }




}