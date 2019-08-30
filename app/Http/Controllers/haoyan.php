<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BD;
use App\Http\Controllers\wechat;

class haoyan extends Controller
{
    public function create_menu()
    {
        return view('haoyan_create_menu');
    }

    public function docreate(Request $request,wechat $wechat)
    {
        $access_token=$wechat->access_token();
        // dd($access_token);
        $data=$request->all();
        // dd($data);
        $push_info=[];
        if($data['name_two']==""){
            //一级菜单
            if($data['type']=='click'){
                //click
                $push_info=[
                    'button'=>[
                        [
                            'type'=>$data['type'],
                            'name'=>$data['name_one'],
                            'key'=>$data['key']
                        ],
                    ],
                ];
            }else{
                //view
                $push_info=[
                    'button'=>[
                        [
                            'type'=>$data['type'],
                            'name'=>$data['name_one'],
                            'url'=>$data['url']
                        ],
                    ],
                ];
            }
            // dd($push_info);
        }else{
            //二级菜单
            //事件类型为click
            if($data['type']=='click'){
                $push_info=[
                    'button'=>[
                        [
                            'name'=>$data['name_one'],
                            'sub_button'=>[
                                [
                                    'type'=>$data['type'],
                                    'name'=>$data['name_two'],
                                    'key'=>$data['key']
                                    
                                ],
                            ],
                        ],
                    ],
                ];
            }else{
                //事件类型为view
                $push_info=[
                    'button'=>[
                        [
                            'name'=>$data['name_one'],
                            'sub_button'=>[
                                [
                                    'type'=>$data['type'],
                                    'name'=>$data['name_two'],
                                    'url'=>$data['url']
                                    
                                ],
                            ],
                        ],
                    ],
                ];
            }
        }
        // dd($push_info);
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $re=$wechat->post($url,json_encode($push_info,JSON_UNESCAPED_UNICODE));
        $re=json_decode($re,1);
        // dd($re);
        if($re['errcode']==0){
            return redirect('hanyan/index');
        }else{
            echo $re['errcode'];
        }
    }

    public function index()
    {
        <xml><ToUserName><![CDATA[gh_30106c18970f]]></ToUserName>
        <FromUserName><![CDATA[o-grPv97kK3c56mpI_4pdgko1suo]]></FromUserName>
        <CreateTime>1566956707</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA[了解]]></Content>
        <MsgId>22433427497112074</MsgId>
        </xml>


        <xml><ToUserName><![CDATA[gh_30106c18970f]]></ToUserName>
        <FromUserName><![CDATA[o-grPv97kK3c56mpI_4pdgko1suo]]></FromUserName>
        <CreateTime>1566956746</CreateTime>
        <MsgType><![CDATA[image]]></MsgType>
        <PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz_jpg/XjeIibDBcL9oaYGBrzLSe0fCbLSLMGicX5x3aeytTvCVo3g6TEWYkjERbpemgFhLVqHHxdoEUtaqgVTllcf42qRw/0]]></PicUrl>
        <MsgId>22433427437319888</MsgId>
        <MediaId><![CDATA[TUYWFFb20qDAigd6PhFPMF9j4Stuwrzz1nn7ix3gvTBnRxjXYN33GAF3XZiVspkP]]></MediaId>
        </xml>

    }
}
