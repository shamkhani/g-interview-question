<?php

namespace App\Http\Middleware;

use Closure;

class ActiveCustomCacheMiddleware
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
        $response = $next($request);
        $response->header('X-Active-Custom-Cache', '1');
        return $response;
    }
}
