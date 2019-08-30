<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class sign extends Controller
{
    public function create_menu()
    {
        return view('sign_create_menu');
    }

    public function index(Request $request)
    {
        $goods_name=$request->all()['goods_name']??"";
        // var_dump($goods_name);
        $goods_price=$request->all()['goods_price']??"";
        // print_r($goods_price);
        $where=[];
        if($goods_name!=""){
            $where[]=
                ['goods_name','like',"%$goods_name%"];
            
        }
        if($goods_price!=""){
            $where[]=
                ['goods_price','=',$goods_price];
            
        }
        
        echo "<pre>";
        // print_r($where);die;
        $data=DB::table('goods')->where($where)->paginate(3);
        // dd($data);
        return view('sign_index',['data'=>$data,'goods_name'=>$goods_name,'goods_price'=>$goods_price]);
    }
}
