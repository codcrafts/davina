<?php

namespace App\Http\Middleware;

use Closure;

class ApiLangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = $request->header('lang')? $request->header('lang'):'ar';
        app()->setLocale($lang);
        return $next($request);
    }

}
