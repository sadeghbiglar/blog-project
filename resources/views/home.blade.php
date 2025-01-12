
@extends($layout)

@section('content')

<div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-gray-800 text-white">
        <div class="w-full h-64 bg-cover bg-center" style="background-image: url('{{ asset('images/header.jpg') }}');">
            
            <!-- Header Image -->
           
            {{-- <div class="w-full h-64 bg-cover bg-center" style="background-image: url('{{ asset('images/header.jpg') }}');"></div> --}}

        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="bg-gray-700 text-white">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between p-1">
            <ul class="flex p-4">
                <li class="mr-4"><a href="/" class="hover:underline">صفحه اصلی</a></li>
                <li class="mr-4"><a href="/about" class="hover:underline">درباره ما</a></li>
                <li class="relative group mr-4">
                    <a href="#" class="hover:underline">دسته‌بندی‌ها</a>
                    <ul class="absolute hidden group-hover:block bg-gray-800 text-white mt-2 rounded-lg shadow-lg min-w-48 max-w-64">
                        @foreach (\App\Models\Category::all() as $category)
                            <li>
                                <a href="{{ route('categories.show', $category->slug) }}" class="block px-4 py-2 hover:bg-gray-700">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    
                </li>
                <li class="mr-4"><a href="/contact" class="hover:underline">تماس با ما</a></li>
             
                
            </ul>
              <!-- فرم جستجو -->
        <form action="{{ route('home') }}" method="GET" class="flex items-center">
            <input 
                type="text" 
                name="search" 
                placeholder="جستجو..." 
                class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500"
            >
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg ml-2 hover:bg-blue-700">
                جستجو
            </button>
        </form> 
       
        
        </div>
     
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto flex flex-wrap mt-6">
        <!-- Right Sidebar -->
        <aside class="w-full md:w-1/5 px-4">
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-6" style="box-shadow: 3px 3px 3px 1px #60d8e1, 5px 5px 10px 1px #000000;">
                <h3 class="text-lg font-bold mb-4">آخرین پست‌ها</h3>
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
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-6" style="box-shadow: 3px 3px 3px 1px #60d8e1, 5px 5px 10px 1px #000000;">
                <h3 class="text-lg font-bold mb-4">آمار سایت</h3>
                <p>تعداد بازدید کل سایت: <strong>{{ $totalViews }}</strong></p>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-6" style="box-shadow: 3px 3px 3px 1px #60d8e1, 5px 5px 10px 1px #000000;">
                <h3 class="text-lg font-bold mb-4">پربازدیدترین پست‌ها</h3>
                <ul>
                    @foreach (\App\Models\Post::orderByDesc('views')->take(5)->get() as $popularPost)
                        <li>
                            <a href="{{ route('posts.show', $popularPost) }}" class="text-blue-600 hover:underline">
                                {{ $popularPost->title }} ({{ $popularPost->views }} بازدید)
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
        </aside>
        <section class="w-full md:w-3/5 px-4">
            <div 
             class="grid gap-6">
                @foreach ($posts as $post)
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden p-4 flex flex-col md:flex-row items-center md:items-start mb-1 " style="box-shadow: 3px 3px 3px 1px #60d8e1, 5px 5px 10px 1px #000000;">
                       
        
                        <!-- ستون متن -->
                        <div class="flex-grow mb-2">
                            <h2 class="text-xl font-bold mb-2">
                                <p class="text-sm text-gray-500 mb-4">
                                <a href="{{ route('posts.show', $post) }}" class="text-gray-800 hover:text-blue-600 mb-4">
                                    {{ $post->title }}
                                </a>
                            </p>
                            </h2>
                            <p class="text-gray-600 mb-4">{!! Str::limit($post->content, 100) !!}</p>
                         
                            @if ($post->category)
                                <p class="text-sm text-gray-500 mb-6">
                                    دسته‌بندی: 
                                    <a href="{{ route('categories.show', $post->category->slug) }}" class="text-blue-600 hover:underline mb-4">
                                        {{ $post->category->name }}
                                    </a>
                                </p>
                            @endif
                            <p class="text-sm text-gray-500 mb-4">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline font-bold mb-4">
                                ادامه مطلب
                            </a>
                        </p>
                            <p class="text-sm text-gray-500 mb-4">
                                تعداد بازدید: 
                                    {{ $post->views }}
                            </p>
                            <p class="text-sm text-gray-500 mb-4">
                                تاریخ ایجاد: {{ toJalali($post->created_at) }}
                            </p>
                            @if ($post->updated_at != $post->created_at)
                                <p class="text-sm text-gray-500 mb-4 ">
                                    تاریخ ویرایش: {{ toJalali($post->updated_at) }}
                                </p>
                            @endif
                            <p class="text-sm text-gray-500 mb-4">
                                نوشته شده توسط: 
                                <strong>{{ $post->user->name }}</strong> <!-- نام نویسنده -->
                            </p>
                        </div>
                         <!-- ستون تصویر -->
                         @if ($post->image)
                         <div class="flex-shrink-0 mb-4 md:mb-0 md:ml-4">
                             <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}" 
                                  class="rounded-lg shadow-lg max-h-64 w-64 object-cover">
                         </div>
                     @endif
                    </article>
                @endforeach
            </div>
        
            <div class="mt-6">
                {{ $posts->links() }} <!-- لینک‌های صفحه‌بندی -->
            </div>
        </section>
        
        

        <!-- Left Sidebar -->
        <aside class="w-full md:w-1/5 px-4">
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-6" style="box-shadow: 3px 3px 3px 1px #60d8e1, 5px 5px 10px 1px #000000;">
                <h3 class="text-lg font-bold mb-4" >آرشیو پست‌ها</h3>
                <ul>
                    @foreach (\App\Models\Post::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year') as $year)
                        <li>
                            <a href="{{ route('archive', $year) }}" class="text-blue-600 hover:underline">
                                سال {{ $year }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
       
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg" style="box-shadow: 3px 3px 3px 1px #60d8e1, 5px 5px 10px 1px #000000;">
                <h3 class="text-lg font-bold mb-4">طبقه‌بندی موضوعی</h3>
                <ul>
                    @foreach (\App\Models\Category::all() as $category)
                            <li>
                                <a href="{{ route('categories.show', $category->slug) }}" class="block px-4 py-2 hover:bg-gray-700">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                      </ul>
            </div>
        </aside>
    </main>
</div>
@endsection
