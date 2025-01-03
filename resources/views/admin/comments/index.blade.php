@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">مدیریت نظرات</h1>

    <!-- جدول نمایش نظرات -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-center">
                    <th class="px-4 py-2 border border-gray-300">#</th>
                    <th class="px-4 py-2 border border-gray-300">کاربر</th>
                    <th class="px-4 py-2 border border-gray-300">پست</th>
                    <th class="px-4 py-2 border border-gray-300">نظر</th>
                    <th class="px-4 py-2 border border-gray-300">وضعیت</th>
                    <th class="px-4 py-2 border border-gray-300">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $key => $comment)
                    <tr class="text-center">
                        <td class="px-4 py-2 border border-gray-300">{{ $comments->firstItem() + $key }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $comment->user->name }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $comment->post->title }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ Str::limit($comment->content, 50) }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            {{ $comment->approved ? 'تأیید شده' : 'در انتظار تأیید' }}
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            <a href="{{ route('dashboard.comments.edit', $comment) }}" class="text-blue-600 hover:underline">ویرایش</a>
                            <form action="{{ route('dashboard.comments.destroy', $comment) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 border border-gray-300 text-center text-gray-500">
                            هیچ نظری وجود ندارد.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- صفحه‌بندی -->
    <div class="mt-6">
        {{ $comments->links() }}
    </div>
</div>
@endsection
