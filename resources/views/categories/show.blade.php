@extends($layout)

@section('content')
<div class="container mx-auto">
    <div class="mt-6">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">بازگشت به صفحه اصلی</a>
    </div>
    <h1 class="text-2xl font-bold mb-6">پست‌های دسته‌بندی: {{ $category->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h2 class="text-lg font-bold mb-2">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-700">{{ Str::limit($post->content, 100) }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $posts->links() }} <!-- لینک‌های صفحه‌بندی -->
    </div>
</div>
@endsection
