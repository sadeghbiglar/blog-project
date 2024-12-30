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
            <header class="bg-gray-800 text-white p-4">
                <div class="container mx-auto">
                    <h1 class="font-vazir text-xl font-bold"> یادداشتهای روزانه من</h1>
                </div>
            </header>
        
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
