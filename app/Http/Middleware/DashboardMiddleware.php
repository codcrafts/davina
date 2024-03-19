<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponses;
use Closure;
use Illuminate\Support\Facades\Auth;

class DashboardMiddleware
{
    use ApiResponses;

    public function handle($request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->type == 'superadmin' || auth()->user()->type == 'admin' ))
            return $next($request);
        else
            return  $this->apiResponse(null,trans('app.messages.not_allowed_to_login'),403);
    }
}
