@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">ایجاد پست جدید</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">عنوان پست:</label>
            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">متن پست:</label>
            <textarea name="content" id="content" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2" required></textarea>
        </div>
      

        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">تصویر پست:</label>
            <input type="file" name="image" id="image" class="w-full" accept="image/*" onchange="previewImage(event)">
            <img id="imagePreview" class="mt-4 hidden w-40 h-40 object-cover rounded-lg">
        </div>
        
        <script>
            function previewImage(event) {
                const image = document.getElementById('imagePreview');
                image.src = URL.createObjectURL(event.target.files[0]);
                image.classList.remove('hidden');
            }
        </script>
        

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold mb-2">دسته‌بندی:</label>
            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <option value="">بدون دسته‌بندی</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ذخیره
        </button>
    </form>
</div>


@endsection
