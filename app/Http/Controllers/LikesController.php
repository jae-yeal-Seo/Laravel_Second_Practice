<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /*
        1.로그인된 사용자의 좋아요/좋아요취소 요청처리
     */
    public function store(Post $post)
    {
        //자동으로 모델을 반환한다.
        return $post->likes()->toggle(auth()->user());
    }
}
