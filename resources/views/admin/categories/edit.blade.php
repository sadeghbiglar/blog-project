@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">ویرایش دسته‌بندی</h1>

    <form action="{{ route('dashboard.categories.update', $category) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">نام دسته‌بندی:</label>
            <input type="text" name="name" id="name" 
                   class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" 
                   value="{{ old('name', $category->name) }}" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ذخیره
        </button>
    </form>
</div>
@endsection
