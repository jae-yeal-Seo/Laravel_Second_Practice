<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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


        $posts = Post::with('likes')->latest()->paginate(10);


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
        //Post객체에서 fillable설정을 해야 대량 입력이 가능한 것.

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
        $post = Post::with('likes')->find($id);
        //eager loading(즉시 로딩)
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
        //수정버튼 눌렀을 때
        //$id에 해당하는 포스트를 수정할 수 있는 페이지를 반환해주면 된다.
        return view('bbs.edit', ['post' => Post::find($id)]);
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
        //수정완료 버튼을 눌렀을 때
        //$request가 있는 이유 : 바뀐애가 오니까.
        $request->validate([
            'title' => 'required',
            'content' => 'required|min:3',
        ]);

        $post = Post::find($id);
        //덮어쓰기 위해 해당아이디에 해당하는 객체를 가져온다
        // $post->title = $request->input['title'];
        $post->title = $request->title;
        $post->content = $request->content;
        // $request 객체 안에 이미지가 있으면 
        // 이 이미지를 이 게시글의 이미지로 변경하겠다.
        if ($request->image) {
            // 이 이미지를 이 게시글의 이미지로 파일 시스템에
            // 저장하고, DB에 반영하기 전에 
            // 기존 이미지가 있다면
            // 그 이미지를 파일 시스템에서 삭제해줘야 한다. 
            if ($post->image) {
                Storage::delete('public/images/' . $post->image);
            }
            $fileName = time() . '_' .
                $request->file('image')->getClientOriginalName();
            $post->image = $fileName;
            $request->file('image')->storeAs('public/images', $fileName);
            //파일 시스템에 저장


            //DB에 저장
            // update posts set title = $request -> title,
            // content =$request->content,
            // image = fileName <=optional
            // updated_at = now(),
        }
        $post->save();
        return redirect()->route('posts.show', ['post' => $post->id]);

        //화면을 띄워야 되고
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //$id는 라우터 파라미터, 그리고 매개변수 순서 지켜야 됨
        $post = Post::find($id);
        if ($post->image) {
            Storage::delete('public/images/' . $post->image);
        }
        $post->delete();
        //게시글에 딸린 이미지가 있으면 파일시스템에서도 삭제해줘야 한다.
        return redirect()->route('posts.index');
    }

    public function deleteImage($id)
    {
        $post = Post::find($id);
        Storage::delete('public/images/' . $post->image);
        $post->image = null;
        $post->save();
        return redirect()->route('posts.edit', ['post' => $post->id]);
    }
}
