<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function index($post)
    {
        // (댓글)불러오기 버튼을 눌렀을 때.
        // select * from comments where post_id = ?
        // CommentList에서 axios.get('/comments/'+this.post.id').then(response=>console.log(response))
        // 을 한다. response안에 comments가 담겨있다. 
        //select써서 comment하고 id(comment의 id)만 가져오면 될 것 같다.
        $comments = Comment::where('post_id', $post)->latest()->get();
        // dd($comments);
        return $comments;
    }

    public function update(Request $request, $id)
    {
        //댓글 수정버튼을 누를 때 해당 $comment->$id를 전달해준다.(comment는 comments에서 파생) 
        //$request에 댓글의 내용이, $post엔 $post의 id가, $id에는 댓글의 $id가 있다.
        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->save();

        return $comment;
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return $comment;
    }

    public function store(Request $request, $post)
    {
        $request->validate([
            'comment' => 'required|min:1',
        ]);
        $comment = Comment::create([
            'comment' => $request->comment,
            "user_id" => Auth::auth()->id,
            "post_id" => $post
        ]);

        return $comment;
    }
}
