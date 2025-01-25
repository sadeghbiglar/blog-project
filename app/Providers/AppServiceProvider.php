<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function () {
            if (Auth::check()) {
                // زبان بر اساس جدول کاربران
                App::setLocale(Auth::user()->locale);
            } elseif (Session::has('locale')) {
                // زبان برای کاربران مهمان از سشن
                App::setLocale(Session::get('locale'));
            }
        });
    
    }
}
