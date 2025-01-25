@extends($layout)

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
                        <td class="px-4 py-2 border border-gray-300 flex items-center justify-center">
                            <a href="{{ route('dashboard.comments.edit', $comment) }}" class="text-blue-600 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                  </svg>
                                  
                            </a>
                            <form action="{{ route('dashboard.comments.destroy', $comment) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                      </svg>
                                      
                                </button>
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
