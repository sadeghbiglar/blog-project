<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('fonts/vazir/Vazir.css') }}" rel="stylesheet" type="text/css" />
      <!-- Place the first <script> tag in your HTML's <head> -->
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
       
    
        <div class="flex flex-col min-h-screen">
            <!-- Header -->
            <header class="bg-gray-800 text-white p-1">
                <div class="container mx-auto flex flex-col md:flex-row items-center justify-between p-1">
                    <h1 class="font-vazir text-xl font-bold"> یادداشتهای روزانه من</h1>
                
                     <!-- بخش ورود/خروج -->
        <div class="flex items-center">
            @auth
            <div class="ms-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    @if (Auth::check())
                                    <p>{{ Auth::user()->name }}</p>
                                @endif
                                
            
                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>
            
                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>
            
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>
            
                       
                        <x-dropdown-link href="{{ route('dashboard') }}">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                        
                        <x-dropdown-link href="{{ route('home') }}">
                            {{ __('HomePage') }}
                        </x-dropdown-link>
            
                        <div class="border-t border-gray-200"></div>
            
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
            
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            
            @else
            <!-- دکمه‌های ورود و ثبت‌نام -->
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg ml-2 hover:bg-blue-700">
                ورود
            </a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg ml-2 hover:bg-green-700">
                ثبت‌نام
            </a>
            @endauth
        </div>
                </div>

            </header>
            
           {{--  @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif --}}
            <!-- Main Content -->
            <main class="flex-grow ">
                 {{ $slot }} 
                @yield('content')
            </main>
        
            <!-- Footer -->
            <footer class="bg-gray-800 text-white p-4 text-center">
                <p>&copy; 2024 Your Name. All rights reserved.</p>
            </footer>
        </div>
{{--         <script src="https://cdn.tiny.cloud/1/09p8d9e28h6zjk2jhpnl1y2vfk1s84vjydyb1f0naz1f4f3z/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        tinymce.init({
        selector: '#content', // id فیلد textarea
        language: 'fa', // زبان فارسی
        plugins: 'lists link image table code', // پلاگین‌های مورد نیاز
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
        height: 400,
    });
});
</script> --}}

    </body>
</html>
