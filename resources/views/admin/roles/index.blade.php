@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">مدیریت نقش‌ها</h1>
    <a href="{{ route('dashboard.roles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mb-4 inline-block">
        ایجاد نقش جدید
    </a>
    <div class="overflow-x-auto ">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-gray-700 border-gray-300">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">نام</th>
                    <th class="px-4 py-2">توضیحات</th>
                    <th class="px-4 py-2">دسترسی‌ها</th>
                    <th class="px-4 py-2">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $role->name }}</td>
                        <td class="px-4 py-2 border">{{ $role->description ?? 'ندارد' }}</td>
                        <td class="px-4 py-2 border">{{ $role->permissions->pluck('description')->join(', ') }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('dashboard.roles.edit', $role) }}" class="text-blue-600 hover:underline">ویرایش</a>
                            <form action="{{ route('dashboard.roles.destroy', $role) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" 
                                        onclick="return confirm('آیا از حذف این نقش مطمئن هستید؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500">هیچ نقشی یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $roles->links() }}
    </div>
</div>
@endsection
