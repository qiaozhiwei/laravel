<?php

namespace App\Http\Middleware;

use Closure;

class islogin
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
        if (($request->session()->has('index_userName'))==false) {
            // echo 111;
            // dd($request->session('user_name'));
            return redirect('live_user/index_login');
        }
        return $next($request);
    }
}
