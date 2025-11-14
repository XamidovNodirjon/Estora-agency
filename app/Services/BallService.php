<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\BallRepository;

class BallService
{
    protected $ballRepository;

    public function __construct(BallRepository $ballRepository)
    {
        $this->ballRepository = $ballRepository;
    }

    public function manageBall(User $user, int $amount, string $action): string
    {
        $this->ballRepository->getOrCreate($user);
        switch ($action) {
            case 'increment':
                $this->ballRepository->incrementAmount($user, $amount);
                return "Ball $amount has been incremented";
            case 'decrement':
                $this->ballRepository->decrementAmount($user, $amount);
                return "Ball $amount has been decremented";
            case 'set':
                if ($amount < 0 || $amount > 10) {
                    throw new \Exception("Ball $amount must be between 0 and 10");
                }
                $this->ballRepository->setAmount($user, $amount);
                return "Ball $amount has been set";
            default:
                throw new \Exception("Ball $amount does not exist");
        }
    }

}