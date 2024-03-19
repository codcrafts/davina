<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponses;
use Closure;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    use ApiResponses;
    public function handle($request, Closure $next)
    {
        if (Auth::check()&&Auth::user()->type  == 'client' )
            return $next($request);
        else
            return  $this->apiResponse(null,trans('app.messages.not_allowed_to_login'),403);

    }
}
