
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard - Posts</h1>

    <!-- Add New Post Button -->
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Add New Post</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($posts->isEmpty())
        <p>No posts available.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($post->body, 50) }}</td>
                    <td>{{ $post->created_at->format('F j, Y, g:i a') }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete button with confirmation -->
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard - Posts</h1>

    <!-- Add New Post Button -->
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Add New Post</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($posts->isEmpty())
        <p>No posts available.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($post->body, 50) }}</td>
                    <td>{{ $post->created_at->format('F j, Y, g:i a') }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete button with confirmation -->
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
