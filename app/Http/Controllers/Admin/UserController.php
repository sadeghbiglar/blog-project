<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class UserController extends Controller
{
    // نمایش لیست کاربران
    public function index()
    {
        if (!Gate::allows('manage-users')) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        // بارگذاری رابطه permissions
    $users = User::with(['roles', 'permissions'])->paginate(10);

    return view('admin.users.index', compact('users','layout'));
    }

    // نمایش فرم ایجاد کاربر جدید
    public function create()
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        $roles = Role::all();
        return view('admin.users.create', compact('roles','layout'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'required|array',
           
        ]);
    
        // ایجاد کاربر جدید
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        // تخصیص نقش‌ها به کاربر
        $user->roles()->sync($request->roles);
    
    

        return redirect()->route('dashboard.users.index')->with('success', 'کاربر با موفقیت ایجاد شد.');
    }
    
    // نمایش فرم ویرایش کاربر
    public function edit(User $user)
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions','layout'));
    }
    

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'roles' => 'required|array',
       
    ]);

    // به‌روزرسانی اطلاعات کاربر
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    if ($request->filled('password')) {
        $user->update([
            'password' => bcrypt($request->password),
        ]);
    }

    // تخصیص نقش‌ها به کاربر
    $user->roles()->sync($request->roles);

   

    return redirect()->route('dashboard.users.index')->with('success', 'اطلاعات کاربر با موفقیت به‌روزرسانی شد.');
}


    // حذف کاربر
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('success', 'کاربر با موفقیت حذف شد.');
    }
}
