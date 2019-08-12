<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Controllers\wechat;

class ceshi extends Controller
{
    
    public function a(wechat $wechat)
    {
        $access_token=$this->wechat->access_token();
        dd($access_token);
    }
}
