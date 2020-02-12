<?php

namespace App\Http\Controllers\cs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class user extends Controller
{
    //用户添加
    public function create_user()
    {
        echo 111;
    }

    //用户列表

    public function list_user()
    {
        $data=DB::table("cs_user")->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            $arr[]=get_object_vars($v);
        }
        // dd($arr);
        $new_arr=[];
        foreach($arr as $k=>$v){
            $v["time"]=time();
            $v['dis']=111;
            // print_r($v);
            $new_arr[]=$v;
            
        }
        // dd($new_arr);
        return view("cs/list_user",['arr'=>$new_arr]);
    }

    //用户修改



    //用户删除


}
