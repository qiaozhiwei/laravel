<?php

namespace App\Http\Controllers\cs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class dis extends Controller
{
    public function create_line(Request $request)
    {
        //所有线路
        $uid=$request->all()['uid']??"";
        if($uid==""){
            echo "uid为空";die;
        }
        // dd($uid);
        $data=DB::table("cs_line")->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            $arr[]=get_object_vars($v);
        }
        // dd($arr);
        $new_arr=[];
        foreach($arr as $k=>$v){
            $v['uid']=$uid;
            $new_arr[]=$v;
        }
        // dd($new_arr);
        //已添加线路
        $line_info = DB::table('cs_discount')
            ->leftJoin('cs_line','cs_discount.lid','=','cs_line.id')
            ->get()
            ->toarray();
        // dd($line_info);
        $new_info=[];
        foreach($line_info as $k=>$v){
            $new_info[]=get_object_vars($v);
        }
        // dd($new_info);
        return view("cs/create_line",['arr'=>$new_arr,"info"=>$new_info]);
    }

    public function docreate_line(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $arr=["lid"=>$data['lid'],'uid'=>$data['uid'],'discount'=>$data['discount']];
        // dd($arr);
        $res=DB::table("cs_discount")->insert($arr);
        // dd($res);
        if($res){
            //成功
            $where=[
                ['cs_discount.lid','=',$data['lid']],
            ];
            $info=DB::table('cs_discount')
            ->leftJoin('cs_line','cs_discount.lid','=','cs_line.id')
            ->where($where)
            ->first();
            $info=get_object_vars($info);
            // dd($info);
            $arr=['linename'=>$info['linename'],'linepirce'=>$info['lineprice'],'time'=>$info['time'],'discount'=>$info['discount']];
            // dd($arr);
            return json_encode(['code'=>1,'arr'=>$arr]);
            
        }else{
            //失败
            return json_encode(['code'=>2,'msg'=>"添加失败"]);
            
            
        }
    }
}
