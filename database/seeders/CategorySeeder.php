<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            "IT & Software",
            "Business",
            "Personal Development",
            "Design",
            "Finance & Accounting"
        ];
        
        for ($i = 0; $i < count($category); $i++) {
            Category::query()->create([
                "category_name" => $category[$i],
                "category_slug" => strtolower(str_replace(' ', '-', $category[$i])),
                "image" => "upload/no_image.png"
            ]);
        }

    }
}
