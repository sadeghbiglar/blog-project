@extends($layout)

@section('content')
<div class="container mx-auto flex flex-wrap" style="box-shadow: 6px 6px 29px 1px #60d8e1, 5px 5px 10px 1px #000000;">
    <!-- بخش اصلی -->
    <div class="w-full lg:w-3/4 bg-white rounded-lg shadow-md p-6" >
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

        @if ($post->image)
        <div class="flex items-center justify-center mb-4">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="rounded-lg shadow-lg" width="500" height="800">
        </div>
        @endif

        <p class="text-gray-700 leading-relaxed mb-6">{!!$post->content !!}</p>

        @if ($post->file)
        <div class="mt-4">
            <a href="{{ asset('storage/' . $post->file) }}" 
               class="text-blue-600 hover:underline" 
               target="_blank">
                دانلود فایل
            </a>
        </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">بازگشت به صفحه اصلی</a>
        </div>

        @auth
        <!-- دکمه لایک -->
        <div class="mt-4">
            <button 
                class="like-button bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                data-post-id="{{ $post->id }}"
            >
                👍 لایک 
                <span class="like-count">{{ $post->likes->count() }}</span>
            </button>
        </div>

        <!-- فرم ارسال نظر -->
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

        <!-- نمایش نظرات -->
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
        @else
        <p class="text-gray-700 mt-4">برای ثبت نظر در مورد این پست لطفا وارد حساب کاربری خود شوید.</p>
        @endauth
    </div>

    <!-- ستون سمت راست -->
    <aside class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
        <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-6" style="box-shadow: 6px 6px 29px 1px #60d8e1, 5px 5px 10px 1px #000000;">
            <h3 class="text-lg font-bold mb-4">پست‌های مرتبط</h3>
            <ul>
                @forelse ($relatedPosts as $relatedPost)
                    <li class="mb-2">
                        <a href="{{ route('posts.show', $relatedPost) }}" class="text-blue-600 hover:underline">
                            {{ $relatedPost->title }}
                        </a>
                    </li>
                @empty
                    <li class="text-gray-500">پستی یافت نشد.</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg shadow-lg" style="box-shadow: 6px 6px 29px 1px #60d8e1, 5px 5px 10px 1px #000000;">
            <h3 class="text-lg font-bold mb-4">ده پست آخر</h3>
            <ul>
                @foreach ($latestPosts as $latestPost)
                    <li class="mb-2">
                        <a href="{{ route('posts.show', $latestPost) }}" class="text-blue-600 hover:underline">
                            {{ $latestPost->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
@endsection
