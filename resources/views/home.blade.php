
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
                        <li><a href="/category/tech" class="block px-4 py-2 hover:bg-gray-700">تکنولوژی</a></li>
                        <li><a href="/category/life" class="block px-4 py-2 hover:bg-gray-700">سبک زندگی</a></li>
                        <li><a href="/category/travel" class="block px-4 py-2 hover:bg-gray-700">مسافرت و گردشگری</a></li>
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
                    <li><a href="/post/1" class="text-blue-600 hover:underline">عنوان پست 1</a></li>
                    <li><a href="/post/2" class="text-blue-600 hover:underline">عنوان پست 2</a></li>
                    <li><a href="/post/3" class="text-blue-600 hover:underline">عنوان پست 3</a></li>
                </ul>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold mb-4">پست‌های مرتبط</h3>
                <ul>
                    <li><a href="/post/4" class="text-blue-600 hover:underline">عنوان پست مرتبط 1</a></li>
                    <li><a href="/post/5" class="text-blue-600 hover:underline">عنوان پست مرتبط 2</a></li>
                </ul>
            </div>
        </aside>

        <section class="w-full md:w-3/5 px-4">
            <div class="grid gap-6">
                @foreach ($posts as $post)
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                        @if ($post->image)
                        <img  src={{$post->image }} width="200" height="300" >
                        @endif
                        <div class="p-4">
                            <h2 class="text-xl font-bold">
                                <a href="{{ route('posts.show', $post) }}" class="text-gray-800 hover:text-blue-600">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-600 mt-2">{{ Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline mt-4 block">ادامه مطلب</a>
                        </div>
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
                    <li><a href="/category/tech" class="text-blue-600 hover:underline">تکنولوژی</a></li>
                    <li><a href="/category/life" class="text-blue-600 hover:underline">سبک زندگی</a></li>
                </ul>
            </div>
        </aside>
    </main>
</div>
@endsection
