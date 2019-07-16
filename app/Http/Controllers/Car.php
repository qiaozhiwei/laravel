<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Car extends Controller
{
    
    public function index()
    {
        $data=DB::table('cart')->get();
        // dd($data);
        return view('Car_index',['data'=>$data]);
    }

    public function create(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['id','=',$id],
        ];
        // dd($where);
        $data=DB::table('goods')->where($where)->first();
        // dd($data);
        $data=get_object_vars($data);
        // dd($data);
        $w=[
            ['goods_id','=',$data['id']],
        ];
        $uid=session('uid');
        // dd($uid);
        $arr=[
            'uid'=>$uid,
            'goods_id'=>$data['id'],
            'goods_name'=>$data['goods_name'],
            'goods_pic'=>$data['goods_pic'],
            'goods_price'=>$data['goods_price'],
            'add_time'=>$data['add_time'],
            'goods_number'=>$data['number'],
        ];
        // dd($arr);
        $wheres=[
            ['goods_id','=',$id],
        ];
        // dd($goods_number);
        $goods_number=$data['number']+1;
        // dd($wheres);
        $count=DB::table('cart')->where($wheres)->count();
        // DB::enableQueryLog();
        // dd($count);
        if($count>0){
            $res=DB::table('cart')->where($w)->increment('goods_number');
            echo json_encode(['code'=>1,'msg'=>'增加购买数量']);die;
            // print_r(DB::getQueryLog());die;
            // dd($res);
        }else{
            // echo 222;die;
            $res=DB::table('cart')->insert($arr);
            // echo $res;
            // dd($res);
        }
        
        if($res){
            echo json_encode(['code'=>1,'msg'=>'加入购物车成功']);die;
        }else{
            echo json_encode(['code'=>2,'msg'=>'加入购物车失败']);die;  
        }
        
        
    }   
}
