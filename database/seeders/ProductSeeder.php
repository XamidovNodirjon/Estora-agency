<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\ProductService;
use Illuminate\Support\Facades\App;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create([
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);

        \Illuminate\Support\Facades\Auth::login($user);

        /** @var ProductService $productService */
        $productService = \Illuminate\Support\Facades\App::make(\App\Services\ProductService::class);

        for ($i = 0; $i < 50; $i++) {
            $data = [
                'name' => 'Random Product ' . \Str::random(5),
                'category_id' => rand(1, 5),
                'subcategory_id' => rand(1, 10),
                'region_id' => rand(1, 12),
                'city_id' => rand(1, 50),
                'price' => rand(10000, 100000),
                'description' => 'Random description ' . \Str::random(20),
                'phone' => '+9989' . rand(100000000, 999999999),
                'floor' => rand(1, 9),
                'building_floor' => rand(1, 15),
                'square' => rand(30, 150),
                'rooms' => rand(1, 5),
                'repair' => 'evro remont',
                'sotix' => rand(1, 10),
                'images' => [],
            ];

            $productService->storeProduct($data);
        }
    }

}
