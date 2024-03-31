<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create(["name"=>"admin", "role"=>"admin", "email"=>"admin@xy.com","password"=>Hash::make("admin"), "first_change_password"=>false]);

        $admin->assignRole("admin");

        $user = User::create(["name"=>"user", "email"=>"user@xy.com","password"=>Hash::make("user")]);

        $user->assignRole("user");
    }
}
