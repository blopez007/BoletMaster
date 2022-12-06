<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ["nombre" => "Cultural"],
            ["nombre" => "Concierto"],
            ["nombre" => "Deportes"],
            ["nombre" => "Congresos"],
            ["nombre" => "Destacados"],
        ];
        $now = now()->toDateString();
        foreach ($categories as &$category) {
            $category["created_at"] = $now;
            $category["updated_at"] = $now;
        }
        Category::insert($categories);
    }
}
