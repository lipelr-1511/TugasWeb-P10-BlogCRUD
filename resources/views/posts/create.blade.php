@extends('layouts.app')

@section('title', 'Tambah Post Baru')

@section('content')
<h2>Buat Postingan Baru</h2>

<form action="{{ route('posts.store') }}" method="POST" class="mt-3">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Judul Post</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="body" class="form-label">Isi Konten</label>
        <textarea name="body" id="body" rows="5" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
        @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Simpan Post</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection