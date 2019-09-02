<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class wechat extends Controller
{
    public function access_token()
    {
        $access_token="";
        $appid="wx9f5dbb91dcfaee8f";
        $appsecret="b084b27bcbb10ce63e3b37913ded5d3f";
        // dd($appsecret);
        $redis=new \Redis();
        // dd($redis);
        $redis->connect('127.0.0.1','6379');
        // dd($redis->get('access_token'));
        $re=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}");
        $re=json_decode($re,1);
        dd($re);
        $access_token=$re['access_token'];
        // dd($access_token);
        // $redis->del('access_token');
        // dd($redis->get('access_token'));
        // dd($access_token);
        if(($redis->get('access_token'))===false){
            $re=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}");
            $re=json_decode($re,1);
            // dd($re);
            $access_token=$re['access_token'];
            // dd($access_token);
            $time=$re['expires_in'];
            $redis->set('access_token',$access_token,$time);
        }else{
            $access_token=$redis->get('access_token');
            // dd($access_token);
        }
        // dd($access_token);
        $push_info=[
            'button'=>[
                [
                    'type'=>"click",
                    'name'=>"积分查询",
                    'key'=>"V1001_TODAY_MUSIC",
                ],
                [
                    'type'=>"click",
                    'name'=>"签到按钮",
                    'key'=>"V1001_TODAY_MUSIC",
                ],
            ],
        ];
        $time=date('Y-m-d H:i:s',time());
        $a=time();
        // echo $time;
        // dd($a);
        // dd(json_encode($push_info));
        dd($access_token);
        return $access_token;
        
    }

    public function get_list(Request $request)
    {
        $count=$request->all()['count'];
        // dd($count);
        $access_token=$this->access_token();
        $id=$request->all()['id']??"";
        if($id==""){
            echo "访问错误";die;
        }
        // dd($id);
        //获取标签下已有的粉丝
        $data=[
            'tagid'=>$id,
            'next_openid'=>""
        ];
        $url="https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=$access_token";
        $re=$this->post($url,json_encode($data));
        $re=json_decode($re,1);
        // dd($re);
        // dd($count);
        $count_wechat=$re['count'];
        if($count_wechat==5){
            echo "您的所有粉丝已打上该标签。还可以去创建标签哦";die;
        }
        $data=[];
        if($re['count']==0){
            $arr=DB::table('wechat')->get()->toarray();
        }else{
            $openid=$re['data']['openid'];
            // dd($openid);
            $data=DB::table('wechat')->get()->toarray();
            // dd($data);
            $openid_sql=array_column($data,'openid');
            // dd($openid_sql);
            $open_id=[];
            foreach($openid_sql as $v){
                if(!in_array($v,$openid)){
                    $open_id[]=$v;
                }
            }
            // dd($open_id);
            $arr=DB::table('wechat')->wherein('openid',$open_id)->get();
            // dd($arr);
        }
        
        return view('wechat_list',['arr'=>$arr,'id'=>$id]);
        
    }

    public function get_info()
    {
        $access_token=$this->access_token();
        $re=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid=");
        $re=json_decode($re,1);
        // dd($re);
        $openid=$re['data']['openid'];
        // dd($openid);
        $arr=[];
        $time=time();
        foreach($openid as $k=>$v){
            echo "<pre>";
            // print_r($v);
            $data=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$v&lang=zh_CN");
            $data=json_decode($data,1);
            // print_r($data);
            $arr=['openid'=>$v,'add_time'=>$time,'subscribe'=>$data['subscribe']];
            // print_r($arr);
            DB::table('wechat')->insert($arr);
        }
        return redirect('wechat/wechat_index');
        
    }

    public function pro(Request $request)
    {
        $access_token=$this->access_token();
        // dd($access_token);   
        $openid=$request->all()['openid'];
        // dd($openid);
        $re=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN");
        $re=json_decode($re,1);
        // dd($re);
        $data=['headimgurl'=>$re["headimgurl"],'sex'=>$re['sex'],'nickname'=>$re['nickname'],'city'=>$re['city'],'openid'=>$access_token,'province'=>$re['province']];
        // dd($data);

        return view('wechat_pro',['data'=>$data]);
    }

    public function login()
    {
        $appid="wx9f5dbb91dcfaee8f";
        $appsecret="b084b27bcbb10ce63e3b37913ded5d3f";
        $url="http://123.57.18.167/wechat/code";
        // dd(urlEncode($url));
        // dd(urlencode($url));
        $redirect_url=urlencode($url);
//         dd($redirect_url);
        $re=("https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect");
//         dd($re);
        // file_get_contents("$re");
        // die;
        header("Location:$re");
    }

    public function code(Request $request)
    {
        // dd($request->all());
        $access_token=$this->access_token();
        $appid="wx9f5dbb91dcfaee8f";
        $appsecret="b084b27bcbb10ce63e3b37913ded5d3f";
        $code=$request->all()['code'];
        // dd($code);
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        $re=file_get_contents($url);
        $re=json_decode($re,1);
        // dd($re);
        $openid=$re['openid'];
        // dd($openid);
        $request->session()->put('openid',"$openid");
        // dd($access_token);
        $get_userinfo_url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
        $data=file_get_contents($get_userinfo_url);
        $data=json_decode($data,1);
        // dd($data);
        if((array_key_exists('errcode',$data))==true){
            echo "程序错误返回码为".$data['errcode'];die;
        }
        $name=$data['nickname'];
        // dd($name);
        $count=DB::table('wechat_userinfo')->count();
        // dd($count);
        $res="";
        if($count<=0){
            // 没有数据,先注册再登陆
            $uid=DB::table('admin_user')->insertGetId(
                [
                    'name'=>$name,
                    'reg_time'=>time(),
                ]
            );
            // dd($uid);
            $res=DB::table('wechat_userinfo')->insert(
                [
                    'user_id'=>$uid,
                    'openid'=>$openid
                ]
            );
            $request->session()->put('password','111');
            $this->send();
        }else{
            //有数据,登陆成功
            $request->session()->put('password','111');
            $res=true;
            $this->send();

        }
        // dd($res);
        if($res){
            return redirect('Goods/index');
        }else{
            echo "登陆失败";
        }
        
        
        
        
    }


    public function xxoo()
    {
        $appid="wx9f5dbb91dcfaee8f";
        $appsecret="b084b27bcbb10ce63e3b37913ded5d3f";
        $redirect_uri=urlencode("http://www.laravel.com/wechat/code");
        // dd($redirect_uri);
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        header("location:$url");
    }


    public function ooxx()
    {
        $access_token=$this->access_token();
        // dd($access_token);
        $url="https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=$access_token";
        
    }

    public function post($url, $data = []){
        //初使化init方法
        $ch=curl_init();
        // dd($ch);
        //指定URL
        curl_setopt($ch,CURLOPT_URL, $url);
        //设定请求后返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //声明使用POST方式来进行发送
        curl_setopt($ch, CURLOPT_POST, 1);
        //发送什么数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //忽略证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //忽略header头信息
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //设置超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //发送请求
        $output = curl_exec($ch);
        //关闭curl
        curl_close($ch);
        //返回数据
        return $output;
    }

    public function view_index()
    {
        $access_token=$this->access_token();
        // dd($access_token);
        $url="https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=$access_token";
        $re=file_get_contents($url);
        $re=json_decode($re,1);
        // dd($re);
        $data=$re['template_list'];
        // dd($data);
        return view('wechat_index',['data'=>$data]);
    }

    public function del(Request $request)
    {
        $access_token=$this->access_token();
        // dd($access_token);
        $id=$request->all()['id'];
        // dd($id);
        $data=['template_id'=>$id];
        $data=json_encode($data);
        // dd($data);
        $url="https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token=$access_token";
        // dd($url);
        $res=$this->post($url,$data);
        $res=json_decode($res,1);
        // dd($res);
        if($res['errcode']==0){
            return redirect('wechat/view_index');
        }else{
            echo "删除失败";
        }
    }
    //推送模板消息
    public function send()
    {
        $access_token=$this->access_token();
        $openid=session('openid');
        // dd($openid);
        // dd($access_token);
        $appid="wx9f5dbb91dcfaee8f";
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $data=[
            'touser'=>$openid,
            'template_id'=>'9-ydj1dmN1Z7li1rfJMkkP0pZahXgjkdYo8322Yt4Ww',
            'data'=>[
                'first'=>[
                    'value'=>'恭喜您登陆成功！',
                    'color'=>'#173177'
                ],
                'keyword'=>[
                    'value'=>'若是您本人操作请忽略，若不是，建议您修改密码。',
                    'color'=>'red',
                ],
                'remark'=>[
                    'value'=>'',
                    'color'=>'#173177',
                ],
            ],

        ];
        // dd($data);
        $re=$this->post($url,json_encode($data));
        // dd($re);
    }
    //新增临时素材
    public function upload(Request $request)
    {
        return view('wechat_upload');
    }

    public function doupload(Request $request)
    {
        $access_token=$this->access_token();
        // dd($access_token);
        $file=$request->file();
        // dd($file);
        // dd($client);
        if(!empty($file['img'])){
            // echo 111;
            $path=$request->file('img')->store('good_img');
            $path="./storage/".$path;
            // dd($path);
            $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=image";
            // dd("fopen(realpath($path)");
            // dd(realpath($path));
            $method="POST";
            $re=$this->guzzle($path,$url,$method);
            // dd($re);
            unlink($path);
            // $re=json_decode($re,1);
            // echo "<pre>";
            // print_r($re);
            echo $re;
            
        }
        if(!empty($file['voice'])){
            // echo 22222;
            $file=$request->file('voice');
            // dd($file);
            //获取文件的扩展名
            $file_ext=$file->getClientOriginalExtension();
            // dd($file_ext);
            $file_name=time().rand(1000,9999).'.'.$file_ext;
            // dd($file_name);
            $path=$file->storeAs('voice',$file_name);
            $path="./storage/".$path;
            // dd($path);
            //上传微信
            $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=voice";
            // dd($url);
            // dd(realpath($path));
            $response = $client->request('POST',$url,[
                'multipart' => [
                    [
                        'name'     => 'media',
                        'contents' => fopen(realpath($path), 'r')
                    ],
                ]
            ]);
            $re=$response->getBody();
            // dd($re);
            unlink($path);
            echo $re;
            
            
            dd();
        }
        if(!empty($file['video'])){
            // echo 33;
        }
        if(!empty($file['thumb'])){
            // echo 444;
        }

        
    }

    //获取临时素材
    public function get_source()
    {
        $client = new Client();
        $access_token=$this->access_token();
        $url="https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=DB-Tk2I_YfGh1sxAeL-nCBruJmV4Ksokb_IvOjJ3dUY5Gey5Tdq-RZPkzuWvHekz";
        $re=$client->get($url);
        // dd($re);
        //获取文件名
        $file_info=$re->getHeader('Content-disposition');
        // dd($file_info);
        $file_info=rtrim($file_info[0],'"');
        // dd($file_info);
        $file_name=substr($file_info,22);
        // dd($file_name);
        //保存图片
        $file_new_name='wechat_img'.'_'.$file_name;
        // dd($file_new_name);
        // dd($re->getBody());
        $res=Storage::disk('local')->put($file_new_name,$re->getBody());
        dd($res);
        
    }
    //素材列表
    public function source_index()
    {
        $access_token=$this->access_token();
        $url="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=$access_token";
        $data=[
            "type"=>'image',
            "offset"=>0,
            "count"=>20
        ];
        $re=$this->post($url,json_encode($data));
        $re=json_decode($re,1);
        // dd($re);
        $arr=$re['item']??[];
        // dd($arr);
        return view('wechat_source_index',['arr'=>$arr]);
    }


    //新增永久素材
    public function upload_permanent()
    {
        return view('wechat_upload_permanent');
    }   
    public function do_upload_permanent(Request $request)
    {
        $access_token=$this->access_token();
        // dd($access_token);
        $file=$request->file();
        // dd($file);
        // dd($client);
        if(!empty($file['img'])){
            // echo 111;
            $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$access_token&type=image";
            $file=$request->file('img');
            // dd($file);
            $path=$file->store('permanent_img');
            // dd($path);
            $path="./storage/".$path;
            // dd($path);
            $re=$this->guzzle($path,$url,"POST");
            // dd($re);
            echo $re;
            
            
        }
        
    }

    //素材删除
    public function del_source(Request $request)
    {

    }


    //创建标签
    public function create_label()
    {
        return view('wechat_create_label');
    }

    public function do_create_label(Request $request)
    {
        $access_token=$this->access_token();
        $url="https://api.weixin.qq.com/cgi-bin/tags/create?access_token=$access_token";
        $name=$request->all()['name'];
        // dd($name);
        $data=[
            'tag'=>['name'=>$name],
        ];
        // dd($data);
        //json_encode($data,JSON_UNESCAPED_UNICODE)
        $re=$this->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $re=json_decode($re,1);
        // dd($re);
        //若创建已经创建的标签会返回45157
        if(array_key_exists('tag',$re)){
            // echo 111;
            return redirect('wechat/label_index');
        }else{
            echo "程序错误,您的全局返回码为".$re['errcode'];
        }
    }

    public function label_index()
    {
        $access_token=$this->access_token();
        $url="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$access_token";
        $re=file_get_contents($url);
        $re=json_decode($re,1);
        // dd($re);
        if((array_key_exists('tags',$re))==false){
            echo "程序错误，您的返回码".$re['errcode'];die;
        }
        $arr=$re['tags'];
        // dd($arr);
        return view('wechat_label_index',['re'=>$arr]);
    }

    //删除标签
    public function del_label(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $access_token=$this->access_token();
        $url="https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=$access_token";
        $data=[
            'tag'=>[
                'id'=>$id
            ]
        ];
        $re=$this->post($url,json_encode($data));
        $re=json_decode($re,1);
        // dd($re);
        if($re['errcode']==0){
            return redirect('wechat/label_index');
        }else{
            echo "程序错误，您的返回码为".$re['errcode'];
        }

    }

    //修改标签
    public function update_label(Request $request)
    {
        $data=$request->all()['data'];
        // dd($data);
        $data=explode('.',$data);
        // dd($data);
        $id=$data[1];
        $name=$data[0];
        // dd($name);
        return view('wecahr_update_label',['name'=>$name,'id'=>$id]);
    }

    public function do_update_label(Request $request)
    {
        $access_token=$this->access_token();
        $id=$request->all()['id'];
        // dd($id);
        $name=$request->all()['name'];
        // dd($name);
        $update_data=[
            'tag'=>[
                'id'=>$id,
                'name'=>$name
            ]
        ];
        // dd($update_data);
        $url="https://api.weixin.qq.com/cgi-bin/tags/update?access_token=$access_token";
        $re=$this->post($url,json_encode($update_data,JSON_UNESCAPED_UNICODE));
        $re=json_decode($re,1);
        // dd($re);
        if($re['errcode']==0){
            return redirect('wechat/label_index');
        }else{
            echo "程序错误，您的返回码为".$re['errcode'];   
        }
    }

    
    //打标签
    public function set_label(Request $request)
    {
        //接收标签id
        $access_token=$this->access_token();
        //接收要打标签的粉丝openid
        $data=$request->all()['array'];
        // dd($data);
        $tag_id=substr($data,-3);
        // dd($tag_id);
        $openid=substr($data,0,-4);
        $openid=explode(',',$openid);
        // dd($openid);
        $data=[
            'openid_list'=>$openid,
            'tagid'=>$tag_id
        ];
        // dd($data);
        $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$access_token";
        $re=$this->post($url,json_encode($data));
        $re=json_decode($re,1);
        // dd($re);
        if($re['errcode']==0){
            return redirect('wechat/label_index');
        }else{
            echo "程序错误,您的全局返回码为".$re['errcode'];
        }
    }

    // public function do_set_label(Request $request)
    // {
    //     $access_token=$this->access_token();
    //     $data=$request->all()['data'];
    //     // dd($data);
    //     //标签ID
    //     $id=substr($data,-3);
    //     // dd($id);
    //     $openid=substr($data,0,-4);
    //     // dd($openid);
    //     $openid=explode(',',$openid);
    //     // dd($openid);
    //     $data=[
    //         'openid_list'=>$openid,
    //         'tagid'=>$id,
    //     ];
    //     // dd($data);
    //     $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$access_token";
        
    //     $re=$this->post($url,json_encode($data));
    //     // dd($re);
    //     $re=json_decode($re,1);
    //     if($re['errcode']==0){
    //         return redirect('wechat/label_index');
    //     }else{
    //         echo "程序操作错误，您的全局返回码为".$re['errcode'];
    //     }
        
    // }


    public function wechat_index()
    {
        $access_token=$this->access_token();
        // dd($access_token);
        $data=DB::table('wechat')->get();
        // dd($data);
        return view('wechat_get_index',['data'=>$data]);
    }


    //该标签下的粉丝列表
    public function label_user_list(Request $request)
    {
        $access_token=$this->access_token();
        $tag_id=$request->all()['id'];
        // dd($tag_id);
        //调接口
        $data=[
            'tagid'=>$tag_id,
            "next_openid"=>""
        ];
        $url="https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=$access_token";
        $re=$this->post($url,json_encode($data));
        $re=json_decode($re,1);
        // dd($re);
        $data=$re['data']['openid'];
        // dd($data);
        return view('wechat_label_user_list',['data'=>$data,'id'=>$tag_id]);
        
    }

    //批量为用户取消标签
    public function label_unset(Request $request)
    {
        $access_token=$this->access_token();
        $array=$request->all()['array'];
        // dd($array);
        $tag_id=substr($array,-3);
        // dd($tag_id);
        $openid=substr($array,0,-4);
        $openid=explode(',',$openid);
        // dd($openid);
        $data=[
            'openid_list'=>$openid,
            'tagid'=>$tag_id,
        ];
        // dd($data);
        $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=$access_token";
        $re=$this->post($url,json_encode($data));
        $re=json_decode($re,1);
        // dd($re);
        if($re['errcode']==0){
            return redirect('wechat/label_index');
        }else{
            echo "程序错误，您的全局返回码为".$re['errcode'];
        }
    }


    public function see_label(Request $request)
    {
        $access_token=$this->access_token();
        $openid=$request->all()['openid'];
        // dd($openid);
        $url1="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$access_token";
        $tag_info=file_get_contents($url1);
        $tag_info=json_decode($tag_info,1);
        $tag_info=$tag_info['tags'];
        // dd($tag_info);   
        $data=[
            'openid'=>$openid 
        ];
        $url="https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token=$access_token";
        $re=$this->post($url,json_encode($data));
        $re=json_decode($re,1);
        // dd($re);
        $data=$re['tagid_list'];
        // dd($data);
        $arr=[];
        foreach($tag_info as $vo){
            foreach($data as $v){
                if($v==$vo['id']){
                    $arr[]=$vo['name'];
                }
            }
        }
        // dd($arr);
        if($arr==false){
            echo "该粉丝还没有任何标签类型";die;
        }
        $data=implode(',',$data);
        // dd($data);
        $number=gettype(11111);
        // dd($number);
        if(array_key_exists('tagid_list',$re)){
            return view('wechat_see_label',['arr'=>$arr,'openid'=>$openid,'data'=>$data,'int'=>$number]);
        }else{
            echo "程序错误,您的全局返回码为".$re['errcode'];
        }
    }
    //获取标签的取消标签
    public function label_delete(Request $request)
    {   
        $data=$request->all()['array'];
        dd($data);
    }


    //清除接口调用限制
    public function wechat_del_access_token()
    {
        $access_token=$this->access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/clear_quota?access_token=$access_token";
        // dd($url);
        $appid="wx9f5dbb91dcfaee8f";
        $data = [
          'appid' =>$appid,
        ];  
        $datas = $this->post($url,json_encode($data));
        dd(json_decode($datas,1));
    }

    public function push_info(Request $request)
    {
        $tag_id=$request->all()['id'];
        // dd($tag_id);
        return view('wechat_push_info',['id'=>$tag_id]);
    }


    public function do_push_info(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $tag_id=$data['tag_id'];
        $content=$data['content'];
        // dd($content);
        $access_token=$this->access_token();
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$access_token";
        $data=[
            'filter'=>[
                'is_to_all'=>false,
                'tag_id'=>$tag_id
            ],
            'text'=>[
                'content'=>$content,
            ],
            'msgtype'=>"text",
        ];
        $re=$this->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        // dd($re);
        $re=json_decode($re,1);
        if($re['errcode']==0){
            return redirect('wechat/larbel_index');
        }else{
            echo "程序错误，您的全局返回码为".$re['errcode'];
        }
    }

    //创建公众号二维码
    public function ticket()
    {
        $access_token=$this->access_token();
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";
        $data=[
            "expire_seconds"=> 604800,
            "action_name"=> "QR_SCENE",
            "action_info"=>[
                'scene'=>[
                    'scene_id'=>'123'
                ],
            ],
        ];
        $re=$this->post($url,json_encode($data));
        $re=json_decode($re,1);
        $ticket=$re['ticket'];
        // dd($re);
        $ticket=urlencode($ticket);
        // dd($ticket);
        $url_two="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
        header("location:$url_two");
        // return view('wechat_ticket',['arr'=>$arr]);
        
    }
    //post请求(一般用于上传)
    public function guzzle($path,$url,$method)
    {
        $client = new Client();
        $response = $client->request("$method",$url,[
            'multipart' => [
                [
                    'name'     => 'media',  
                    'contents' => fopen(realpath($path), 'r')
                ],
            ]
        ]);
        $data=$response->getBody();
        return $data;
    }
    //被动回复消息、推送事件
    public function even()
    {
        $access_token=$this->access_token();
        $data=file_get_contents("php://input");
        file_put_contents(storage_path('/logs/wechat.log'),$data);
        //转对象
        $data=simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA);
        //dd($data);
        //转数组
        $data=get_object_vars($data);
