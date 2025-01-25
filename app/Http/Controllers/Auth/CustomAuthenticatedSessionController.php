<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthenticatedSessionController
{
    public function destroy(Request $request)
    {
        // حذف سشن کاربر از Laravel
        Auth::guard('web')->logout();

        // حذف سشن مرورگر برای Google
        $googleLogoutUrl = 'https://accounts.google.com/Logout';
       /*    if (Auth::user()->google_id) {
        $googleLogoutUrl = 'https://accounts.google.com/Logout?continue=' . url('/');
    }  */
    
        // حذف سشن سمت سرور
        $request->session()->invalidate();
        $request->session()->regenerateToken();
       // $googleLogoutUrl = 'https://accounts.google.com/Logout?continue=' . urlencode(url('/'));

        // هدایت به صفحه خروج از Google
        return redirect($googleLogoutUrl);
    

    }
}
