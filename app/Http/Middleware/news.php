<?php

namespace App\Http\Middleware;

use Closure;

class news
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
        if (($request->session()->has('name'))==false) {
            return redirect('news/login');            
        }
        $response = $next($request);
        //之后
        // var_dump($request->session());
        return $response;
        
    }
}
