<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        // فقط مدیر به این کنترلر دسترسی دارد
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
    }
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'دسته‌بندی با موفقیت ایجاد شد.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'دسته‌بندی با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
}
