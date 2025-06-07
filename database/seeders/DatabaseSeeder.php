<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PositionSeeder::class,
        ]);
    }
}
