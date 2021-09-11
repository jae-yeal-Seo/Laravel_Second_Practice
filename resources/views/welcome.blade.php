<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-post-list :posts="$posts"/>
<h2>블레이드 템플릿 파일을 재사용한 welcome</h2>
</x-app-layout>
 