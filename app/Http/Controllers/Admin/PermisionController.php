<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
class PermisionController extends Controller
{
     // نمایش لیست دسترسی‌ها
    public function index()
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        $permissions = Permission::paginate(10); // صفحه‌بندی دسترسی‌ها
        return view('admin.permissions.index', compact('permissions','layout'));
    }

    // نمایش فرم ایجاد دسترسی جدید
    public function create()
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        return view('admin.permissions.create',compact('layout'));
    }

    // ذخیره دسترسی جدید
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'description' => 'nullable|string|max:255',
        ]);

        Permission::create($request->only(['name', 'description']));

        return redirect()->route('dashboard.permissions.index')->with('success', 'دسترسی با موفقیت ایجاد شد.');
    }

    // نمایش فرم ویرایش دسترسی
    public function edit(Permission $permission)
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        return view('admin.permissions.edit', compact('permission','layout'));
    }

    // به‌روزرسانی دسترسی
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'description' => 'nullable|string|max:255',
        ]);

        $permission->update($request->only(['name', 'description']));

        return redirect()->route('dashboard.permissions.index')->with('success', 'دسترسی با موفقیت به‌روزرسانی شد.');
    }

    // حذف دسترسی
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('dashboard.permissions.index')->with('success', 'دسترسی با موفقیت حذف شد.');
    }
}
