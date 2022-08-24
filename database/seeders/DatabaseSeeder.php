<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name' => 'Admin',
            'role_description' => 'Admin handles everything, add, update, delete'
        ]);

        Role::create([
            'role_name' => 'Moderator',
            'role_description' => 'Moderator checks content and flags illegal objects'
        ]);

        Role::create([
            'role_name' => 'Contributor',
            'role_description' => 'Contributor can add new articles and posts'
        ]);

        User::create([
            'name' => 'Xu Kevin',
            'email' => 'kevin.xu@benilde.edu.ph',
            'role_id' => 1,
            'password' => Hash::make('inteli7Computer!')
        ]);
    }
}
