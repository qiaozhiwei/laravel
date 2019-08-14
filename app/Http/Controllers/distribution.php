<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\wechat;
use DB;
use Illuminate\Support\Facades\Storage;

class distribution extends Controller
{
    public function access_token(wechat $wechat)
    {
        $access_token=$wechat->access_token();
        // dd($access_token);
        return $access_token;
    }

    public function index()
    {
        $data=DB::table('agent')->get();
        // dd($data);
        return view('distribution_index',['data'=>$data]);
    }

    public function ticket(Request $request,wechat $wechat)
    {
        $access_token=$wechat->access_token();
        // dd($access_token);
        $user_name=$request->all()['name'];
//        dd($user_name);
        $where=[
            ['name','=',$user_name],
        ];
//        dd($where);
        $user_id=DB::table('admin_user')->where($where)->select('id')->first();
        $user_id=get_object_vars($user_id);
        $user_id=$user_id['id'];
//         dd($user_id);
        $redis=new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->set($user_id,$user_name);
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";
//        dd($user_id);
        $data=[
            "expire_seconds"=> 2592000,
            "action_name"=> "QR_SCENE",
            "action_info"=>[
                'scene'=>[
                    'scene_id'=>$user_id
                ],
            ],
        ];
        $re=$wechat->post($url,json_encode($data));
        $re=json_decode($re,1);
        $ticket=$re['ticket'];
        $ticket=urlencode($ticket);
//         dd($ticket);
        $url_two="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
        $client=new Client;
//         dd($client);
        $req=$client->get($url_two);
//         dd($req);
        $header=$req->getHeaders();
//         dd($header);
        $name=$header['Content-Type'][0];
        $name=explode('/',$name);
        $name=array_pop($name);
//         dd($name);
        $file_name=time().rand(1000,9999).".".$name;
        // dd($file_name);
        $path='erweima/'.$file_name;
//        dd($path);
        $res=Storage::disk('local')->put($path, $req->getBody());
//         dd($res);
        $arr=['url'=>$url_two,'code'=>$user_id];
        $wheres=[
            ['user_id','=',$user_id],
        ];
        //
//        dd($wheres);
        $res=DB::table('agent')->where($wheres)->update($arr);
//        dd($res);
        if($res){
            // $wechat->even();
            return redirect('distribution/index');
        }else{
            echo "false";
        }
    }

    public function pro(Request $request)
    {
        $name=$request->all()['name'];
//        dd($name);
        $where=[
            ['name','=',$name],
        ];
//        dd($where);
        $data=DB::table('info')->where($where)->select('openid')->get();
//        dd($data);
        return view('distribution_pro',['data'=>$data]);
    }


    public function add()
    {
        return view('distribution_add');
    }

    public function doadd(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $name=$data['name'];
//        dd($name);
        $where=[
            ['name','=',$name],
        ];
//        dd($where);
        $user_id=DB::table('admin_user')->where($where)->select('id')->first();
        $user_id=get_object_vars($user_id)['id'];
//        dd($user_id);
        $arr=['user_name'=>$name,'user_id'=>$user_id];
//        dd($arr);
        $res=DB::table('agent')->insert($arr);
//        dd($res);
        if($res){
            return redirect('distribution/index');
        }else{
            echo "false";
        }
    }



    
}
