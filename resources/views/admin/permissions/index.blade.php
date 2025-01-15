@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">مدیریت دسترسی‌ها</h1>
    <a href="{{ route('dashboard.permissions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mb-4 inline-block">
        ایجاد دسترسی جدید
    </a>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">نام</th>
                    <th class="px-4 py-2">توضیحات</th>
                    <th class="px-4 py-2">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $permission->name }}</td>
                        <td class="px-4 py-2 border">{{ $permission->description ?? 'ندارد' }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('dashboard.permissions.edit', $permission) }}" class="text-blue-600 hover:underline">ویرایش</a>
                            <form action="{{ route('dashboard.permissions.destroy', $permission) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                        onclick="return confirm('آیا از حذف این دسترسی مطمئن هستید؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500">هیچ دسترسی‌ای یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $permissions->links() }}
    </div>
</div>
@endsection
