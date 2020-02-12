<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat;
include "../App/qny/autoload.php";
use Qiniu\Auth;
use App\Http\Model\music;
use DB;




class index extends Controller
{
    public function index()
    {
        return view("index/index");
    }

    public function music_upload()
    {
        $access_token=$this->access_token();
        return view("index/music_upload",['access_token'=>$access_token]);
    }

    // public function do_mupload(Request $request)
    // {
    //     $wechat=new wechat;
    //     $access_token=$this->access_token();
    //     $type="voice";
    //     $data=$request->file();
    //     $time=time();
    //     // dd($data);
    //     $path="";
    //     if($data!=""){
    //         $path=$data['media']->storeAs("music","$time.mp3");
    //         // dd($path);
    //     }
    //     // dd($access_token);
    //     $info=['media'=>$data['media']];
    //     // dd($info);
    //     $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$access_token&type=voice";
    //     $re=$wechat->post($url,$data['media']);
    //     dd($re);
    // }

    public function access_token()
    {
        $wechat=new wechat;
        $access_token=$wechat->access_token();
        return $access_token;
    }

    public function img_upload()
    {
        $token=$this->qny_token();
        return view("index/img_upload",['token'=>$token]);
    }

    //七牛云获取token
    public function qny_token()
    {
        $ak="5V9DkGEmJygwe82t-jZ35FryoV_EXmMZd5bIuz2t";
        $sk="DkHe43_m7Ox_0U8c447DpqWED2JIAMpjrg-1brXc";
        $bucket="1902qiaozhiwei";
        $auth=new Auth($ak,$sk);
        // dd($auth);
        $token=$auth->uploadToken($bucket);
        return $token;
    }

    //分类添加
    public function cate_create()
    {
        return view("index/cate_create");
    }

    public function docreate_cate(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $arr=['c_name'=>$data['c_name']];
        // dd($arr);
        $res=DB::table('x-admin_cate')->insert($arr);
        // dd($res);
        if($res){
            return redirect("index/cate_index");
        }else{
            echo "添加失败";
        }
    }


    //分类列表

    public function cate_index()
    {
        $data=DB::table('x-admin_cate')->get();
        // dd($data);
        return view('index/cate_index',['data'=>$data]);
    }

    //分类修改

