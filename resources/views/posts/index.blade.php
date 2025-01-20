@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4 d-flex justify-content-between align-items-center">
            Blog Posts
            <!-- Right-aligned Create New Post button -->
            <span> <a href="{{ route('posts.create') }}" class="btn btn-success ml-auto">Create New Post</a>
                <a href="{{ route('categories.create') }}" class="btn btn-primary ml-auto">Create Category</a></span>

        </h2>

        <!-- Category Filter -->
        <form method="GET" action="{{ route('posts.index') }}">
            <div class="form-group mb-4">
                <label for="category">Filter by Category:</label>
                <select name="category_id" id="category" class="form-control" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>


        @if ($posts->isEmpty())
            <div class="alert alert-info">
                <strong>No posts available in this category.</strong>
            </div>
        @else
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">{{ $post->title }}</h3>
                                <p class="card-text">{{ Str::limit($post->description, 150) }}</p>
                                <p><strong>Category:</strong> {{ $post->category->name }}</p>
                                <p><strong>Author:</strong> {{ $post->user->name }}</p>

                                <!-- Post Edit/Delete buttons for the owner -->
                                @if ($post->user_id == auth()->id())
                                    <div class="d-flex justify-content-between mb-3">
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit
                                            Post</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete Post</button>
                                        </form>
                                    </div>
                                @endif

                                <!-- Comments Section -->
                                <div class="comments mt-3">
                                    <h5>Comments</h5>
                                    @foreach ($post->comments as $comment)
                                        <div class="comment mb-3">
                                            <p>{{ $comment->content }} - <strong>{{ $comment->user->name }}</strong></p>

                                            <!-- Edit/Delete buttons for user's own comments -->
                                            @if ($comment->user_id == auth()->id())
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('comments.edit', $comment->id) }}"
                                                        class="btn btn-primary m-2 p-2">Edit Comment</a>
                                                    <form action="{{ route('comments.destroy', $comment->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger m-2">Delete
                                                            Comment</button>
                                                    </form>
                                                </div>
                                            @endif

                                            <!-- Delete comment button for the post owner (even if the comment is not by them) -->
                                            @if ($post->user_id == auth()->id() && $comment->user_id != $post->user_id)
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete
                                                        Comment</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Add new Comment Form -->
                                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="content" class="form-control" placeholder="Add a comment..." rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Add Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
