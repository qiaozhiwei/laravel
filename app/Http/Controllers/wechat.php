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
        // $re=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}");
        // $re=json_decode($re,1);
        // $access_token=$re['access_token'];
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
        // // dd($access_token);
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
        $url="http://www.laravel.com/wechat/code";
        // dd(urlEncode($url));
        // dd(urlencode($url));
        $redirect_url=urlencode($url);
        // dd($redirect_url);
        $re=("https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect");
        // dd($re);
        // file_get_contents("$re");
        header("Location:$re");
    }

    public function code(Request $request)
    {
        $appid="wx9f5dbb91dcfaee8f";
        $appsecret="b084b27bcbb10ce63e3b37913ded5d3f";
        $code=$request->all()['code'];
        // dd($code);
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        // header("location:$url");
        $re=file_get_contents($url);
        $re=json_decode($re,1);
        // dd($re);
        $openid=$re['openid'];
        // dd($openid);
        $request->session()->put('openid',"$openid");
        $access_token=$this->access_token();
        // dd($access_token);
        $get_userinfo_url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
        $data=file_get_contents($get_userinfo_url);
        $data=json_decode($data,1);
        // dd($data);
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
        // dd($data);
        $ch=curl_init();
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
    
    public function even()
    {
        echo 111;
    }
}
