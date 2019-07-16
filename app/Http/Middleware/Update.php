<?php

namespace App\Http\Middleware;

use Closure;

class Update
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
        $time=time();
        // dd(date('H:s',$time));
        $a=1563152429;
        $b=1563181202;
        if($time<$a){
            echo "还没到09:00,商品修改需要在【9:00-17:00】才可以进入";die;
        }else if($time>$b){
            echo "已经过了17:00了,商品修改需要在【9:00-17:00】才可以进入";die;
        }
        

        return $next($request);
    }
}
