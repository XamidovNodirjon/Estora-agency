<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'dev' => 'dev',
            'super_admin' => 'superAdmin',
            'admin' => 'admin',
            'manager' => 'manager',
        ];

        $counter = 1;
        foreach ($roles as $username => $roleName) {
            User::updateOrCreate(
                ['username' => $username],
                [
                    'name' => strtoupper(str_replace('_', ' ', $username)),
                    'password' => Hash::make('1234'),
                    'phone' => '+998935273335' . $counter,
                    'passport' => 'AB7938253' . $counter,
                    'jshshir' => '50510016810045' . $counter,
                    'role' => $roleName,
                ]
            );
            $counter++;
        }
    }
}
