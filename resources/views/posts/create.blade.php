
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                class="form-control @error('title') is-invalid @enderror" 
                value="{{ old('title') }}"
                required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="body">Body</label>
            <textarea 
                id="body" 
                name="body" 
                rows="5" 
                class="form-control @error('body') is-invalid @enderror" 
                required>{{ old('body') }}</textarea>
            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
