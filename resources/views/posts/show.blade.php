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
        <div class="mt-8">
            <h3 class="text-xl font-bold mb-4">ارسال نظر</h3>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea 
                    name="content" 
                    rows="3" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500"
                    placeholder="نظر خود را بنویسید..."
                    required
                ></textarea>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg mt-2 hover:bg-blue-700">
                    ارسال نظر
                </button>
            </form>
        </div>
        <div class="mt-8">
            <h3 class="text-xl font-bold mb-4">نظرات</h3>
            @forelse ($post->comments as $comment)
                <div class="mb-4 border-b pb-4">
                    <p class="text-gray-700"><strong>{{ $comment->user->name }}</strong>:</p>
                    <p>{{ $comment->content }}</p>
                    <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-gray-500">هنوز نظری ثبت نشده است.</p>
            @endforelse
        </div>
                
    </div>
</div>
@endsection
