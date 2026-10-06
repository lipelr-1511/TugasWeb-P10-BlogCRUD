<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Throwable;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'body'  => 'required|string|min:10',
        ]);

        try {
            Post::create($validated);
        } catch (Throwable $e) {
            report($e);
            return back()->withInput()
                ->with('error', 'Postingan gagal ditambahkan. Silakan coba lagi.');
        }

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil ditambahkan!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'body'  => 'required|string|min:10',
        ]);

        try {
            $post->update($validated);
        } catch (Throwable $e) {
            report($e);
            return back()->withInput()
                ->with('error', 'Postingan gagal diperbarui. Silakan coba lagi.');
        }

        return redirect()->route('posts.show', $post)
            ->with('success', 'Postingan berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('posts.index')
                ->with('error', 'Postingan gagal dihapus.');
        }

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil dihapus!');
    }
}
