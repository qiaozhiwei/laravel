<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Model\Goods;
class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $sr=$request->all()['sr']??"";
        // var_dump($sr);
        // dd($sr);
        $where=[
            ['goods_name','like',"%{$sr}%"],
        ];
        // dd($where);
        $data=DB::table('goods')->where($where)->paginate(3);
        // dd($data);
        return view('index',['data'=>$data]);
    }

    public function add()
    {
        return view('add');
    }
    public function doadd(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $path=$request->file('goods_pic')->store('good_img');
        // dd($path);
        $goods_pic=('/storage/'.$path);
        // dd($goods_pic);
        $arr=['goods_name'=>$data['goods_name'],'goods_pic'=>$goods_pic,'goods_price'=>$data['goods_price'],'add_time'=>time()];
        // dd($arr);

        $res=DB::table('goods')->insert($arr);
        // dd($res);
        if($res){
            return redirect('Goods/index');
        }else{
            echo "false";
        }
    }

    public function del(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $res=DB::table('goods')->delete($id);
        // dd($res);
        if($res){
            return redirect('Goods/index');
        }else{
            echo "false";
        }
    }

    public function update(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=['id'=>$id];
        $data=DB::table('goods')->where($where)->first();
        // dd($data);
        return view('update',['data'=>$data]);
    }

    public function doupdate(Request $request)
    {
        $files=$request->file('goods_pic');
        // dd($files);
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['id','=',$id],
    ];
        //如果提交过来的是空的文件就报false，若不是就重新上传
        if(empty($files)){
            echo "false";
        }else{
            // dd($files);
            $path=$request->file('goods_pic')->store('good_img');
            // dd($path);
            $goods_pic=('/storage/'.$path);
            // dd($goods_pic);
            $arr=['goods_pic'=>$goods_pic];
            // dd($arr);
            $res=DB::table('goods')->where($where)->update($arr);
            // dd($res);
        }
        $data=$request->all();
        // dd($data);
        $arr1=['goods_name'=>$data['goods_name'],'goods_price'=>$data['goods_price'],'add_time'=>time()];
        // dd($arr1);
        $res=DB::table('goods')->where($where)->update($arr1);
        // dd($res);
        if($res){
            return redirect('Goods/index');
        }else{
            echo "false";
        }
    }
}
