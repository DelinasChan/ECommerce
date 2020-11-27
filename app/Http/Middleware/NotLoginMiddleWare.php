<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotLoginMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //已登入 重導向到首頁
        $user = session()->get("user");
        if( $user ){
            return redirect("/");
        };
        return $next($request);
    }
}
