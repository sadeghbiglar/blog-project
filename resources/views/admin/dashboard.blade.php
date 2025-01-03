@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    
    <h1 class="text-2xl font-bold mb-6">داشبورد مدیریت</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">پست‌ها</h2>
            <p class="text-gray-600">مدیریت پست‌های سایت</p>
            <a href="{{ route('dashboard.posts.index') }}" class="text-blue-600 hover:underline">مشاهده</a>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">دسته‌بندی‌ها</h2>
            <p class="text-gray-600">مدیریت دسته‌بندی‌های سایت</p>
            <a href="{{ route('dashboard.categories.index') }}" class="text-blue-600 hover:underline">مشاهده</a>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">نظرات</h2>
            <p class="text-gray-600">مدیریت نظرات کاربران</p>
            <a href="{{ route('dashboard.comments.index') }}" class="text-blue-600 hover:underline">مشاهده</a>
        </div>
    </div>
</div>
@endsection
