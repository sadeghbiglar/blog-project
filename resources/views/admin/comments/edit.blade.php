@extends($layout)

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">ویرایش نظر</h1>

    <form action="{{ route('dashboard.comments.update', $comment) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')
    
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">متن نظر:</label>
            <textarea id="content" name="content" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" readonly>{{ $comment->content }}</textarea>
        </div>
    
        <div class="mb-4">
            <label for="approved" class="block text-sm font-medium text-gray-700">وضعیت:</label>
            <select id="approved" name="approved" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg">
                <option value="1" {{ $comment->approved ? 'selected' : '' }}>تأیید شده</option>
                <option value="0" {{ !$comment->approved ? 'selected' : '' }}>در انتظار تأیید</option>
            </select>
        </div>
    
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">ذخیره</button>
    </form>
    
</div>
@endsection
