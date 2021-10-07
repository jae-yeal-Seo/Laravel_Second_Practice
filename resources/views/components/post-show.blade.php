<div class="container">
    <div class="card" style="width: 100%; margin:10px">

        @if($post->image)
        <img src="{{ '/storage/images/'.$post->image }}" 
        class="card-img-top" >
        @else
        <span>첨부이미지 없음.</span>
        @endif

        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->content }}</p>
          <div>
            <like-button/>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">등록일:{{ $post->created_at->diffForHumans() }}</li>
          <li class="list-group-item">수정일:{{ $post->updated_at->diffForHumans() }}</li>
          <li class="list-group-item">작성자:{{ $post->writer->name }}</li>
        </ul>
        <div class="card-body flex"> 

          
          <a href="{{ route('posts.edit',['post'=>$post->id]) }}" class="card-link">수정하기</a>


          <form id="form" class="ml-4" method="post" onsubmit="event.preventDefault(); confirmDelete(event)" action="{{ route('posts.destroy',['post'=>$post->id]) }}">
            {{-- event는 submit이 된다. --}}
            {{-- onsubmit = "submit이벤터가 발생하면" --}}
          @csrf
          {{-- <input type="hidden" name="_method" value="delete"> --}}
          @method('delete')
          {{-- 이렇게 하면 파라미터에 delete가 들어간다. --}}
          {{-- get방식이 아니면 @csrf, 메소드 스푸핑(@method('delete')필수 ) --}}
          
          <button type="submit">삭제하기</button>
          {{-- delete(post)방식으로 보내야 함. a태그는 get방식만을 받기 때문에 form태그로 함.--}}
        </form>
        </div>
      </div>
      <script>
        function confirmDelete(e){
         myform = document.getElementById('form');
          //id가 form인 dom을 찾아라.
        flag = confirm('정말 삭제하시겠습니까?');
        if(flag){
          //서브밋
          myform.submit();
          //막았던 submit동작을 다시함.
        }
          // e.preventDefault(); //form이 서버로 전달되는 것을 막아준다. 
        }
      </script>
</div>