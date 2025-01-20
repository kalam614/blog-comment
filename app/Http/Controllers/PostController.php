<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // If a category filter is applied
        $categoryId = $request->get('category_id');
        $posts = Post::when($categoryId, function ($query) use ($categoryId) {
            return $query->where('category_id', $categoryId);
        })->orderBy('created_at', 'DESC')->get();

        // Get all categories to display in the filter dropdown
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }
    public function create()
    {
        $categories = Category::all();  // Fetch all categories
        return view('posts.create', compact('categories'));
    }

    // Store a new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::id();  // Store the user ID who created the post
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Show the edit form for a post
    public function edit(Post $post)
    {
        $this->authorize('update', $post); // Check if the authenticated user is the owner
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Update a post
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);  // Ensure only the owner can update the post

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);  // Ensure only the owner can delete the post

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
