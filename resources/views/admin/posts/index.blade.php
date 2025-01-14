@extends($layout)

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">مدیریت پست‌ها</h1>
    @can('create-posts')
    <!-- دکمه ایجاد پست جدید -->
    <a href="{{ route('dashboard.posts.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-block mb-4">
        ایجاد پست جدید
    </a>
@endcan
    <!-- جدول نمایش پست‌ها -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-center">
                    <th class="px-4 py-2 border border-gray-300">#</th>
                    <th class="px-4 py-2 border border-gray-300">عنوان</th>
                    <th class="px-4 py-2 border border-gray-300">دسته‌بندی</th>
                    <th class="px-4 py-2 border border-gray-300">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $key => $post)
                    <tr class="text-center">
                        <td class="px-4 py-2 border border-gray-300">{{ $posts->firstItem() + $key }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $post->title }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            {{ $post->category ? $post->category->name : 'بدون دسته‌بندی' }}
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            @can('edit-posts')
                            <!-- دکمه ویرایش -->
                            <a href="{{ route('dashboard.posts.edit', $post) }}" 
                               class="text-blue-600 hover:bg-blue-700 px-3 py-2 rounded-lg inline-block">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-4-4m0 0l4-4m-4 4h12" />
                            </svg>
                            </a>
                                @endcan
                                @can('delete-posts')
                            <!-- دکمه حذف -->
                            <form action="{{ route('dashboard.posts.destroy', $post) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" 
                                        class="text-red-600 hover:bg-red-700 px-3 py-2 rounded-lg inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 border border-gray-300 text-center text-gray-500">
                            هیچ پستی وجود ندارد.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- صفحه‌بندی -->
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
