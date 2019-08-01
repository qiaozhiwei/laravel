<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class news extends Controller
{
    public function index(Request $request)
    {
        $a=$request->session()->get('name');
        // dd($a);
        $data=DB::table('news')->paginate(3);
        // dd($data);
        return view('news_index',['data'=>$data]);
    }

    public function add()
    {
        return view('news_add');
    }
    public function doadd(Request $request)
    {
        $data=$request->post();
        // dd($data);
        $pic=$request->file('pic');
        // dd($pic);
        $path1=$pic->store('good_img');
        // dd($path1);
        $path="/storage/".$path1;
        // dd($path);
        // dd($data);
        $arr=['title'=>$data['title'],'people'=>$data['people'],'pic'=>$path,'add_time'=>time(),'desc'=>$data['desc']];
        // dd($arr);
        $res=DB::table('news')->insert($arr);
        // dd($res);
        if($res){
            return redirect('news/index');
        }else{
            echo "false";
        }
    }

    public function login()
    {
        return view('news_login');
    }
    public function dologin(Request $request)
    {
        // echo md5(111);die;
        $data=$request->post();
        // dd($data);
        $where=[
            ['name','=',$data['name']],
            ['pwd','=',md5($data['pwd'])],
        ];
        // dd($where);
        $count=DB::table('news_login')->where($where)->count();
        // dd($count);
        if($count<=0){
            echo "账号或密码错误";die;
        }else{
            $request->session()->put(['name'=>$data['name'],'pwd'=>md5($data['pwd'])]);
            return redirect('news/index');
        }
    }

    public function delete(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['id','=',$id],
        ];
        $res=DB::table('news')->where($where)->delete();
        // dd($res);
        if($res){
            return redirect('news/index');
        }else{
            echo "false";
        }
    }

    public function pro(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        // dd($data);
        $redis=new \Redis();
        // dd($redis);
        $redis->connect('127.0.0.1','6379');
        $num=$redis->incr('news_num');
        // dd($num);
        $arr=$redis->get('data');
        // dd($arr);    
        if($arr==false){
            $data=DB::table('news')->first();
            $data=json_encode($data);
            // dd($data);
            $redis->set('data',$data);     
        }else{
            $data=$redis->get('data');
            $data=json_decode($data);
            // dd($data);
        }
        return view('news_pro',['data'=>$data,'num'=>$num]);
    }

    public function data(Request $request)
    {
        dd($request->all());
        // dd(1111);
    }
}
