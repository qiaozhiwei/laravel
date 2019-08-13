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
        // dd($request->session()->all());
        //拿取user_id
        $name=session('name');
        // dd($name);
        $where=[
            ['name','=',$name],
        ];
        $user_id=DB::table('admin_user')->select('id')->first();
        $user_id=get_object_vars($user_id);
        $user_id=$user_id['id'];
        // dd($user_id);
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";
        $data=[
            "expire_seconds"=> 604800,
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
        // dd($re);
        $ticket=urlencode($ticket);
        // dd($ticket);
        $url_two="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
        $client=new Client;
        // dd($client);
        $re=$client->get($url_two);
        // dd($re);
        $header=$re->getHeaders();
        // dd($header);
        $name=$header['Content-Type'][0];
        $name=explode('/',$name);
        $name=array_pop($name);
        // dd($name);
        $file_name=time().rand(1000,9999).".".$name;
        // dd($file_name);
        $path='erweima/'.$file_name;
        $res=Storage::disk('local')->put($path, $re->getBody());
        // dd($res);
        $arr=['url'=>$url_two,'code'=>$user_id];
        $wheres=[
            ['user_id','=',$user_id],
        ];
        //
        $res=DB::table('agent')->where($wheres)->update($arr);
        if($res){
            // $wechat->even();
            return redirect('distribution/index');
        }else{
            echo "false";
        }
    }

    
}
