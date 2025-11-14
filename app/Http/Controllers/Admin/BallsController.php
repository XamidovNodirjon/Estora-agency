<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBallRequest;
use App\Models\Balls;
use App\Models\User;
use App\Services\BallService;
use Illuminate\Http\Request;
use function redirect;

class BallsController extends Controller
{
    protected $ballService;

    public function __construct(BallService $ballService)
    {
        $this->ballService = $ballService;
    }

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

        try {
            $message = $this->ballService->manageBall($user, $amount, $action);

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
