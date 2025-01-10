
@extends('layouts.app')

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
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-6">
                <h3 class="text-lg font-bold mb-4">آخرین پست‌ها</h3>
                <ul>
                    @foreach ($posts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="block px-4 py-2 hover:bg-gray-700">
                        {{ $post->title }}
                    </a>
                    @endforeach
                  
                </ul>
            </div>
            
        </aside>
        <section class="w-full md:w-3/5 px-4">
            <div class="grid gap-6">
                @foreach ($posts as $post)
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden p-4 flex flex-col md:flex-row items-center md:items-start">
                       
        
                        <!-- ستون متن -->
                        <div class="flex-grow">
                            <h2 class="text-xl font-bold mb-2">
                                <a href="{{ route('posts.show', $post) }}" class="text-gray-800 hover:text-blue-600">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                            
                            @if ($post->category)
                                <p class="text-sm text-gray-500 mb-4">
                                    دسته‌بندی: 
                                    <a href="{{ route('categories.show', $post->category->slug) }}" class="text-blue-600 hover:underline">
                                        {{ $post->category->name }}
                                    </a>
                                </p>
                            @endif
        
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline font-bold">
                                ادامه مطلب
                            </a>
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
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-6">
                <h3 class="text-lg font-bold mb-4">آرشیو پست‌ها</h3>
                <ul>
                    <li><a href="/archive/2023" class="text-blue-600 hover:underline">سال 2023</a></li>
                    <li><a href="/archive/2022" class="text-blue-600 hover:underline">سال 2022</a></li>
                </ul>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
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
