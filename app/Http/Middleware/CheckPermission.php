<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!Gate::allows($permission)) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }

        return $next($request);
    }
}
