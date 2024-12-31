<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $like = Like::where('post_id', $request->post_id)
                    ->where('user_id', auth()->id())
                    ->first();

        if ($like) {
            // اگر لایک قبلاً وجود داشته باشد، آن را حذف کن
            $like->delete();
            return response()->json(['status' => 'unliked']);
        } else {
            // اگر لایک وجود نداشته باشد، آن را ایجاد کن
            Like::create([
                'post_id' => $request->post_id,
                'user_id' => auth()->id(),
            ]);
            return response()->json(['status' => 'liked']);
        }
    }
}
