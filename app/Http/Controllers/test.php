<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class test extends Controller
{
    public function index()
    {
        $data=DB::table('test')->get();
        // dd($data);
        return view('test_index',['data'=>$data]);
    }
    public function add()
    {
        return view('test_add');   
    }
    public function doadd(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $arr['name']=$data['name'];
        $arr['select']=$data['select'];
        $url="www.laravel.com/test/index";
        $arr['url']=$url;
        $str="";
        if(is_array($data['block'])){
            // dd($data['block']);
            $str=implode($data['block'],',');
            // dd($str);
            $arr['value']=$str;
        }else{
            $arr['value']=$data['block'][0];
        }
        // dd($arr);
        $res=DB::table('test')->insert($arr);
        // dd($res);
        if($res){
            echo json_encode(['code'=>1,'msg'=>'添加成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'添加失败']);
        }
    }

    public function test()
    {
        $data=DB::table('test')->get();
        return view('test_test',['data'=>$data]);
    }
    public function dotest(Request $request)
    {
        $data=$request->all();
        $value=json_encode($data['array']);
        // dd($value);
        $arr=['name'=>$data['name'],'value'=>$value];
        // dd($arr);
        $res=DB::table('juan')->insert($arr);
        // dd($res);
        if($res){
            echo json_encode(['code'=>1,'msg'=>'添加成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'添加失败']);
        }
        
    }

    public function list()
    {
        $data=DB::table('juan')->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            $v=get_object_vars($v);
            $arr['value']=json_decode($v['value'],1);
        }
        // dd($arr);
        return view('test_list',['data'=>$data,'arr'=>$arr]);
    }

    public function pro(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['id','=',$id],
        ];
        $data=DB::table('juan')->where($where)->first();
        // dd($data);
        $data=get_object_vars($data);
        // dd($data);
        $arr=json_decode($data['value']);
        $arr=implode(',',$arr);
        // dd($arr);
        return view('test_pro',['data'=>$data,'arr'=>$arr]);
    }
}
