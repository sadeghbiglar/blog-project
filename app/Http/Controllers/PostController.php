<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    // نمایش لیست پست‌ها
    public function index(Request $request)
{
  //  dd(Session::get('locale'));
    $query = Post::query();

    if ($request->has('search') && $request->search) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
    }

    $latestPosts = Post::latest()->take(10)->get();
    $posts = $query->latest()->paginate(10);

    if (!request()->hasCookie('visited_site')) {
        \App\Models\SiteStatistic::firstOrCreate(['id' => 1])
            ->increment('total_views');
        cookie()->queue('visited_site', true, 1440);
    }
    $totalViews = \App\Models\SiteStatistic::first()->total_views ?? 0;

    $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
    $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';

    if (!view()->exists($layout)) {
        abort(500, 'قالب انتخاب شده وجود ندارد.');
    }

    return view('home', compact('posts', 'latestPosts', 'totalViews', 'layout'));
}

/*     public function index(Request $request)
    {
        $query = Post::query();

    if ($request->has('search') && $request->search) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
    }
    $latestPosts = Post::latest()->take(10)->get();
    $posts = $query->latest()->paginate(10);
    $totalViews = \App\Models\SiteStatistic::first()->total_views ?? 0; // بازدید کل سایت

    if (!request()->hasCookie('visited_site')) {
        \App\Models\SiteStatistic::firstOrCreate(['id' => 1])
            ->increment('total_views');

        // تنظیم Cookie با اعتبار 24 ساعت
        cookie()->queue('visited_site', true, 1440); // 1440 دقیقه = 24 ساعت
    }
    $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
    $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        return view('home', compact('posts','latestPosts', 'totalViews','layout'));
    } */

    // نمایش فرم ایجاد پست
    public function create()
    {
        if (!Gate::allows('create-posts')) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        $categories = \App\Models\Category::all(); // دریافت تمام دسته‌بندی‌ها
        return view('posts.create', compact('categories','layout'));
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
            'content' =>Purifier::clean($request->content) ,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'user_id' => auth()->id(), // مقداردهی user_id به کاربر فعلی

        ]);
    
        return redirect()->route('home')->with('success', 'پست با موفقیت ایجاد شد.');
    }
    
    // نمایش یک پست خاص
  /*   public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    } */
    public function show(Post $post)
    {
        // پست‌های مرتبط
        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id) // حذف پست فعلی
                            ->latest()
                            ->take(5)
                            ->get();
    
        // ده پست آخر
        $latestPosts = Post::latest()->take(10)->get();
    // افزایش تعداد بازدید
        $post->increment('views');
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        return view('posts.show', compact('post', 'relatedPosts', 'latestPosts','layout'));
    }

    //آرشیو تقویمی
    public function archive($year)
{
    // فیلتر کردن پست‌ها بر اساس سال
    $posts = Post::whereYear('created_at', $year)->latest()->paginate(10);
    $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
    $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
    return view('posts.archive', compact('posts', 'year','layout'));
}

    // ویرایش پست
    public function edit(Post $post)
    {
        if (!Gate::allows('edit-posts')) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        return view('posts.edit', compact('post','layout'));
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
            'content' =>Purifier::clean($request->content) ,
            'image' => $imagePath,
            'user_id' => auth()->id(), // مقداردهی user_id به کاربر فعلی

        ]);

        return redirect()->route('posts.index')->with('success', 'پست با موفقیت به‌روزرسانی شد.');
    }

    // حذف پست
    public function destroy(Post $post)
    {
        if (!Gate::allows('delete-posts')) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'پست با موفقیت حذف شد.');
    }

}
