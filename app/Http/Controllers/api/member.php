<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\user;
use App\Http\Model\Goods;
use App\Http\Controllers\wechat;

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
        $url="http://123.57.18.167/member/show";
        $re= file_get_contents($url);
        // dd($re);
    }


    public function get_GoodsInfo(wechat $wechat)
    {
        //传good_name
        $url="http://123.57.18.167/member/Goods_info";
        $data=['goods_name'=>'茶几'];
        $re=$wechat->post($url,json_encode($data));
        dd($re);
        
        
    }

    public function Goods_info()
    {
        $good_name=file_get_contents("input://php")??"";
        // dd($good_name);
        // $good_name="茶几";
        if(empty($good_name)){
            return "110";die;
        }
        $good=new Goods;
        // dd($good);
        $where=[
            ['goods_name','=',$good_name],
        ];
        $data=$good->where($where)->first();
        return json_encode($data);
    }
}
    