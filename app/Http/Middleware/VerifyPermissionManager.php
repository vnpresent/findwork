<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyPermissionManager
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (auth('manager')->user()->hasPermission($permission))
            return $next($request);
        else
            return abort(403);
    }
}
