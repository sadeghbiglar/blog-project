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
                <!-- دکمه خروج -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg ml-2 hover:bg-red-700">
                        خروج
                    </button>
                </form>
            @else
                <!-- دکمه‌های ورود و ثبت‌نام -->
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg ml-2 hover:bg-blue-700">
                    ورود
                </a>
                <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg ml-2 hover:bg-green-700">
                    ثبت‌نام
                </a>
            @endauth
            @if (Auth::check() && Auth::user()->is_admin)
    <a href="{{ route('dashboard') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
 داشبورد مدیریت
    </a>
     <a href="/" 
       class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
        صفحه اصلی  
    </a>
@endif

        </div>
                </div>

            </header>
            @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
            <!-- Main Content -->
            <main class="flex-grow">
                {{-- {{ $slot }} --}}
                @yield('content')
            </main>
        
            <!-- Footer -->
            <footer class="bg-gray-800 text-white p-4 text-center">
                <p>&copy; 2024 Your Name. All rights reserved.</p>
            </footer>
        </div>
        
    </body>
</html>
