<?php

namespace App\Http\Middleware;

use Closure;

class live_users
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
        if (($request->session()->has('user_name'))==false) {
            // echo 111;
            // dd($request->session('user_name'));
            return redirect('live_user/login');
        }
        // echo 1111;die;
        return $next($request);
    }
}
