<?php

namespace Database\Seeders;

use App\Models\User;

use App\Services\ProductService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            SubCategorySeeder::class,
            UserSeeder::class,
            // ProductSeeder::class,
        ]);
    }
}
