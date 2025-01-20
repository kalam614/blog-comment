@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Comment</h2>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group mb-2">
                <textarea name="content" class="form-control">{{ $comment->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Comment</button>
        </form>
    </div>
@endsection
