@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<h2>Edit Postingan</h2>

<form action="{{ route('posts.update', $post) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Judul Post</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="body" class="form-label">Isi Konten</label>
        <textarea name="body" id="body" rows="5" class="form-control @error('body') is-invalid @enderror">{{ old('body', $post->body) }}</textarea>
        @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Post</button>
    <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Batal</a>
</form>
@endsection