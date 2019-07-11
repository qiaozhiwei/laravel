<?php

namespace App\Http\Middleware;

use Closure;

class login
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
        //之前
        if (($request->session()->has('user_name'))==false) {
            // echo 111;
            // dd($request->session());
            return redirect('StudentController/login');
        }
        $response = $next($request);
        //之后
        // var_dump($request->session());
        return $response;
    }
}
