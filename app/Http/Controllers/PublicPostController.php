<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest('published_at')->paginate(9);
        return view('public.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        abort_unless($post->published_at, 404);
        $comments = $post->comments()->where('is_approved', true)->paginate(10);
        return view('public.posts.show', compact('post', 'comments'));
    }
}
