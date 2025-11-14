<?php

namespace App\Repositories\Contracts;

use App\Models\Balls;
use App\Models\User;

interface BallRepositoryInterface
{
    public function getOrCreate(User $user): Balls;

    public function setAmount(User $user, int $amount): void;

    public function incrementAmount(User $user, int $amount): void;

    public function decrementAmount(User $user, int $amount): void;

}