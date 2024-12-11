<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Time;

class UserSeeder extends Seeder
{

    public function run(): void
    {
       $users = [
       [
            'name' => 'admin',
            'email'=> 'admin@admin.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'user',
            'email'=> 'user@user.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]
       ];

       User::insert($users);
    }
}
