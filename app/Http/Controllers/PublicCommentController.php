<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PublicCommentController extends Controller
{
    public function store(Post $post, Request $r)
    {
        $data = $r->validate([
            'author_name' => 'required|string|max:100',
            'author_email' => 'nullable|email',
            'body' => 'required|string|max:2000',
        ]);
        $data['post_id'] = $post->id;
        Comment::create($data);
        return back()->with('status', 'Komentar terkirim, menunggu persetujuan admin.');
    }
}
