<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        1. 게시글 리스트를 DB에서 읽어오기
        2. 게시글 목록 만들어주는 blade에  읽어온 데이터를 전달
           실행.
        */

        //select * from posts order by created_at desc(내림차순) 
        //하기 위해 order by사용
        //제일 최신순 --> latest
        // $posts = Post::latest()->get();
        // $posts = Post::oldest()->get();
        $posts = Post::latest()->paginate(10);
        return view('bbs.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bbs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required|min:3',
        ]);



        if ($request->hasFile('image')) {
            $fileName = time() . '_' .
                $request->file('image')->getClientOriginalName();
            $request->file('image')
                ->storeAs('public/images', $fileName);
        }
        // dd($request->all());
        $input = array_merge($request->all(), ["user_id" => Auth::user()->id]);
        //array_merge : 배열을 합침 
        // --> 3개는 들어가고 나머지는 없어도 됨.

        //Eloquent model의 white list인 $fillable에 기술해야 
        //Post::create사용가능
        if ($fileName) {
            $input = array_merge($input, ['image' => $fileName]);
        }

        Post::create($input);

        return redirect()->route('posts.index');
        //뷰는 라우터가 아니라 파일경로를 알려줘야지.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //id에 해당하는 Post를 데이터베이스에서 인출하고 
        $post = Post::find($id);
        //그 놈을 상세보기 뷰로 전달
        return view('bbs.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
