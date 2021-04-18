<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //未登入 重導向到登入頁面
        $user = Auth('login_user')->user();
        if ($user && $user->is_enabled) {
            return $next($request);
        } else {
            return redirect()->route('auth.login.view');
        };
    }
}
