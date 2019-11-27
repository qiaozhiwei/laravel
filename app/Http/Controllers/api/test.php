<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use DB;

class test extends Controller
{
    public function request_index()
    {
        return view('api/index');
    }



    //post请求
    // public function post($url, $data = [])
    // {
      
    //         //初使化init方法
    //         $ch=curl_init();
    //         // dd($ch);
    //         //指定URL
    //         curl_setopt($ch,CURLOPT_URL, $url);
    //         //设定请求后返回结果
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //         //声明使用POST方式来进行发送
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         //发送什么数据
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //         //忽略证书
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    //         //忽略header头信息
    //         curl_setopt($ch, CURLOPT_HEADER, 0);
    //         //设置超时时间
    //         curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    //         //发送请求
    //         $output = curl_exec($ch);
    //         //关闭curl
    //         curl_close($ch);
    //         //返回数据
    //         return $output;
        
    // }

    public function post($url,$query=[]){

        // $url="http://www.laravel.com/san";
        // $query=['name'=>'张三'];
        $data=[];
        $options['http'] = array(
            'timeout'=>60,
            'method' => 'POST', 
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $query
           );
        //    dd($options);
        $context = stream_context_create($options);
        // dd($context);
        $re = file_get_contents($url, false, $context);
        // dd($re);
        echo $re;
    }

    //调用
    public function do_register()
    {
        $url="http://www.laravel.com/test/order";
        $data=['token'=>'4d857dc2b2f01a57a35b48881aed82b4'];
        $re=$this->post($url);
        dd($re);
    }

    //get请求

    public function get($url)
    {
        $re=file_get_contents($url);
        return $re;
    }

    //注册接口

    public function register(Request $request)
    {
        $tel=$request->all()['phone']??"";
        $code=$request->all()['code']??"";
        $password=$request->all()['password']??"";
        $sign=md5(time().rand(1000,9999)."$tel");
        // dd($token);
        
        $source=$request->all()['source']??"";
        // var_dump($tel,$code,$password,$source);
        if($tel==""){
            return json_encode(['errcode'=>2,'msg'=>'手机号为空'],JSON_UNESCAPED_UNICODE);
        }   
        if($code==""){
            return json_encode(['errcode'=>2,'msg'=>'验证码为空'],JSON_UNESCAPED_UNICODE);
        }
        if($password==""){
            return json_encode(['errcode'=>2,'msg'=>'密码为空'],JSON_UNESCAPED_UNICODE);
        }
        if($source==""){
            return json_encode(['errcode'=>2,'msg'=>'型号为空'],JSON_UNESCAPED_UNICODE);
        }

        // dd($tel);
        $len=strlen($tel);
        // dd($len);
        if($len!=11){
            return json_encode(['errcode'=>2,'msg'=>'手机号格式不正确'],JSON_UNESCAPED_UNICODE);
        }
        if($code!="123456"){
            return json_encode(['errcode'=>2,'msg'=>'验证码格式不正确'],JSON_UNESCAPED_UNICODE);
        }
        $where=[
            ['name','=',$tel],
        ];
        // dd($where);
        $count=DB::table('k_register')->where($where)->count();
        // dd($count);
        $res="";
        if($count<1){
            $arr=['name'=>$tel,'pwd'=>$password,'create_time'=>time(),'source'=>$source,'status'=>0,'token'=>$sign,'ex_time'=>time()+7200];
            // dd($arr);
            $id=DB::table('k_register')->insertGetId($arr);
            // dd($id);
            $wheres=[
                ['id','=',$id],
            ];
            $data=DB::table('k_register')->where($wheres)->first();
            $data=get_object_vars($data);
            // dd($data);
            if($id){
                return json_encode(['errcode'=>0,'msg'=>'注册成功','result'=>$data],JSON_UNESCAPED_UNICODE);
            }else{
                return json_encode(['errcode'=>3,'msg'=>'注册失败'],JSON_UNESCAPED_UNICODE);
            }
        }else{
            return json_encode(['errcode'=>4,'msg'=>'此手机号已被占用，请选择其他手机进行注册或尝试登录'],JSON_UNESCAPED_UNICODE);            
        }
    }

    

    //订单接口
    public function order(Request $request)
    {
        $all=$request->all();
        // dd($a);
        $token=$all['arr'][1]??"";
        // dd($token);
        $token_a="1b2d94e1c268115cbf1f930661bb75fe";
        // $token=$request->all()['token']??"";
        if($token==""){
            return json_encode(['errcode'=>2,'msg'=>'token为空'],JSON_UNESCAPED_UNICODE);
        }
        $where=[
            ['token','=',$token],
        ];
        $count=DB::table('k_register')->where($where)->count();
        // dd($count);
        if($count<1){
            return json_encode(['errcode'=>2,'msg'=>'token不正确'],JSON_UNESCAPED_UNICODE);            
        }

        $time=DB::table('k_register')->select('ex_time')->first();
        $time=get_object_vars($time)['ex_time'];
        // dd($time);
        if($time<=time()){
            return json_encode(['errcode'=>2,'msg'=>'您的token已过期,请重新获取'],JSON_UNESCAPED_UNICODE);                        
        }

        $data=DB::table('goods_order')->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            $arr[]=get_object_vars($v);
        }
        // dd($arr);
        if($arr==[]){
            return json_encode(['errcode'=>3,'msg'=>'数据为空'],JSON_UNESCAPED_UNICODE);                        
        }else{
            return json_encode(['errcode'=>0,'msg'=>'数据显示成功','result'=>$arr],JSON_UNESCAPED_UNICODE);                                    
        }


    }
}
