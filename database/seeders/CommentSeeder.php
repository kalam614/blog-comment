<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // Creating 10 comments for each post
        $posts = Post::all();

        foreach ($posts as $post) {
            for ($i = 1; $i <= 3; $i++) {
                Comment::create([
                    'content' => 'This is comment number ' . $i . ' on post ' . $post->title,
                    'post_id' => $post->id,
                    'user_id' => rand(1, 5), // Random user for each comment
                ]);
            }
        }
    }
}
