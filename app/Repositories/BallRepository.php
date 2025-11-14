<?php

namespace App\Repositories;

use App\Models\Balls;
use App\Models\User;
use App\Repositories\Contracts\BallRepositoryInterface;

class BallRepository implements BallRepositoryInterface
{

    public function getOrCreate(User $user): Balls
    {
        if (!$user->balls) {
            return $user->balls()->create(['amount' => 0]);
        }
        return $user->balls;
    }

    public function setAmount(User $user, int $amount): void
    {
        $this->getOrCreate($user)->update(['amount' => $amount]);
    }

    public function incrementAmount(User $user, int $amount): void
    {
        $this->getOrCreate($user)->increment('amount', $amount);
    }

    public function decrementAmount(User $user, int $amount): void
    {
        $ball = $this->getOrCreate($user);

        $currentAmount = $ball->amount;
        $newAmount = max(0, $currentAmount - $amount);

        $ball->update(['amount' => $newAmount]);
    }
}