@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">لیست پست‌ها</h1>

    @foreach ($posts as $post)
        <div class="mb-6 border-b pb-4">
            <h2 class="text-xl font-bold">
                <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline">{{ $post->title }}</a>
            </h2>
            <p class="text-gray-700 mt-2">{{ Str::limit($post->content, 100) }}</p>
            <img src={{$post->image }} width="200" height="300">

        </div>
    @endforeach

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
