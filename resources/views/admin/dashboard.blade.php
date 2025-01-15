@extends($layout)

@section('content')
<div class="container mx-auto">
    
    <h1 class="text-2xl font-bold mb-6">داشبورد مدیریت</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @can('manage-posts')
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">پست‌ها</h2>
            <p class="text-gray-600">مدیریت پست‌های سایت</p>
            <a href="{{ route('dashboard.posts.index') }}" class="text-blue-600 hover:underline">مشاهده</a>
        </div>
        @endcan
        @can('manage-categories')
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">دسته‌بندی‌ها</h2>
            <p class="text-gray-600">مدیریت دسته‌بندی‌های سایت</p>
            <a href="{{ route('dashboard.categories.index') }}" class="text-blue-600 hover:underline">مشاهده</a>
        </div>
        @endcan
        @can('manage-comments')
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">نظرات</h2>
            <p class="text-gray-600">مدیریت نظرات کاربران</p>
            <a href="{{ route('dashboard.comments.index') }}" class="text-blue-600 hover:underline">مشاهده</a>
        </div>
        @endcan
        @can('manage-roles')
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">نقش های کاربری</h2>
            <p class="text-gray-600">مدیریت نقش کاربران</p>
            <a href="{{ route('dashboard.roles.index') }}" class="text-blue-600 hover:underline">مشاهده</a>
        </div>
        @endcan
        @can('manage-backup')
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-xl font-bold">پشتیبان‌گیری از دیتابیس</h2>
            <p class="text-gray-600">برای ذخیره یک نسخه از دیتابیس روی دکمه زیر کلیک کنید.</p>
            <form action="{{ route('dashboard.backup') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mt-2">
                    دانلود نسخه پشتیبان
                </button>
            </form>
        </div>
        @endcan
        
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">انتخاب قالب</h2>
            <form action="{{ route('dashboard.changeTheme') }}" method="POST">
                @csrf
                <select name="theme" class="border border-gray-300 rounded-lg px-4 py-2 mb-4">
                    <option value="default" {{ auth()->user()->theme === 'default' ? 'selected' : '' }}>قالب پیش‌فرض</option>
                    <option value="red" {{ auth()->user()->theme === 'red' ? 'selected' : '' }}>قالب قرمز</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    ذخیره
                </button>
            </form>
        </div>
        @can('manage-users')
            <!-- کارت مدیریت کاربران -->
            <div class="bg-white rounded-lg shadow-lg p-4">
                <h2 class="text-xl font-bold">مدیریت کاربران</h2>
                <p class="text-gray-600">ایجاد، ویرایش و حذف کاربران</p>
                <a href="{{ route('dashboard.users.index') }}" class="text-blue-600 hover:underline">
                    مشاهده
                </a>
            </div>
        @endcan
        
    </div>
</div>
@endsection
