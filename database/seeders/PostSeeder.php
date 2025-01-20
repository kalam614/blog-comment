<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Creating 10 posts with a random user
        for ($i = 1; $i <= 10; $i++) {
            Post::create([
                'title' => 'Post Title ' . $i,
                'description' => 'This is the description for Post ' . $i,
                'category_id' => rand(1, 5), 
                'user_id' => rand(1, 5), // Assign a random user to the post
            ]);
        }
    }
}
