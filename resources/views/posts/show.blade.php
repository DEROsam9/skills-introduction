@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <small>Created at: {{ $post->created_at->format('F j, Y, g:i a') }}</small>

    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit Post</a>
    </div>
</div>
@endsection
