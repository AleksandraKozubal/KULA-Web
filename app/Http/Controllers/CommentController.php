<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Comment::all());
    }

    public function store(Request $request): JsonResponse
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
            'message' => 'Dodano komentarz',
        ]);
    }
    public function show(Comment $comment): JsonResponse
    {
        return response()->json_encode($comment);
    }

    public function edit(Request $request): JsonResponse
    {
        if (!auth()->user()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $comment = Comment::find($request->comment);

        if (!$comment || $comment->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        if ($request->has('content')) {
            $comment->content = $request->content;
            $comment->save();
        }

        return response()->json([
            'message' => 'Edytowano komentarz'
        ]);
    }
    public function destroy(Request $request): JsonResponse
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
            'message' => 'Komentarz usunięty'
        ]);
    }
}
