@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

        @if ($post->image)
        <img  src={{$post->image }} width="200" height="300" >
        @endif

        <p class="text-gray-700 leading-relaxed">{{ $post->content }}</p>

        <div class="mt-6">
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">بازگشت به صفحه اصلی</a>
        </div>
    </div>
</div>
@endsection
