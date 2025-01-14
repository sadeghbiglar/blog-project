@extends($layout)

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">مدیریت کاربران</h1>
    @can('create-user')
    <a href="{{ route('dashboard.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mb-4 inline-block">
        ایجاد کاربر جدید
    </a>
    @endcan
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-gray-700 border">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">نام</th>
                    <th class="px-4 py-2">ایمیل</th>
                    <th class="px-4 py-2">نقش‌ها</th>
                    <th class="px-4 py-2">دسترسی‌ها</th>
                    <th class="px-4 py-2">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td class="px-4 py-2 border">
                            {{ optional($user->permissions)->pluck('name')->join(', ') ?? 'بدون دسترسی' }}
                        </td>
                                               
                        <td class="px-4 py-2 border">
                            @can('edit-user')
                            <!-- لینک ویرایش کاربر -->
                            <a href="{{ route('dashboard.users.edit', $user) }}" class="text-blue-600 hover:underline">ویرایش</a>
                            @endcan
                            @can('delete-user')
                            <!-- فرم حذف کاربر -->
                            <form 
                            action="{{ route('dashboard.users.destroy', $user) }}" 
                            method="POST" 
                            class="inline-block"
                            onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این کاربر را حذف کنید؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">حذف</button>
                        </form>
                        @endcan
                        
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500">هیچ کاربری یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
