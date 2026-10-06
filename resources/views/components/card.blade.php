@props(['post'])

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($post->body, 120) }}</p>
        <small class="text-muted d-block mb-2">Dibuat {{ $post->created_at->diffForHumans() }}</small>
        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
        {{ $slot }}
    </div>
</div>
