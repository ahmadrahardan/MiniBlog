<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }
    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return back()->with('ok', 'Komentar disetujui.');
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('ok', 'Komentar dihapus.');
    }
}
