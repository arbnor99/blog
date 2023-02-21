<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = [
            [
                'user_id' => 1,
                'title' => 'Title 1',
                'description' => Str::random(25),
                'content' => Str::random(70)
            ],
            [
                'user_id' => 1,
                'title' => 'Title 2',
                'description' => Str::random(25),
                'content' => Str::random(70)
            ],
        ];

        foreach($blogs as $blog) {
            $Blog = Blog::create($blog);
            $Blog->categories()->attach([1, 2]);
        }
    }
}
