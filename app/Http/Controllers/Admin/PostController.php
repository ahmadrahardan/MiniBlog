<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|alpha_dash|unique:posts,slug',
            'excerpt' => 'nullable|max:300',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
            'publish' => 'nullable|boolean',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']) . '-' . Str::random(5);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('thumbs', 'public');
        }
        $data['user_id'] = auth()->id();
        $data['published_at'] = $request->boolean('publish') ? now() : null;
        Post::create($data);
        return redirect()->route('admin.posts.index')->with('ok', 'Post dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => "required|alpha_dash|unique:posts,slug,$post->id",
            'excerpt' => 'nullable|max:300',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
            'publish' => 'nullable|boolean',
        ]);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('thumbs', 'public');
        }
        $data['published_at'] = $request->boolean('publish') ? ($post->published_at ?? now()) : null;
        $post->update($data);
        return back()->with('ok', 'Post diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('ok', 'Post dihapus.');
    }
}
