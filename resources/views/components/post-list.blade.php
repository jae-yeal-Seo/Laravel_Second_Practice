
   <div>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">제목</th>
                <th scope="col">작성자</th>
                <th scope="col">작성일</th>
                <th scope="col">좋아요 수</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
              <tr>
                  <td><a href="{{ route('posts.show',['post'=>$post->id]) }}">{{ $post->title }}
                {{-- 해당라우터는 php artisan serve route:list보면 {post}에 무언가 넣어줘야됨 --}}
                </a></td>
                <td>{{ $post->writer->name }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                {{-- <td><like-button :loginuser="{{ auth()->user()->id }}" :post="{{ $post }}" /></td>
                <td>{{ $post->likes->count() }}</td> --}}
                <td><like-button :loginuser="{{ auth()->user()->id }}" :post="{{ $post }}" :likepeople="{{ $post->likes->count() }}"/> </td>
              </tr>
          @endforeach
        </tbody>
    </table>
    {{ $posts ->links() }}
</div>
