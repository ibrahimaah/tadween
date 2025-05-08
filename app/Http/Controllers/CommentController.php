<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('replies.replies') // eager load nested replies
            ->orderByDesc('created_at')
            ->get();

        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'author' => 'nullable|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'author' => $request->author ?? 'Anonymous',
            'parent_id' => $request->parent_id,
        ]);

        return response()->json($comment->load('replies'));
    }
}
