<?php
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RoleController;
use App\Http\Models\Permission;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\BackupController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['fa', 'en', 'ar'])) { // زبان‌های مجاز
        if (Auth::check()) {
            // اگر کاربر لاگین است، زبان در جدول ذخیره می‌شود
            Auth::user()->update(['locale' => $locale]);
            
        } else {
            // زبان به سشن برای کاربران مهمان ذخیره می‌شود
            session(['locale' => $locale]);
        }
        app()->setLocale($locale); // تنظیم زبان برای این درخواست
    }
    return redirect()->back(); // بازگشت به صفحه قبلی
})->name('set-locale');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        
        if (Auth::check() ) {
            $theme = Auth::user()->theme; // دریافت قالب از دیتابیس
            $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
            return view('admin.dashboard',compact('layout')); // صفحه داشبورد مدیر
        }
        return redirect('/'); // بازگشت به صفحه اصلی برای کاربران عادی
    })->name('dashboard');

    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [AdminPostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
        Route::post('/backup', [BackupController::class, 'createBackup'])->name('backup')->middleware('auth');

        Route::resource('categories', AdminCategoryController::class);
        Route::resource('comments', AdminCommentController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
        ->middleware('can:manage-users'); 
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)
        ->middleware(['auth', 'can:manage-roles']);
        Route::resource('permissions', \App\Http\Controllers\Admin\PermisionController::class)
        ->middleware(['auth', 'can:manage-permisions']);

         // روت تغییر قالب
        Route::post('/change-theme', function (\Illuminate\Http\Request $request) {
        $request->validate(['theme' => 'required|string|in:default,red']);

        $user = Auth::user();

       /*  // بررسی ادمین بودن کاربر
        if (!$user->is_admin) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        } */

        $user->theme = $request->theme;
        $user->save();

        return redirect()->back()->with('success', 'قالب با موفقیت تغییر کرد.');
        })->name('changeTheme');
    });
});
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/archive/{year}', [PostController::class, 'archive'])->name('archive');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::post('/likes', [LikeController::class, 'store'])->name('likes.store')->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // ارسال ایمیل (اختیاری)
    Mail::raw($request->message, function ($mail) use ($request) {
        $mail->to('sbmail555@gmail.com')
             ->from($request->email, $request->name)
             ->subject('پیام جدید از فرم تماس');
    });

    return back()->with('success', 'پیام شما ارسال شد!');
})->name('contact.submit');


use App\Http\Controllers\Auth\GoogleController;

Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

use App\Http\Controllers\Auth\CustomAuthenticatedSessionController;

// غیرفعال کردن روت پیش‌فرض
//Route::post('/logout', [CustomAuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
/*  Route::get('/', function () {
     return view('home');
 })->name('home'); */

//Route::resource('posts', PostController::class);
//Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');

