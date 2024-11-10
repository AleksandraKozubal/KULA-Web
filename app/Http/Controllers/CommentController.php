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
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->kebab_place_id = $request->kebab_place_id;

        $comment->save();
    }

    public function show(Comment $comment)
    {
        return json_encode($comment);
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->content ? $comment->content = $request->content : null;
        $comment->save();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}
