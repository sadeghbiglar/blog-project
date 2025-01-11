@extends($layout)

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">آرشیو پست‌ها: {{ $year }}</h1>

    @if ($posts->isEmpty())
        <p class="text-gray-500">هیچ پستی برای این سال وجود ندارد.</p>
    @else
        <div class="grid gap-6">
            @foreach ($posts as $post)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden p-4 flex flex-col md:flex-row items-center md:items-start">
                    @if ($post->image)
                    <div class="flex-shrink-0 mb-4 md:mb-0 md:ml-4">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" 
                             class="rounded-lg shadow-lg max-h-64 w-64 object-cover">
                    </div>
                    @endif

                    <div class="flex-grow">
                        <h2 class="text-xl font-bold mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-gray-800 hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline font-bold">
                            ادامه مطلب
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }} <!-- لینک‌های صفحه‌بندی -->
        </div>
    @endif
</div>
@endsection
