<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function index($post)
    {
        // select * from comments where post_id = ?
        $comments = Comment::where('post_id', $post)->latest()->paginate(10);
        return $comments;
    }

    public function update(Request $request, $post)
    {
    }

    public function destroy($post, $comment)
    {
    }

    public function store(Request $request, $post)
    {
    }
}
