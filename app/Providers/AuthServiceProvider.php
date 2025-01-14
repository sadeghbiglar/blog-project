<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
       /*  $this->registerPolicies();

        // تعریف توانایی‌ها
        Gate::define('manage-users', function ($user) {
            return $user->roles->contains('name', 'مدیر کل'); // فقط مدیر کل
        }); */
        $this->registerPolicies();

        // تعریف توانایی برای مدیریت کاربران
        Gate::define('manage-users', function ($user) {
            // بررسی اینکه کاربر نقش مدیر کل دارد
            return $user->hasRole('admin');
        });

    // تعریف دسترسی‌ها
    Gate::define('create-posts', function ($user) {
        return $user->hasPermission('create-posts');
    });

    Gate::define('edit-posts', function ($user) {
        return $user->hasPermission('edit-posts');
    });

    Gate::define('delete-posts', function ($user) {
        return $user->hasPermission('delete-posts');
    });
/* 
    Gate::define('manage-users', function ($user) {
        return $user->hasPermission('manage-users');
    }); */
    }
}
