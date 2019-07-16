<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Goods;
use DB;

class IndexController extends Controller
{
    public function index(Request $_request)
    {
        $where=[
            ['is_new','=',1],
        ];
        $data=DB::table('goods')->where($where)->get();
        // dd($data);
        $where1=[
            ['is_hot','=',1],
        ];
        $arr=DB::table('goods')->where($where1)->get();
        // dd($arr);
        return view('aindex',['data'=>$data],['arr'=>$arr]);
    }

    public function pro(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['id','=',$id],
        ];
        $data=DB::table('goods')->where($where)->first();
        // dd($data);
        return view('pro',['data'=>$data,'id'=>$id]);
    }
}
