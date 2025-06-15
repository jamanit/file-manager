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
                'role'  => 'super admin'
            ],
            [
                'name'  => 'Admin',
                'email' => 'admin@email.com',
                'role'  => 'admin'
            ],
            [
                'name'  => 'User',
                'email' => 'user@email.com',
                'role'  => 'user'
            ],
        ];

        foreach ($data as $item) {
            $user = User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name'     => $item['name'],
                    'email'    => $item['email'],
                    'password' => bcrypt('password'),
                ]
            );
            $user->assignRole($item['role']);
        }
    }
}
