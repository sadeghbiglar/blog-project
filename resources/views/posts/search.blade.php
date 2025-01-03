@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">نتایج جستجو برای: "{{ $query }}"</h1>

    @if ($posts->isEmpty())
        <p class="text-gray-500">هیچ نتیجه‌ای یافت نشد.</p>
    @else
        <div class="grid gap-6">
            @foreach ($posts as $post)
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h2 class="text-xl font-bold">
                        <a href="{{ route('posts.show', $post) }}" class="text-gray-800 hover:text-blue-600">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-600 mt-2">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline mt-4 block">ادامه مطلب</a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
