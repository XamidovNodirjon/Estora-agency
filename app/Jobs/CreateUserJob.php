<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class CreateUserJob implements ShouldQueue
{
    use Queueable, Dispatchable,InteractsWithQueue,SerializesModels;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function handle(): void
    {
        $user = new User();
        $user->name = $this->data['name'];
        $user->position_id = $this->data['position_id'];
        $user->username = $this->data['username'];
        $user->password = Hash::make($this->data['password']);
        $user->phone = $this->data['phone'];
        $user->passport = $this->data['passport'];
        $user->jshshir = $this->data['jshshir'];
        $user->save();
    }
}
