<?php

namespace App\Repositories;

use App\Models\University;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\UniversityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UniversityRepository extends BaseRepository implements BaseRepositoryInterface
{
    public function __construct(University $model)
    {
        parent::__construct($model);
    }
}