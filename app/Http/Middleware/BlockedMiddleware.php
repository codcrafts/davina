<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponses;
use Closure;
use Illuminate\Support\Facades\Auth;

class BlockedMiddleware
{
     use ApiResponses;

    public function handle($request, Closure $next)
    {
        if (Auth::check()&&Auth::user()->is_banned  == false)
            return $next($request);
        else
            return $this->apiResponse(null,trans('app.messages.in_active_user'),422);
    }
}
