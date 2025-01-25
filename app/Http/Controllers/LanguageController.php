<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // بررسی اینکه زبان انتخابی مجاز است
        if (in_array($locale, ['en', 'fa', 'ar'])) {
            Session::put('locale', $locale); // ذخیره زبان در سشن
            app()->setLocale($locale); // تنظیم زبان برنامه
        }

        return redirect()->back(); // بازگشت به صفحه قبلی
    }
}
