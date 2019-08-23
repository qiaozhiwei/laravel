<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\wechat;

class text extends Controller
{
    public function index(wechat $wechat,Request $request)
    {
        $name=session('name')??"";
        // dd($name);
        if($name==""){
            echo "您还没有登录";die;
        }
        $where=[
            ['name','=',$name],
        ];
        // dd($where);
        $uid=DB::table('admin_user')->where($where)->select('id')->first();
        $uid=get_object_vars($uid)['id'];
        // dd($uid);
        $access_token=$wechat->access_token();
        // dd($access_token);
        $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=$access_token&next_openid=";
        $re=file_get_contents($url);
        $re=json_decode($re,1);
        // dd($re);
        $openid=$re['data']['openid'];
        // dd($openid);
        echo "<pre>";
        $nickname=[];
        foreach($openid as $v){
            echo "<pre>";
            $url_two="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$v&lang=zh_CN";
            $res=file_get_contents($url_two);
            // print_r($re);
            $res=json_decode($res,1);
            $nickname[]=$res;
        }
        // print_r($nickname);
        return view('text_index',['nickname'=>$nickname,'uid'=>$uid]);
        
    }

    public function liuyan(Request $request,wechat $wechat)
    {
        $content=$request->all()['content'];
        // dd($content);
        $openid=$request->all()['openid'];
        // dd($openid);
        $uid=$request->all()['uid'];
        // dd($uid);
        $nickname=$request->all()['nickname'];
        // dd($nickname);
        $arr=['uid'=>$uid,'content'=>$content,'nickname'=>$nickname];
        // dd($arr);
        $res=DB::table('text')->insert($arr);
        $access_token=$wechat->access_token();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $data=[
            'touser'=>$openid,
            'template_id'=>'m3mspuOiQIWm74kTlursu4SzTBq8lNzdXZP-oHV5hRw',
            'data'=>[
                'first'=>[
                    'value'=>'xxxxxxxxxxxxxxxxxxx',
                    'color'=>'#173177'
                ],
                'keyword'=>[
                    'value'=>$content,
                    'color'=>'red',
                ],
                'remark'=>[
                    'value'=>'xxxxxxxxxxxxxxxxxxxxxx',
                    'color'=>'#173177',
                ],
            ],

        ];
        // dd($data);
        $re=$wechat->post($url,json_encode($data));
        $re=json_decode($re,1);
        // dd($re);
        if($re['errcode']==0){
            return redirect('text/index');
        }else{
            echo "false";
        }
    }

    public function liuyans(Request $request)
    {
        $uid=$request->all()['uid'];
        // dd($uid);
        $openid=$request->all()['openid'];
        // dd($openid);
        $nickname=$request->all()['nickname'];
        // dd($nickname);
        return view('text_liuyans',['openid'=>$openid,'uid'=>$uid,'nickname'=>$nickname]);
    }

    public function send(wechat $wechat)
    {
        $access_token=$wechat->access_token();
        // dd($access_token);
        $data=DB::table('text')->get();
        // dd($data);
        return view('text_send',['data'=>$data]);
    }

    public function info()
    {
        echo phpinfo();
    }
}
