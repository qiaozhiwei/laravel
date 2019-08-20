<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\wechat;

class express extends Controller
{
    //添加表白
    public function add(Request $request,wechat $wechat)
    {
        $access_token=$wechat->access_token();
        $openid=$request->all()['openid'];
        // dd($openid);
        $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
        $re=file_get_contents($url);
        $re=json_decode($re,1);
        // dd($re);
        $nickname=$re['nickname'];
        // dd($nickname);
        return view('express_add',['openid'=>$openid,'nickname'=>$nickname]);
    }

    public function index(wechat $wechat)
    {
        $access_token=$wechat->access_token();
        // dd($access_token);
        $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=$access_token&next_openid=";
        $re=file_get_contents($url);
        $re=json_decode($re,2);
        // dd($re);
        $openid=$re['data']['openid'];
        // dd($openid);
        $openid_info=DB::table('can_express')->whereIn('openid',$openid)->get()->toarray();
        // dd($openid_info);
        $data=[];
        if($openid_info==[]){
            foreach($openid as $v){
                echo "<pre>";
                // echo $v;
                $arr=['openid'=>$v];
                // print_r($arr);
                $res=DB::table('can_express')->insert($arr);
                // dd($res);
            }
            $data=DB::table('can_express')->get()->toarray();
        }else{
            $data=DB::table('can_express')->get()->toarray();
        }
        // dd($data);
        return view('express_index',['data'=>$data]);
    }

    public function doadd(Request $request,wechat $wechat)
    {
        $access_token=$wechat->access_token();
        $data=$request->all();
        // dd($data);
        $openid=$data['openid'];
        // dd($openid);
        $arr=['name'=>$data['openid'],'content'=>$data['content'],'nickname'=>$data['name'],'send_name'=>$data['send_name']];
        // dd($arr);
        $res=DB::table('express')->insert($arr);
        // dd($res);
        $where=[
            ['name','=',$openid],
        ];
        // dd($where);
        $express_info=DB::table('express')->where($where)->first();
        $express_info=get_object_vars($express_info);
        // dd($express_info);
        $content=$data['content'];
        // dd($content);
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $push_info=[
            'touser'=>$openid,
            'template_id'=>'m3mspuOiQIWm74kTlursu4SzTBq8lNzdXZP-oHV5hRw',
            'data'=>[
                'first'=>[
                    'value'=>'xxxxxxxxxxxxxxxxxxxxx',
                    'color'=>'pink'
                ],
                'keyword'=>[
                    'value'=>'',
                    'color'=>''
                ],
                'content'=>[
                    'value'=>$content,
                    'color'=>'pink',
                ],
                'remark'=>[
                    'value'=>'xxxxxxxxxxxxxxxxxxxxx',
                    'color'=>'pink',
                ],
            ],

        ];
        // dd($push_info);
        if($res){
            $re=$wechat->post($url,json_encode($push_info));
            // dd($re);
            $re=json_decode($re,1);
            if($re['errcode']==0){
                return redirect('express/mine');
            }else{
                echo "全局返回码为".$re['errdoe'];
            }
            
        }else{
            echo "false";
        }
    }

    //查看我对**表白的数据
    public function mine(wechat $wechat)
    {
        $access_token=$wecaht->access_token();
        $url="";
    }

    public function push()
    {
        
    }
}
