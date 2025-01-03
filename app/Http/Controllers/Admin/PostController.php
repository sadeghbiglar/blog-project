<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        // فقط مدیر به این کنترلر دسترسی دارد
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $posts = \App\Models\Post::with('category')->latest()->paginate(10);
    return view('admin.posts.index', compact('posts'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all(); // دریافت دسته‌بندی‌ها
        return view('admin.posts.create', compact('categories'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
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
    
        \App\Models\Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('dashboard.posts.index')->with('success', 'پست با موفقیت ایجاد شد.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Post $post)
    {
        $categories = \App\Models\Category::all(); // دریافت دسته‌بندی‌ها
        return view('admin.posts.edit', compact('post', 'categories'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Post $post)
{
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // حذف تصویر قبلی
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }
        $post->image = $request->file('image')->store('posts', 'public');
    }

    $post->update([
        'title' => $request->title,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'image' => $post->image,
    ]);

    return redirect()->route('dashboard.posts.index')->with('success', 'پست با موفقیت به‌روزرسانی شد.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Post $post)
{
    if ($post->image) {
        \Storage::disk('public')->delete($post->image); // حذف تصویر از فایل‌ها
    }
    $post->delete();

    return redirect()->route('dashboard.posts.index')->with('success', 'پست با موفقیت حذف شد.');
}

}
