@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="card-title">{{ $post->title }}</h2>
        <p class="text-muted">
            Dibuat {{ $post->created_at->format('d M Y H:i') }}
            @if ($post->updated_at->ne($post->created_at))
                · Diperbarui {{ $post->updated_at->diffForHumans() }}
            @endif
        </p>
        <hr>
        <div class="mb-4">{!! nl2br(e($post->body)) !!}</div>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>
</div>
@endsection
