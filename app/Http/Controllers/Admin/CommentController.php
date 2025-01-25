<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
       
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        $comments = Comment::with('post', 'user')->latest()->paginate(10);
        return view('admin.comments.index', compact('comments','layout'));
    }

    public function edit(Comment $comment)
    {
        $theme = auth()->check() ? auth()->user()->theme : 'default'; // بررسی قالب کاربر
        $layout = $theme === 'red' ? 'layouts.app_red' : 'layouts.app_default';
        return view('admin.comments.edit', compact('comment','layout'));
    }

    public function update(Request $request, Comment $comment)
{
    $request->validate([
        'approved' => 'required|boolean', // اعتبارسنجی فیلد
    ]);

    $comment->update([
        'approved' => $request->approved, // به‌روزرسانی مقدار
    ]);

    return redirect()->route('dashboard.comments.index')->with('success', 'وضعیت نظر با موفقیت به‌روزرسانی شد.');
}


    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('dashboard.comments.index')->with('success', 'نظر با موفقیت حذف شد.');
    }
}
