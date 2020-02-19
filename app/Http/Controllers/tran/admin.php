<?php

namespace App\Http\Controllers\tran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class admin extends Controller
{

    public function login()
    {
        return view("tran/adminlogin");
    }

    public function do_adminlogin(Request $request)
    {
        $username=$request->all()['username']??"";
        $pwd=$request->all()['pwd']??"";
        // dd($data);
        // var_dump($username,$pwd);
        if($username==""){
            echo "用户名不能为空";die;
        }
        if($pwd==""){
            echo "密码不能为空";die;
        }
        $where=[
            ['username','=',$username],
            ['pwd','=',$pwd],
        ];
        // dd($where);
        $count=DB::table("tran_adminlogin")->where($where)->count();
        // dd($count);
        if($count>0){
            //存session

            return redirect("tran/adminindex");
        }else{
            echo "账号或密码错误";die;
        }
        
        
    }

    public function adminindex()
    {
        $data=DB::table("tran_indexuser")->get()->toarray();
        // dd($data);
        return view("tran/adminindex",['data'=>$data]);
    }

    public function addUser()
    {
        return view("tran/addUser");
    }

    public function doaddUser(Request $request)
    {
        $username=$request->all()['username']??"";
        $pwd=$request->all()['pwd']??"";
        // var_dump($username,$pwd);
        if($username==""){
            echo "用户名不能为空";die;
        }
        if($pwd==""){
            echo "密码不能为空";die;
        }
        $arr=["username"=>$username,'pwd'=>$pwd,'time'=>time()];
        // dd($arr);
        $res=DB::table("tran_indexuser")->insert($arr);
        // dd($res);
        if($res){
            return redirect("tran/adminindex");
        }else{
            echo "添加失败";
        }
    }

    public function index()
    {
        return view('tran/index');
    }


    public function addvideo()
    {
        return view("tran/addvideo");
    }

    public function tran()
    {
        
    }
}
