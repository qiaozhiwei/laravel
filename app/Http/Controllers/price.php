<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\wechat;

class price extends Controller
{
    public function get_info()
    {
        $key="c649b4de654d678c5ad3b633f13aab83";
        $url="http://apis.juhe.cn/cnoil/oil_city?key=$key";
        $re=file_get_contents($url);
        $re=json_decode($re,1);
        $oil_price=[];
        if($re!=[]){
            $oil_price=$re['result'];//全国油价的数组   
        }
        // dd($oil_price);
    }


    
    

    
    
}