    public function cate_update(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['c_id','=',$id],
        ];
        $data=DB::table('x-admin_cate')->where($where)->first();
        $data=get_object_vars($data);
        // dd($data);
        $c_name=$data['c_name'];
        return view("index/cate_update",['id'=>$id,'c_name'=>$c_name]);
    }

    public function doupdate_cate(Request $request)
    {
        $name=$request->all()['c_name'];
        // dd($name);
        $id=$request->all()['id'];
        $arr=['c_name'=>$name];
        $where=[
            ['c_id','=',$id],
        ];
        $res=DB::table('x-admin_cate')->where($where)->update($arr);
        // dd($res);
        if($res){
            return redirect("index/cate_index");
        }else{
            echo "修改失败";
        }
    }

    //分类删除

    public function cate_delete(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['c_id','=',$id],
        ];
        $res=DB::table('x-admin_cate')->where($where)->delete();
        // dd($res);
        if($res){
            return redirect("index/cate_index");
        }else{
            echo "删除失败";
        }
    }

    //获取素材
    public function vedio()
    {
        
    }


    //上传资源到本地
    public function upload()
    {
        $cate_info=Db::table('x-admin_cate')->get()->toarray();
        $data=[];
        foreach($cate_info as $k=>$v){
            $data[]=get_object_vars($v);
        }
        // dd($data);
        return view("index/upload",['data'=>$data]);
    }

    public function doupload(Request $request)
    {
        // dd($request->all());
        $file=$request->file();
        // dd($file);
        $time=time();
        if($file!=[]){
            $img_path=$file['img']->storeAs("music",$time.'.png');
        }
        // dd($img_path);
        $name=$request->all()['name'];
        $data=$request->file();
        $person=$request->all()['person'];
        // dd($data);
        $path="";
        if($data!=""){
            $path=$data['media']->storeAs("music",$time.".mp3");
        }   
        $path="storage/$path";
        $img_path="storage/$img_path";
        // dd($path);
        $music=new music;
        // dd($music);
        $arr=['name'=>$name,'path'=>$path,'type'=>'voice','person'=>$person,"img"=>$img_path,'c_id'=>$request->all()['c_id']];
        // dd($arr);
        $res=DB::table('x-admin_music')->insert($arr);
        // dd($res);
        if($res){
            return redirect("index/index");
        }else{
            echo "添加失败";
        }
    }

    public function get_vedio(Request $request)
    {
        $id=$request->all()['id']??"";
        // dd($id);
        $name=$request->all()['name']??"";
        // dd($name);
        $data=[];
        if($name!=""){
            //搜索
            $where=[
                ['name','=',$name],
            ];
            $orwhere=[
                ['person','=',$name],
            ];
            $arr=DB::table("x-admin_music")->where($where)->orwhere($orwhere)->get()->toarray();
            // dd($data);
            if($arr){
                foreach($arr as $k=>$v){
                    $data[]=get_object_vars($v);
                }
            }
            

        }
        // dd($data);
        if($id!=""){
            //轮播图
            $where=[
                ['id','=',$id],
            ];
            $data=DB::table('x-admin_music')->where($where)->first();
            // dd($data);
            if($data!=[]){
                $data=get_object_vars($data);

            }
        }
        
        if($data==[]){
            echo json_encode(['code'=>201,'没有这首歌']);die;
        }
        // dd($arr);
        echo json_encode(['code'=>200,'data'=>$data],JSON_UNESCAPED_UNICODE);
    }

    public function get_img()
    {
        $data=DB::table('x-admin_music')->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            // print_r($v);
            $arr[]=get_object_vars($v);
        }
        // dd($arr);
        return json_encode(['code'=>200,'data'=>$arr]);
    }

    public function get_cate()
    {
        $data=DB::table('x-admin_cate')->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            $arr[]=get_object_vars($v);
        }
        // dd($arr);
        echo json_encode(['code'=>200,'data'=>$arr],JSON_UNESCAPED_UNICODE);
    }

    public function get_where_cate(Request $request)
    {
        $c_id=$request->all()['id'];
        // dd($c_id);
        // $c_id=3;
        $where=[
            ['c_id','=',$c_id],
        ];
        $data=DB::table('x-admin_music')->where($where)->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            $arr[]=get_object_vars($v);
        }
        // dd($arr);
        echo json_encode(['code'=>200,'data'=>$arr],JSON_UNESCAPED_UNICODE);
    }


    //添加历史记录
    public function create_history(Request $request)
    {
        // dd($request->all());
        $name=$request->all()['name']??"";
        $path=$request->all()['path']??"";
        $res="";
        if($name!="" && $path!=""){
            $data=['name'=>$name,'path'=>$path,'play_time'=>time()];
            // dd($data);
            $res=DB::table("x-admin_history")->insert($data);
        }else{
            echo json_encode(['code'=>201,'msg'=>'前台传输数据为空'],JSON_UNESCAPED_UNICODE);
        }
        if($res){
            echo json_encode(['code'=>1]);
        }else{
            echo json_encode(['code'=>2]);
        }
    }

    public function history_index()
    {
        $data=DB::table("x-admin_history")->get()->toarray();
        // dd($data);
        $arr=[];
        if($data!=[]){
            foreach($data as $k=>$v){
                $arr[]=get_object_vars($v);
            }
        }else{
            echo json_encode(['code'=>201,'msg'=>'没有历史记录']);die;
        }
        // dd($arr)
        echo json_encode(['code'=>200,'data'=>$arr],JSON_UNESCAPED_UNICODE);
    }


    public function history_del(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $res="";
        if($id!=""){
            $where=[
                ['id','=',$id],
            ];
            $res=DB::table("x-admin_history")->where($where)->delete();
            // dd($res);
        }
        if($res){
            echo json_encode(['code'=>1]);
        }else{
            echo json_encode(['code'=>2]);
        }
    }

    public function song_list()
    {
        $data=DB::table('x-admin_music')->get()->toarray();
        // dd($data);
        $arr=[];
        if($data!=[]){
            foreach($data as $k=>$v){
                $arr[]=get_object_vars($v);
            }
        }
        // dd($arr);
        echo json_encode(['code'=>200,'data'=>$arr],JSON_UNESCAPED_UNICODE);
    }


}

// 关注
// <xml>
//   <ToUserName><![CDATA[toUser]]></ToUserName>
//   <FromUserName><![CDATA[FromUser]]></FromUserName>
//   <CreateTime>123456789</CreateTime>
//   <MsgType><![CDATA[event]]></MsgType>
//   <Event><![CDATA[subscribe]]></Event>
// </xml>

// 扫码
// <xml>
//   <ToUserName><![CDATA[toUser]]></ToUserName>
//   <FromUserName><![CDATA[FromUser]]></FromUserName>
//   <CreateTime>123456789</CreateTime>
//   <MsgType><![CDATA[event]]></MsgType>
//   <Event><![CDATA[subscribe]]></Event>
//   <EventKey><![CDATA[qrscene_123123]]></EventKey>
//   <Ticket><![CDATA[TICKET]]></Ticket>
// </xml>

// 接收消息
// xml>
//   <ToUserName><![CDATA[toUser]]></ToUserName>
//   <FromUserName><![CDATA[fromUser]]></FromUserName>
//   <CreateTime>1348831860</CreateTime>
//   <MsgType><![CDATA[text]]></MsgType>
//   <Content><![CDATA[this is a test]]></Content>
//   <MsgId>1234567890123456</MsgId>
// </xml>

// <xml>
//   <ToUserName><![CDATA[toUser]]></ToUserName>
//   <FromUserName><![CDATA[fromUser]]></FromUserName>
//   <CreateTime>12345678</CreateTime>
//   <MsgType><![CDATA[music]]></MsgType>
//   <Music>
//     <Title><![CDATA[TITLE]]></Title>
//     <Description><![CDATA[DESCRIPTION]]></Description>
//     <MusicUrl><![CDATA[MUSIC_Url]]></MusicUrl>
//     <HQMusicUrl><![CDATA[HQ_MUSIC_Url]]></HQMusicUrl>
//     <ThumbMediaId><![CDATA[media_id]]></ThumbMediaId>
//   </Music>
// </xml>