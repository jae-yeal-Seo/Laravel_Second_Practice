<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('상세보기') }}
        </h2>

        <button onclick=location.href="{{ route('posts.index') }}" type="button" class="btn btn-danger font-bold hover:bg-yellow-700">목록보기
      </button>
    </div>
    </x-slot>
    <x-post-show :post="$post" />
    {{-- 여기다가 댓글 컴포넌트 --}}
</x-app-layout>