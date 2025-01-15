@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">ایجاد نقش جدید</h1>
    <form action="{{ route('dashboard.roles.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">نام نقش:</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">توضیحات:</label>
            <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
        </div>
        <div class="mb-4">
            <label for="permissions" class="block text-gray-700 font-bold mb-2">دسترسی‌ها:</label>
            <select name="permissions[]" id="permissions" multiple class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->description }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ذخیره
        </button>
    </form>
</div>
@endsection
