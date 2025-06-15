<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            [
                'name'  => 'Superadmin',
                'email' => 'superadmin@email.com',
            ],
            [
                'name'  => 'Admin',
                'email' => 'admin@email.com',
            ],
            [
                'name'  => 'User',
                'email' => 'user@email.com',
            ],
        ];

        foreach ($data as $item) {
            User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name'     => $item['name'],
                    'email'    => $item['email'],
                    'password' => bcrypt('password'),
                ]
            );
        }
    }
}
