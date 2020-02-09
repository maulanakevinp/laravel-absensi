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
            return ( $star = strpos($v, "*") ) ? ( substr(getenv('REMOTE_ADDR'), 0, $star) == substr($v, 0, $star) )
                                               : ( getenv('REMOTE_ADDR') == $v );
        }, $ips));

        return $access ? $next($request) : App::abort(403);
    }
}
