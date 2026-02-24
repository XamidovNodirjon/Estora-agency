<?php

namespace App\Services;

use App\Models\Metro;
use App\Repositories\MetroRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MetroService
{
    protected $metroRepository;

    public function __construct(MetroRepository $metroRepository)
    {
        $this->metroRepository = $metroRepository;
    }

    public function createMetro(array $data): Metro
    {
        return $this->metroRepository->create($data);
    }


    public function updateMetro(Metro $metro, array $data): Metro
    {
        $id = $metro->id;
        $metro = $this->metroRepository->findById($id);

        if (!$metro) {
            throw new ModelNotFoundException("Metro stansiyasi topilmadi, ID: $id");
        }
        return $this->metroRepository->update($metro, $data);
    }


    public function destroyMetro(int $id): bool
    {
        $metro = $this->metroRepository->findById($id);

        if (!$metro) {
            throw new ModelNotFoundException("Metro stansiyasi topilmadi, ID: $id");
        }

        return $this->metroRepository->delete($metro);
    }

}