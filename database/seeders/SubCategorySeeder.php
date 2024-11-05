<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect([
            "IT & Software" => [
                "Web Development",
                "Mobile Development",
                "Game Development",
            ],
            "Business" => [
                "Business Strategy",
                "Social Network"
            ],
            "Personal Development" => [
                "Leaderships",
                "Personal Branding"
            ],
            "Design" => [
                "Graphic Design",
                "UI / UX",
            ],
            "Finance & Accounting" => [
                "Accounting",
                "Finance"
            ]
        ]);

        $data->each(function ($subCategories, $category) {
            $category_id = Category::query()->where('category_name', '=', $category)->first()->id;

            foreach ($subCategories as $subCategory) {
                SubCategory::query()->create([
                    "category_id" => $category_id,
                    "subcategory_name" => $subCategory,
                    "subcategory_slug" => strtolower(str_replace(' ', '-', $subCategory)),
                ]);
            }
        });
    }
}
