<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // ریدایرکت کاربر به صفحه ورود Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // دریافت اطلاعات کاربر پس از ورود موفق
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // بررسی اینکه آیا کاربر قبلاً ثبت‌نام کرده است یا خیر
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // اگر کاربر جدید باشد، آن را در دیتابیس ذخیره می‌کنیم
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('default-password'), // در صورت نیاز
                ]);
            }else {
                // اگر کاربر وجود دارد، google_id را به‌روزرسانی کنید
                $user->update([
                    'google_id' => $googleUser->id,
                ]);
            }
            

            // ورود کاربر به سیستم
            Auth::login($user);

            return redirect('/'); // هدایت کاربر به داشبورد یا هر صفحه دیگر
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'خطایی در ورود به سیستم رخ داده است.');
        }
    }
}
