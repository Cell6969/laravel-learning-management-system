<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // seed User
        $this->call(UserTableSeeder::class);

        // seed Category
        $this->call(CategorySeeder::class);

        // seed Subcategory
        $this->call(SubCategorySeeder::class);
    }
}
