<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Comment added successfully!');
    }

    // Show the edit form for a comment
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment); // Ensure only the owner can edit the comment
        return view('comments.edit', compact('comment'));
    }

    // Update a comment
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment); // Ensure only the owner can update the comment

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update($validated);

        return redirect()->route('posts.index')->with('success', 'Comment updated successfully!');
    }

    // Delete a comment
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment); // Ensure only the owner can delete the comment

        $comment->delete();

        return redirect()->route('posts.index')->with('success', 'Comment deleted successfully!');
    }
}
