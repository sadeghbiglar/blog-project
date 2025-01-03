@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">تماس با ما</h1>

    <form action="{{ route('contact.submit') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">نام:</label>
            <input type="text" name="name" id="name" 
                   class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" 
                   required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">ایمیل:</label>
            <input type="email" name="email" id="email" 
                   class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" 
                   required>
        </div>

        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">پیام:</label>
            <textarea name="message" id="message" 
                      class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" 
                      rows="4" required></textarea>
        </div>

        <button type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ارسال پیام
        </button>
    </form>
</div>
@endsection
