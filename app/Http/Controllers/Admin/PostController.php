<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
   /*  public function __construct()
    {
        // فقط مدیر به این کنترلر دسترسی دارد
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
    } */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
    $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
    $query = Post::query();

    // جستجو بر اساس عنوان یا محتوا
    if ($request->has('search') && $request->search !== null) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
    }

    // گرفتن پست‌ها با صفحه‌بندی
    $posts = $query->latest()->paginate(10);
   // $posts = \App\Models\Post::with('category')->latest()->paginate(10);
    return view('admin.posts.index', compact('posts','layout'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        if (!Gate::allows('create-posts')) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
    
        $categories = \App\Models\Category::all(); // دریافت دسته‌بندی‌ها
        return view('admin.posts.create', compact('categories','layout'));
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
        'file' => 'nullable|mimes:pdf,docx,txt|max:2048', // اعتبارسنجی فایل
    ]);

    $imagePath = null;
    $filePath = null;

    // ذخیره تصویر
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    // ذخیره فایل
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('files', 'public');
    }

    Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'image' => $imagePath,
        'file' => $filePath, // ذخیره مسیر فایل
        'user_id' => auth()->id(), // مقداردهی user_id به کاربر فعلی
    ]);
    $response = Http::post("https://tapi.bale.ai/bot869096853:r9W6q195DomYh6lyRtF1nOZJn2SWPoigMxEepzrF/sendMessage", [
        'chat_id'=> '@logview',
         'text' => $request->content, // متن پیام
     ]);
     if ($response->successful()) {
        return redirect()->route('home')->with('success', 'پست با موفقیت ایجاد شد.');
     } 
    return redirect()->route('home')->with('success', 'پست با موفقیت ایجاد شد.');
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
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        if (!Gate::allows('edit-posts')) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
        $categories = \App\Models\Category::all(); // دریافت دسته‌بندی‌ها
        return view('admin.posts.edit', compact('post', 'categories','layout'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'file' => 'nullable|mimes:pdf,docx,txt|max:2048', // اعتبارسنجی فایل
        ]);
    
        $imagePath = $post->image;
        $filePath = $post->file;
    
        // به‌روزرسانی تصویر
        if ($request->hasFile('image')) {
            if ($post->image) {
                \Storage::disk('public')->delete($post->image); // حذف تصویر قدیمی
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        }
    
        // به‌روزرسانی فایل
        if ($request->hasFile('file')) {
            if ($post->file) {
                \Storage::disk('public')->delete($post->file); // حذف فایل قدیمی
            }
            $filePath = $request->file('file')->store('files', 'public');
        }
    
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'file' => $filePath, // به‌روزرسانی مسیر فایل
            'user_id' => auth()->id(), // مقداردهی user_id به کاربر فعلی

        ]);
    
        return redirect()->route('posts.index')->with('success', 'پست با موفقیت به‌روزرسانی شد.');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!Gate::allows('delete-posts')) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
        // حذف تصویر
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }
    
        // حذف فایل
        if ($post->file) {
            \Storage::disk('public')->delete($post->file);
        }
    
        $post->delete();
    
        return redirect()->route('posts.index')->with('success', 'پست با موفقیت حذف شد.');
    }
    
}
