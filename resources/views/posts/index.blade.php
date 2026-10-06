@extends('layouts.app')

@section('title', 'Daftar Post')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Daftar Postingan</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-success">+ Tambah Post</a>
</div>

@forelse ($posts as $post)
    <x-card :post="$post">
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>

        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
    </x-card>
@empty
    <div class="alert alert-secondary">Belum ada postingan. Silakan tambah post baru.</div>
@endforelse

<div class="mt-4">
    {{ $posts->links() }}
</div>
@endsection
