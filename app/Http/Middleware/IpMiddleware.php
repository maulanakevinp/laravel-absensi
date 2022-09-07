<?php

namespace App\Http\Middleware;

use App;
use Closure;

class IpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$ips)
    {
        $access = array_filter(array_map(function($v){
            return ( $star = strpos($v, "*") ) ? ( substr(request()->ip(), 0, $star) == substr($v, 0, $star) )
                                               : ( request()->ip() == $v );
        }, $ips));

        return $access ? $next($request) : App::abort(403);
    }
}
