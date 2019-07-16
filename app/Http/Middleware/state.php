<?php

namespace App\Http\Middleware;

use Closure;

class state
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
        $state=session('state');
        // dd($state);
        if($state!=1){ 
            return redirect('User/login');
        }
        return $next($request);
    }
}
