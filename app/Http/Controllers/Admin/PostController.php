<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'slug'      => ['nullable', 'alpha_dash', Rule::unique('posts', 'slug')],
            'excerpt'   => 'nullable|max:300',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|max:2048',
            'publish'   => 'nullable|boolean',
        ]);

        $slug = $validated['slug'] ?? (Str::slug($validated['title']) . '-' . Str::random(5));

        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->storeAs(
                'thumbs',
                Str::random(16) . '.' . $request->file('thumbnail')->getClientOriginalExtension(),
                'public'
            );
        }

        Post::create([
            'user_id'        => $request->user()->id,
            'title'          => $validated['title'],
            'slug'           => $slug,
            'excerpt'        => $validated['excerpt'] ?? null,
            'content'        => $validated['content'],
            'thumbnail_path' => $thumbPath ? 'storage/' . $thumbPath : null,
            'published_at'   => $request->boolean('publish') ? now() : null,
        ]);

        return redirect()->route('admin.posts.index')->with('ok', 'Post dibuat.');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'slug'      => ['required', 'alpha_dash', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt'   => 'nullable|max:300',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|max:2048',
            'publish'   => 'nullable|boolean',
        ]);

        $post->title   = $validated['title'];
        $post->slug    = $validated['slug'];
        $post->excerpt = $validated['excerpt'] ?? null;
        $post->content = $validated['content'];
        $post->published_at = $request->boolean('publish') ? ($post->published_at ?? now()) : null;

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail_path && Storage::disk('public')->exists(str_replace('storage/', '', $post->thumbnail_path))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $post->thumbnail_path));
            }

            $newThumb = $request->file('thumbnail')->storeAs(
                'thumbs',
                Str::random(16) . '.' . $request->file('thumbnail')->getClientOriginalExtension(),
                'public'
            );

            $post->thumbnail_path = 'storage/' . $newThumb;
        }

        $post->save();

        return back()->with('ok', 'Post diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->thumbnail_path && Storage::disk('public')->exists(str_replace('storage/', '', $post->thumbnail_path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $post->thumbnail_path));
        }

        $post->delete();
        return back()->with('ok', 'Post dihapus.');
    }
}
