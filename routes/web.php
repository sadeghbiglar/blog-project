<?php
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CategoryController;
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        // فقط مدیر به داشبورد دسترسی دارد
        if (Auth::check() && Auth::user()->is_admin) {
            return view('admin.dashboard'); // صفحه داشبورد مدیر
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

        Route::resource('categories', AdminCategoryController::class);
        Route::resource('comments', AdminCommentController::class);
    });
});
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
// Route::get('/', function () {
//     return view('home');
// })->name('home');
Route::resource('posts', PostController::class);
Route::get('/', [PostController::class, 'index'])->name('home');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::post('/likes', [LikeController::class, 'store'])->name('likes.store')->middleware('auth');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
