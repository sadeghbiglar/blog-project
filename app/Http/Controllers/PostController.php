<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // نمایش لیست پست‌ها
    public function index(Request $request)
    {
        $query = Post::query();

    if ($request->has('search') && $request->search) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
    }

    $posts = $query->latest()->paginate(10);
        return view('home', compact('posts'));
    }

    // نمایش فرم ایجاد پست
    public function create()
    {
        $categories = \App\Models\Category::all(); // دریافت تمام دسته‌بندی‌ها
        return view('posts.create', compact('categories'));
    }

    // ذخیره پست جدید
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }
    
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('home')->with('success', 'پست با موفقیت ایجاد شد.');
    }
    
    // نمایش یک پست خاص
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // ویرایش پست
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // به‌روزرسانی پست
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'پست با موفقیت به‌روزرسانی شد.');
    }

    // حذف پست
    public function destroy(Post $post)
    {
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'پست با موفقیت حذف شد.');
    }

}
