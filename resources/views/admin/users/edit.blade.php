@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">ویرایش کاربر: {{ $user->name }}</h1>
    <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">نام:</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name', $user->name) }}" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">ایمیل:</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email', $user->email) }}" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">رمز عبور جدید (در صورت نیاز):</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
       
        <div class="mb-4">
            <label for="roles" class="block text-gray-700 font-bold mb-2">نقش‌ها:</label>
            <select 
                name="roles[]" 
                id="roles" 
                multiple 
                class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" 
                        {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="abilities" class="block text-gray-700 font-bold mb-2">دسترسی‌ها:</label>
            <div class="flex flex-wrap">
                @foreach ($permissions as $permission)
                    <label class="mr-4 mb-2">
                        <input type="checkbox" name="abilities[]" value="{{ $permission->name }}"
                            {{ $user->hasPermission($permission->name) ? 'checked' : '' }}>
                        {{ $permission->description }}
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ذخیره تغییرات
        </button>
    </form>
</div>
@endsection

       