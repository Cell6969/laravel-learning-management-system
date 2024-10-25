<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        User::query()->create([
            "name" => "Admin",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin12345"),
            "role" => "admin",
            "status" => "1"
        ]);

        // instructor
        User::query()->create([
            "name" => "Instructor",
            "username" => "instructor",
            "email" => "instructor@gmail.com",
            "password" => Hash::make("instructor12345"),
            "role" => "instructor",
            "status" => "1"
        ]);

        // user
        User::query()->create([
            "name" => "User",
            "username" => "user",
            "email" => "user@gmail.com",
            "password" => Hash::make("user12345"),
            "role" => "user",
            "status" => "1"
        ]);
    }
}
