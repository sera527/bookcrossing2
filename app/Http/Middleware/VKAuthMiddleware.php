<?php

namespace Bookcrossing\Http\Middleware;

use Closure;

class VKAuthMiddleware
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
        if (!session()->has('VKusr'))
        {
            return redirect('auth');
        }
        return $next($request);
    }
}
