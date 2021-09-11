<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글쓰기 폼') }}
        </h2>
        <button onclick=location.href="{{ route('posts.index') }}" type="button" class="btn btn-danger font-bold hover:bg-yellow-700">목록보기</button>
    </div>
    </x-slot>

    <div class="m-4 p-4">
    <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('posts.store') }}">
        @csrf
        <div class="col-12 m-2">
          <label for="title" class="form-label">제목</label>
          <input type="text" autocomplete='off' name="title" class="form-control" id="title" placeholder="제목입력"
          value="{{ old('title') }}">
          @error('title')
           <div class="text-red-800">
            <span>{{ $message }}</span>
           </div>
          @enderror
        </div>
        <div class="col-12 m-2">
          <label for="content" class="form-label"  value="{{ old('content') }}">글내용</label>
          <textarea class="form-control" id="content" name ="content"></textarea>
          @error('content')
         <div class="text-red-800">
            <span>{{ $message }}</span>
         </div>
          @enderror
        </div>

        <div class = "col-12 m-2">
            <label for="image" class="form-label">첨부 이미지</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        
        <div class="col-12 m-2">
          <button type="submit" class="btn btn-primary">글저장</button>
        </div>
        
      </form>
    </div>

</x-app-layout>