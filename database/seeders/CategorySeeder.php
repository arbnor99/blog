<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'user_id' => 1,
                'name' => 'Category 1',
                'description' => Str::random(10),
            ],
            [
                'user_id' => 1,
                'name' => 'Category 2',
                'description' => Str::random(25),
            ],
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
