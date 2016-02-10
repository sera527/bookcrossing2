<?php

namespace Bookcrossing\Http\Middleware;

use Closure;
use Fenos\Notifynder\Facades\Notifynder;

class NumberOfNotifications
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
        session()->put('count', Notifynder::countNotRead(session()->get('VKusr')));
        return $next($request);
    }
}
