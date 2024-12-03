<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return json_encode(Comment::all());
    }

    public function store(Request $request)
    {
        if (!auth()->user()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->user()->id;
        $comment->kebab_place_id = $request->kebabPlace;
        $comment->save();
        return response()->json([
            'message' => 'Comment created'
        ]);
    }

    public function show(Comment $comment)
    {
        return json_encode($comment);
    }

    public function edit(Request $request)
    {
        if (!auth()->user()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $comment = Comment::find($request->comment);
        if ($comment->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $comment->content ? $comment->content = $request->content : null;
        $comment->save();
        return response()->json([
            'message' => 'Comment edited'
        ]);
    }

    public function destroy(Request $request)
    {
        if (!auth()->user()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $comment = Comment::find($request->comment);
        if ($comment->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $comment->delete();
        return response()->json([
            'message' => 'Comment deleted'
        ]);
    }
}
