<?php
namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\vvv\captcha;
use DB;


class user extends Controller
{
    //后台登陆
    public function login()
    {
        return view("user/login");
    }

    public function dologin(Request $request)
    {
        $user_name=$request->all()['user_name'];
        $pwd=$request->all()['pwd'];
        $code=$request->all()['code'];
        $code_s=$request->session()->get("captcha");
        // echo $code;
        // echo $code_s;die;
        // dd($request->session()->get("captcha"));
        if($user_name=="" || $pwd=="" || $code==""){
            echo "用户名，密码，验证码为空";die;
        }
        $where=[
            ['user_name','=',$user_name],
            ['pwd','=',md5($pwd)],
        ];
        // dd($where);
        $count=DB::table('x-admin_user')->where($where)->count();
        if($code!=$code_s){
            echo "验证码不正确";die;
        }
        if($count>0){
            $request->session()->put("user_name",$user_name);
            return redirect("index/index");
        }else{
            echo "用户不存在或者密码不正确";die;
        }
    }

    //获取验证图片
    public function get_code()
    {
        $captcha=new captcha(100,30);
        $captcha->createImage(100,30,4,6,200,200);
    }


    //小程序登陆


    public function qq_login()
    {
        
    }
}
