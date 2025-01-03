@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">ویرایش پست</h1>

    <form action="{{ route('dashboard.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">عنوان:</label>
            <input type="text" name="title" id="title" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                   value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">متن:</label>
            <textarea name="content" id="content" rows="5" 
                      class="w-full border border-gray-300 rounded-lg px-4 py-2" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">تصویر جدید (اختیاری):</label>
            <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded-lg">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="w-40 h-40 mt-4 object-cover rounded-lg">
            @endif
        </div>
        <div class="mb-4">
            <label for="file" class="block text-sm font-medium text-gray-700">فایل:</label>
            <input type="file" name="file" id="file" 
                   class="block w-full mt-1 p-2 border border-gray-300 rounded-lg">
        </div>
        
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold mb-2">دسته‌بندی:</label>
            <select name="category_id" id="category_id" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <option value="">بدون دسته‌بندی</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" 
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            ذخیره تغییرات
        </button>
    </form>
</div>
@endsection
