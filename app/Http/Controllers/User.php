<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class User extends Controller
{
    public function admin_index(Request $request)
    {
        $where=[
            ['state','!=',1],
        ];
        $data=DB::table('admin_user')->where($where)->paginate(3);
        // dd($data);
        //测试为几级用户
        $a=session('state');
        // dd($a);
        return view('admin_index',['data'=>$data]);
    }

    public function admin_add()
    {
        return view('admin_add');
    }

    public function do_add(Request $request)
    {
        
        $data=$request->all();
        // dd($data);
        $where=[
            ['name','=',$data['name']],
        ];
        $password=md5($data['password']);
        $count=DB::table('admin_user')->where($where)->count();
        // dd($count);
        if($count>0){
            echo "该用户已被注册";die;
        }
        $arr=['name'=>$data['name'],'password'=>$password,'state'=>$data['state'],'reg_time'=>time()];
        // dd($arr);
        $res=DB::table('admin_user')->insert($arr);
        // dd($res);
        
        
        if($res){
            return redirect('User/index');
        }else{
            echo "false";
        }
    }

    public function admin_register()
    {
        return view('admin_register');
    }

    public function doregister(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $password=md5($data['password']);
        $arr=['name'=>$data['name'],'password'=>$password,'state'=>$data['state'],'reg_time'=>time()];
        $res=DB::table('admin_user')->insert($arr);
        // dd($res);
        if($res){
            return redirect('User/login');
        }else{
            echo "注册失败";die;
        }
    }

    public function admin_login()
    {
        return view('admin_login');
    }

    public function dologin(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $password=md5($data['password']);
        $where=[
            ['name','=',$data['name']],
            ['password','=',$password],
        ];
        $arr=DB::table('admin_user')->where($where)->first();
        $arr=get_object_vars($arr);
        // dd($arr);
        $state=$arr['state'];
        // dd($state);
        // dd($where);
        $count=DB::table('admin_user')->count();
        // dd($count);
        if($count<=0){
            // echo 111;die;
            echo "登录失败,账户或者密码错误";die;
        }else{
            // echo 222;die;
            //将账户密码存入session
            session(['name'=>$data['name'],'password'=>$password,'state'=>$state]);
            return redirect('User/index');
        }
    }

    public function state(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $arr=[$data['field']=>$data['value']];
        // dd($arr);
        $where=[
            ['id','=',$data['id']],
        ];
        $res=DB::table('admin_user')->where($where)->update($arr);
        // dd($res);
        if($res){
            echo json_encode(['code'=>1,'msg'=>'成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'失败']);
        }
    }
}