//        dd($data);
        if($data['EventKey']==""){
//            echo 111;die;
            $openid=$data['FromUserName'];
//            dd($openid);

            $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
            $re=file_get_contents($url);
            $re=json_decode($re,1);
//            dd($re);
            $nickname=$re['nickname'];
            $arr=['nickname'=>$nickname,'openid'=>$openid,'create_time'=>time()];
//            dd($arr);
            DB::table('userinfo')->insert($arr);
            $xml_str = '<xml><ToUserName><![CDATA['.$data['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$data['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$nickname.',感谢您的关注]]></Content></xml>';

            echo $xml_str;die;
        }
        if($data['MsgType']=='image'){
            $pic=$data['PicUrl'];
//            dd($pic);
            $client=new Client();
//            dd($client);
            $pic_re=$client->get($pic);
//            dd($pic_re);
            $filename_end=$pic_re->getHeaders()['Content-Type'][0];
//            dd($filename_end);
            $end_name=explode('/',$filename_end);
//            dd($end_name);
            $end_name=array_pop($end_name);
//            dd($end_name);

            $file_name=rand(1000,9999).time().".".$end_name;
            $path=storage_path('/img'.$file_name);
//            dd($path);
            $a=Storage::disk('local')->put($path,$pic_re->getBody());
//            dd($a);
            if($a==true){
                $xml_str = '<xml><ToUserName><![CDATA['.$data['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$data['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[图片存入成功]]></Content></xml>';
                echo $xml_str;die;
            }else{
                $xml_str = '<xml><ToUserName><![CDATA['.$data['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$data['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[图片存入失败]]></Content></xml>';
                echo $xml_str;die;
            }

        }
//        dd($where);
        if((array_key_exists('Content',$data))==FALSE){
            $user_id=$data['EventKey'];
            $user_id=explode('_',$user_id);
            $user_id=array_pop($user_id);
//        dd($user_id);
            $user_where=[
                ['id','=',$user_id],
            ];
//        dd($user_where);
            $name=DB::table('admin_user')->where($user_where)->select('name')->first();
//            dd($name);
            $name=get_object_vars($name)['name'];
//        dd($name);
            $where=[
                ['name','=',$name],
            ];
            if($data['Event']=="subscribe"){
                //未关注
                
                //防刷单
                $count=DB::table('info')->where($where)->count();
//                dd($count);
                $info_where=[
                    ['openid','=',$data['FromUserName']],
                ];
                $openid_count=DB::table('info')->where($info_where)->count();
//                dd($openid_count);
                if($openid_count>0){
                    $xml_str = '<xml><ToUserName><![CDATA['.$data['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$data['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[关注成功!你已关注过公众号，不能同时多次关注!]]></Content></xml>';
                    echo $xml_str;die;
                }
                if($count>0){
                    $xml_str = '<xml><ToUserName><![CDATA['.$data['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$data['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[关注成功!你已经关注过公众号,不给你佣金!]]></Content></xml>';
                    echo $xml_str;die;
                }
                $arr=['openid'=>$data['FromUserName'],'name'=>$name];
//                dd($arr);
                $arrs=['openid'=>$data['FromUserName']];
                DB::table('admin_user')->where($where)->update($arrs);
                $res=DB::table('info')->insert($arr);
//                dd($res);
                $xml_str = '<xml><ToUserName><![CDATA['.$data['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$data['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[欢迎使用本公司提供的油价查询功能]]></Content></xml>';
                //响应回去
                echo $xml_str;die;
            }else{
                //已关注
                $xml_str = '<xml><ToUserName><![CDATA['.$data['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$data['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[你已关注本公众号,你好]]></Content></xml>';
                //响应回去
                echo $xml_str;die;
            }
        }else{
            $info="你好";
            if($data['Content']=='你好'){
                $info="你也好";
            }

            $xml_str = '<xml><ToUserName><![CDATA['.$data['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$data['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$info.']]></Content></xml>';
            //响应回去
            echo $xml_str;
        }
    }
    public function send_oil()
    {

    }
    //为您客户端创建菜单
    public function menu()
    {
        $access_token=$this->access_token();
        // dd($access_token);
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $data=[
            'button'=>[
                        [
                            'type'=>"click",
                            'name'=>"今日歌曲",
                            'key'=>"V1001_TODAY_MUSIC",
                        ],
                        [
                            'name'=>'菜单',
                            'sub_button'=>[
                                [
                                    'type'=>'view',
                                    'name'=>'搜索',
                                    'url'=>"https://www.baidu.com"
                                ],
                                [
                                        'type'=>'click',
                                        'name'=>'点我',
                                        'key'=>'V1001_GOOD'
                                ],
                            ],
                                
                        ],
                    ],

            
            ];

           
            // dd($data);
            $re=$this->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
            dd($re);
    }

    // //添加一级菜单
    // public function menu_add_one()
    // {
    //     return view('menu_add_one');
    // }


    // public function doadd_one(Request $request)
    // {
    //     $data=$request->all();
    //     // dd($data);
    //     $arr=['name'=>$data['name'],'type'=>$data['type'],'key'=>$data['key'],'url'=>$data['url']];
    //     // dd($arr);
    //     $where=[
    //         ['name','=',$data['name']],
    //     ];
    //     // dd($where);
    //     $count=DB::table('menu_one')->where($where)->count();
    //     // dd($count);
    //     if($count>0){
    //         echo "菜单名字已存在，请更换";die;
    //     }
    //     $res=DB::table('menu_one')->insert($arr);
    //     // dd($res);
    //     if($res){
    //         return redirect('wechat/menu_index');
    //     }else{
    //         echo "false";
    //     }
    // }


    //添加菜单


    public function menu_add()
    {
        return view('menu_add');
    }


    public function doadd(Request $request)
    {
        $access_token=$this->access_token();
        $data=$request->all();
        // dd($data);
        $res="";
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        if($data['menu_type']==1){
            //一级菜单 只能添加三条数据
            //menu_type为1，并且name_one不能重复
            if($data['name_one']==""){
                echo "你要添加的是一级菜单，名字不能为空";die;
            }
            $where=[
                ['name_one','=',$data['name_one']],
            ];
            // dd($where);
            $count=DB::table('menu')->where($where)->count();
            // dd($count);
            
            if($count>0){
                echo "你要添加的一级菜单已存在";die;
            }else{
                //微信客户端与数据库同步
                
                $arr=['name_one'=>$data['name_one'],'type'=>$data['type'],'key'=>$data['key'],'menu_type'=>$data['menu_type'],'url'=>$data['url']];
                // dd($arr);
                $res=DB::table('menu')->insert($arr);
                
            }
            
        }else{
            //二级菜单  只能添加五条数据
            //menu_type为2并且name_one不能为空可以重复,name_two不能为空不能重复,还可以不添加一级菜单，根据已有的一级菜单添加或更新耳机菜单
            $where=[
                ['name_two','=',$data['name_two']],
            ];
            // dd($where);
            $count=DB::table('menu')->where($where)->count();
            // dd($count);
            if($count>0){
                echo "你要添加的二级菜单已存在";die;
            }else{
                                           
                $arr=['name_one'=>$data['name_one'],'name_two'=>$data['name_two'],'type'=>$data['type'],'key'=>$data['key'],'url'=>$data['url'],'menu_type'=>$data['menu_type']];
                // dd($arr);
                $res=DB::table('menu')->insert($arr);
            }
            
        }
        if($res){
            return redirect('wechat/menu_index');
        }else{
            echo "false";
        }
    }

    //菜单列表
    public function menu_index()
    {
        $data=DB::table('menu')->get();
        // dd($data);
        return view('menu_index',['data'=>$data]);
    }
    //菜单删除
    public function menu_del(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['id','=',$id],
        ];
        // dd($where);
        $res=DB::table('menu')->where($where)->delete();
        // dd($res);
        if($res){
            return redirect('wechat/menu_index');
        }else{
            echo "false";
        }
    }


    public function push(Request $request)
    {
        $access_token=$this->access_token();
        $data=$request->all();
        // dd($data);
        $id=$data['array'];
        $id=explode(',',$id);
        // dd($id);
        $menu_info=DB::table('menu')->whereIn('id',$id)->get()->toarray();
        // dd($menu_info);
        $array=[];
        foreach($menu_info as $v){
            // echo "<pre>";
            $v=get_object_vars($v);
            $key=$v['id'];
            if($key==$v['id']){
                $array[$key]=$v;
            }
            
        }
        // dd($array);
        
        $keys="";
        $a=[
        [
            'name'=>'',
            'sub_button'=>[
                [
                    'type'=>'',
                    'name'=>'',
                ],
            ],
                
        ],
    ];
    // dd($array);

    $new_arr=[];
    $z_arr=[];
    $a_arr=[];
    static $n=[];
        foreach($a as $v){
            echo "<pre>";
            
            foreach($array as $item){
                $v['name']=$item['name_one'];
                $v['sub_button'][0]['type']=$item['type'];
                $v['sub_button'][0]['name']=$item['name_two'];
                $v['sub_button'][0]['name']=$item['name_two'];
                if($item['type']=='view'){    
                    $keys="url"; 
                    $v['sub_button'][0]["$keys"]=$item['url'];                                                    
                    $v['sub_button'][0]["type"]=$item['type'];
                    unset($v['sub_button'][0]['key']);
                }else if($item['type']=='click'){
                    $keys="key";     
                    $v['sub_button'][0]["$keys"]=$item['key'];                                            
                    $v['sub_button'][0]["type"]=$item['type'];                                   
                }
                // print_r($item);
                // print_r($v);
                $n=array_merge($n,$v['sub_button']);
                // print_r($n);
                // array_push($new_arr,$n);
                // print_r($new_arr);
            }
            // print_r($n);
            // print_r($v);
            $z_arr=array_merge($v['sub_button'],$n);
            array_shift($z_arr);
            // print_r($z_arr);
            $v['sub_button']=$z_arr;
            // print_r($v);
            $a_arr=$v;
            // print_r($a_arr);
            
        }
        // die;
        // dd($a);
        // dd($a_arr);
        $push_info=[
            'button'=>[
                [
                    'type'=>"view",
                    'name'=>"百度一下",
                    'url'=>"https://www.baidu.com",
                ],
                $a_arr,
            ],
        ];
        // dd($push_info);
        // dd($access_token);
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $re=$this->post($url,json_encode($push_info,JSON_UNESCAPED_UNICODE));
        $re=json_decode($re,1);
        // dd($re);
        if($re['errcode']==0){
            echo "推送成功";
        }else{
            echo "程序错误,全局返回码为".$re['errcode'];
        }
    }

    public function push_two(Request $request)
    {
        $access_token=$this->access_token();
        $data=$request->all()['array'];
        // dd($data);
        if($data==null){
            echo '数据为空,不能搞';die;
        }
        $id=explode(',',$data);
        // dd($id);
        $type="";
        $menu_arr=[];
        foreach($id as $v){
            echo "<pre>";
            // echo $v;
            $where=[
                ['id','=',$v],
            ];
            // print_r($where);
            $type=DB::table('menu')->select('menu_type')->where($where)->first();
            $type=get_object_vars($type)['menu_type'];
            // print_r($type);
            if($type==1){
                //一级菜单
                $where=[
                    ['menu_type','=',$type],
                    ['id','=',$v],
                ];
                // print_r($where);
                $menu_one=DB::table('menu')->where($where)->first();
                $menu_one=get_object_vars($menu_one);              
                // print_r($menu_one);
                array_push($menu_arr,$menu_one);
            }else{
                //二级菜单
                $where=[
                    ['menu_type','=',$type],
                    ['id','=',$v],
                ];
                // print_r($where);
                $menu_two=DB::table('menu')->where($where)->first(); 
                $menu_two=get_object_vars($menu_two);              
                // print_r($menu_two);
                array_push($menu_arr,$menu_two);

            }
        }
        // dd($menu_arr);
        $menu_one_info=[];
        $menu_two_info=[];
        foreach($menu_arr as $v){
            echo "<pre>";
            // print_r($v);
            if($v['menu_type']==1){
                $menu_one_info[]=$v;
            }else{
                $menu_two_info[]=$v;
            }

        }
        // dd($menu_one_info);
        // dd($menu_two_info);
        //要创建一级菜单就走下面，menu_one_info为空不走
        $type="";
        $name="";
        $push_do_info=[];
        if($menu_one_info!=""){
            $push_info=[
                'button'=>[
                    [
                        'type'=>"",
                        'name'=>"",
                    ],
                    
                ],
            ];
            $a=[];
            $b=[];
            // dd($push_info);
            //一级菜单有几条数据就循环几个push_info
            foreach($menu_one_info as $v){
                echo "<pre>";
                // print_r($v);
                foreach($push_info as $item){
                    // print_r($item);
                    //判断事件类型
                    if($v['type']=='view'){
                        //view类型的
                        $item[0]['type']=$v['type'];
                        $item[0]['name']=$v['name_one'];
                        $item[0]['url']=$v['url'];
                    // print_r($item);
                    }else{
                        //click类型的
                        $item[0]['type']=$v['type'];
                        $item[0]['name']=$v['name_one'];
                        $item[0]['key']=$v['key'];
                        // print_r($item);                     
                    }
                  
                    $a[]=array_merge($item[0]);
                    // print_r($a);  
                }
            }
            // dd($a);
            $push_do_info=[
                'button'=>
                    $a,
            ];
            // dd($push_do_info);
            
            // dd($re);
        }
        // dd($type);
        //一级推得菜单
            // dd($push_do_info);

        //二级菜单为空不走
        $gg=[];
        if($menu_two_info!=[]){
            $two_a=[
                [
                    'name'=>'',
                    'sub_button'=>[
                        [
                            'type'=>'',
                            'name'=>'',
                        ],
                    ],
                        
                ],
            ];
            // dd($menu_two_info
            $qq=[];
            $zz=[];
            foreach($menu_two_info as $v){
                echo "<pre>";
                // print_r($v);
                foreach($two_a as $item){
                    // print_r($item['sub_button']);
                    $item['name']=$v['name_one'];
                    if($v['type']=='click'){
                        //click事件
                        $item['sub_button'][0]['type']=$v['type'];
                        $item['sub_button'][0]['name']=$v['name_two'];
                        $item['sub_button'][0]['key']=$v['key'];
                        // print_r($item);
                    }else{
                        //view事件
                        $item['sub_button'][0]['type']=$v['type'];
                        $item['sub_button'][0]['name']=$v['name_two'];
                        $item['sub_button'][0]['url']=$v['url'];
                        // print_r($item);
                        
                    }
                    $qq[]=array_merge($item['sub_button'][0]);
                    $item['sub_button']=$qq;
                    // print_r($item);
                    $zz=$item;
                   
                    
                }
                
            }
            // dd($zz);
            $gg[]=$zz;
                    

        }
        echo "<pre>";
        // die;
        // dd($gg);
        // dd($push_do_info);
        if($gg==[]){
            dd($push_do_info);
            $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
            $re=$this->post($url,json_encode($push_do_info,JSON_UNESCAPED_UNICODE));
            // dd($re);
            $re=json_decode($re,1);
            // die;
            if($re['errcode']==0){
                return redirect('wechat/menu_index');
            }else{
                echo "程序错误,您的全局返回码为".$re['errcode'];
            }
            die;
        }
        
        $xxoo=array_merge($push_do_info['button'],$gg);
        // $xxoo
        // print_r($xxoo);
        // dd($access_token);
        // dd($xxoo);
        $ooxx=[
            'button'=>$xxoo,
        ];
        // dd($ooxx);
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $re=$this->post($url,json_encode($ooxx,JSON_UNESCAPED_UNICODE));
        // dd($re);
        $re=json_decode($re,1);
        // dd($re);
        if($re['errcode']==0){
            return redirect('wechat/menu_index');
        }else{
            echo "程序错误,您的全局返回码为".$re['errcode'];
        }
            
    }

    public function config()
    {
        $config = [
            'app_id' => 'wx9f5dbb91dcfaee8f',
            'secret' => 'b084b27bcbb10ce63e3b37913ded5d3f',

            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            //...
        ];
        return $config;
    }

    public function user()
    {
        $config=$this->config();
        // dd($config);
        $app = Factory::officialAccount($config);
        $re=$app->user->list($nextOpenId = null);  // $nextOpenId 可选
        dd($re);
    }

    public function file_get_contents()
    {
        $url="http://www.laravel.com/san";
        $query=['name'=>'张三'];
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
    public function san()
    {
        return 3333;
    }
    
}

