<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBallRequest;
use App\Models\Balls;
use App\Models\User;
use Illuminate\Http\Request;
use function redirect;

class BallsController extends Controller
{
    public function store(StoreBallRequest $request)
    {
        $data = $request->validated();
        $ball = Balls::create($data);
        return redirect()->back();
    }

    public function updateBall(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|integer',
            'action' => 'sometimes|in:set,increment,decrement'
        ]);

        $action = $request->input('action', 'set');
        $amount = (int)$request->amount;

        if (!$user->balls) {
            $user->balls()->create(['amount' => 0]);
        }

        switch ($action) {
            case 'increment':
                $user->balls()->increment('amount', $amount);
                $message = "Ball $amount ga oshirildi";
                break;

            case 'decrement':
                $currentAmount = $user->balls->amount;
                $newAmount = max(0, $currentAmount - $amount);
                $user->balls()->update(['amount' => $newAmount]);
                $message = "Ball $amount ga kamaytirildi";
                break;

            case 'set':
            default:
                if ($amount < 0 || $amount > 10) {
                    return redirect()->back()->with('error', 'Ball 0 dan 10 gacha boʻlishi kerak!');
                }
                $user->balls()->update(['amount' => $amount]);
                $message = "Ball yangilandi: $amount";
                break;
        }

        return redirect()->back()->with('success', $message);
    }

}
