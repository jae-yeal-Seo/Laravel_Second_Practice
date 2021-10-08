<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글수정 폼') }}
        </h2>
        <button onclick=location.href="{{ route('posts.show',['post'=>$post]) }}" type="button" class="btn btn-danger font-bold hover:bg-yellow-700">상세보기</button>
    </div>
    </x-slot>

    <div class="m-4 p-4">
    <form id="editForm" class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('posts.update',['post'=>$post->id]) }}">
        @method('patch')
        @csrf
        <div class="col-12 m-2">
          <label for="title" class="form-label">제목</label>
          <input type="text" autocomplete='off' name="title" class="form-control" id="title" placeholder="제목입력"
          value={{ $post->title }}>
          @error('title')
           <div class="text-red-800">
            <span>{{ $message }}</span>
           </div>
          @enderror
        </div>
        <div class="col-12 m-2">
          <label for="content" class="form-label"  value="{{ old('content') }}">글내용</label>
          <textarea class="form-control" id="content" name ="content">{{ $post->content }}</textarea>
          @error('content')
         <div class="text-red-800">
            <span>{{ $message }}</span>
         </div>
          @enderror
        </div>
        

        <div class = "col-12 m-2">
            @if($post->image)
            <div class="flex item-center">
        <img class="w-20 h-20 rounded-full" src="{{ '/storage/images/'.$post->image }}" 
        class="card-img-top"  >

        <button class="btn btn-danger h-10 mx-2 my-2" onclick="return deleteImage({{ $post->id }})">이미지 삭제</button>
     
      </div>
        @else
        <span>첨부 이미지 없음.</span>
        @endif
            <label for="image" class="form-label">첨부 이미지</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        
        <div class="col-12 m-2">
          <button type="submit" class="btn btn-primary">글수정</button>
        </div>
        
      </form>
      
    </div>

</x-app-layout>