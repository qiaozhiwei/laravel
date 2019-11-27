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
        return view("index/music_upload");
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
        return view("index/img_upload");
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
        return view("index/cate_update",['id'=>$id]);
    }

    public function doupdate_cate(Request $request)
    {
        $name=$request->all()['c_name'];
        // dd($name);
        $id=$request->all()['id'];
        $arr=['c_name'=>$name];
        $where=[
            ['id','=',$id],
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
            ['id','=',$id],
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
        return view("index/upload");
    }

    public function doupload(Request $request)
    {
        $name=$request->all()['name'];
        $data=$request->file();
        // dd($data);
        $time=time();
        $path="";
        if($data!=""){
            $path=$data['media']->storeAs("music",$time.".mp3");
        }   
        $path="storage/$path";
        // dd($path);
        $music=new music;
        // dd($music);
        $arr=['name'=>$name,'path'=>$path,'type'=>'voice'];
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
        $name=$request->all()['name'];
        // dd($name);
        $where=[
            ['name','=',$name],
        ];
        $data=DB::table("x-admin_music")->where($where)->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            // print_r($v);
            $arr[]=get_object_vars($v);
        }
        // dd($arr);
        echo json_encode(['code'=>200,'data'=>$arr],JSON_UNESCAPED_UNICODE);
    }
}
