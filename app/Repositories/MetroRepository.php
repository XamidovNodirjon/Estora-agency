<?php

namespace App\Repositories;

use App\Models\Metro;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\MetroRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;

class MetroRepository extends BaseRepository implements MetroRepositoryInterface
{
    public function __construct(Metro $model)
    {
        parent::__construct($model);
    }

}