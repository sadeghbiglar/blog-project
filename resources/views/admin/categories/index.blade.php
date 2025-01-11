@extends($layout)

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">مدیریت دسته‌بندی‌ها</h1>

    <!-- دکمه ایجاد دسته‌بندی جدید -->
    <a href="{{ route('dashboard.categories.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-block mb-4">
        ایجاد دسته‌بندی جدید
    </a>

    <!-- جدول نمایش دسته‌بندی‌ها -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-center">
                    <th class="px-4 py-2 border border-gray-300">#</th>
                    <th class="px-4 py-2 border border-gray-300">نام</th>
                    <th class="px-4 py-2 border border-gray-300">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $key => $category)
                    <tr class="text-center">
                        <td class="px-4 py-2 border border-gray-300">{{ $categories->firstItem() + $key }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $category->name }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            <!-- دکمه ویرایش -->
                            <a href="{{ route('dashboard.categories.edit', $category) }}" 
                               class="text-blue-600 hover:underline">
                               ویرایش
                            </a>

                            <!-- دکمه حذف -->
                            <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" class="text-red-600 hover:underline">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 border border-gray-300 text-center text-gray-500">
                            هیچ دسته‌بندی وجود ندارد.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- صفحه‌بندی -->
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection
