<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\user;

class member extends Controller
{
    /*
        查询会员数据表
    */
    public function show()
    {
        $user=new user;
        // dd($user);
        $user_info=$user->get()->toarray();
        // dd($user_info);
        return json_encode($user_info);
    }

    public function get_info()
    {
        $url="123.57.18.167/member/show";
        $re= file_get_contents($url);
        // dd($re);
    }
}
