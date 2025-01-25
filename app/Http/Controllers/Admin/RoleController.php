<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        $roles = Role::with('permissions')->paginate(10);
        return view('admin.roles.index', compact('roles','layout'));
    }

    public function create()
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions','layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
            'description' => 'nullable|string|max:255',
            'permissions' => 'array',
        ]);

        $role = Role::create($request->only('name', 'description'));
        $role->permissions()->sync($request->permissions);

        return redirect()->route('dashboard.roles.index')->with('success', 'نقش با موفقیت ایجاد شد.');
    }

    public function edit(Role $role)
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions','layout'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id . '|max:255',
            'description' => 'nullable|string|max:255',
            'permissions' => 'array',
        ]);

        $role->update($request->only('name', 'description'));
        $role->permissions()->sync($request->permissions);

        return redirect()->route('dashboard.roles.index')->with('success', 'نقش با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('dashboard.roles.index')->with('success', 'نقش با موفقیت حذف شد.');
    }
}
