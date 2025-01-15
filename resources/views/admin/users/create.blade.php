@extends($layout)

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">ایجاد کاربر جدید</h1>
    <form action="{{ route('dashboard.users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">نام:</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">ایمیل:</label>
            <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">رمز عبور:</label>
            <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="roles" class="block text-gray-700 font-bold mb-2">نقش‌ها:</label>
            <select name="roles[]" id="roles" multiple class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
       
        
        
        
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ذخیره
        </button>
    </form>
</div>
@endsection
