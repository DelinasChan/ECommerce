<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginMiddleWare
{
    /**
     * 登入驗證 middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   

        //尚未登入 重導向到登入頁面
        $user = session()->get("user");
        if( !$user ){
            return redirect("/member/login");
        }else{
            return $next($request);
        };

    }
}
