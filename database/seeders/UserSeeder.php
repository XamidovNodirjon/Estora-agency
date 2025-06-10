<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'SUPERADMIN',
            'username' => 'super_admin',
            'password' => '1234',
            'position_id' => 1,
            'phone' => '+998935273335',
            'passport' => 'AB7938253',
            'jshshir' => '50510016810045',
        ]);
    }
}
