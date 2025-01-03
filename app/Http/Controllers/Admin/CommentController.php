<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post', 'user')->latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
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
