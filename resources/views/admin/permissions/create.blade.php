@extends($layout)

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">ایجاد دسترسی جدید</h1>
    <form action="{{ route('dashboard.permissions.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">نام:</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">توضیحات:</label>
            <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ذخیره
        </button>
    </form>
</div>
@endsection
