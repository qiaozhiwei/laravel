<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\user;
use App\Http\Model\Goods;
use App\Http\Controllers\wechat;
use App\Http\Model\member as members;
use DB;
use App\Http\Controllers\api\ziyuan;


class member extends Controller
{
    /*
        查询会员数据表
    */
    public function show()
    {
        $user=new user;
        // dd($user);
        $user_info=$user->get()->toarray();
        // dd($user_info);
        return json_encode($user_info);
    }

    public function get_info()
    {
        $url="http://123.57.18.167/member/show";
        $re= file_get_contents($url);
        // dd($re);
    }


    public function get_GoodsInfo(wechat $wechat)
    {
        //传good_name
        $url="http://123.57.18.167/member/Goods_info";
        $data=['goods_name'=>'茶几'];
        $re=$wechat->post($url,json_encode($data));
        dd($re);
        
        
    }

    public function Goods_info(Request $request)
    {
        // file_get_contents('php://input');
        $good_name=$request->all();
        // dd($good_name);
        // $good_name="茶几";
        if(empty($good_name)){
            return "110";die;
        }
        $good=new Goods;
        // dd($good);
        $where=[
            ['goods_name','=',$good_name],
        ];
        $data=$good->where($where)->first();
        return json_encode($data);
    }

    //添加会员
    public function create()
    {
        return view('member_create');
    }

    public function docreate(Request $request)
    {
        $members=new members;
        // dd($members);
        $name=$request->all()['name'];
        // dd($name);
        $tel=$request->all()['tel'];
        // dd($tel);
        $data=['name'=>$name,'tel'=>$tel];
        // dd($data);
        $res=$members->insert($data);
        if($res){
            //插入成功
            return json_encode(['errcode'=>200,'msg'=>'添加成功'],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['errcode'=>110,'msg'=>'程序错误'],JSON_UNESCAPED_UNICODE);
        }
    }


    //会员的列表
    public function index()
    {
        $members=new members;
        $data=$members->get()->toarray();
        // dd($data);
        // $data = json_encode($data);
        if($data!=[]){
            return json_encode(['code'=>200,'data'=>$data],JSON_UNESCAPED_UNICODE);
            // return $data;
        }else{
            echo json_encode(['code'=>110,'msg'=>'查询失败'],JSON_UNESCAPED_UNICODE);die;
            // return false;
        }
    }

    public function index1()
    {
        return view('member_index');
    }

    public function query(Request $request)
    {
        $members=new members;        
        $id=$request->all()['id'];
        // $id=1;
        if($id==""){
            return json_encode(['code'=>110,'msg'=>'程序错误']);
        }
        $where=[
            ['id','=',$id],
        ];
        // dd($where);
        $data=DB::table('member')->where($where)->first();
        $data=get_object_vars($data);
        // dd($data);
        if($data!=[]){
            return json_encode(['code'=>200,'data'=>$data]);
            // return $data;
        }else{
            return json_encode(['code'=>110,'msg'=>'false']);
            // return false;
        }
        
    }

    public function del(Request $request)
    {
        $members=new members;
        $id=$request->all()['id'];
        // dd($id);
        if($id==""){
            return json_encode(['cdoe'=>110,'msg'=>'程序错误']);
        }
        $where=[
            ['id','=',$id],
        ];
        // dd($where);
        $res=$members->where($where)->delete();
        // dd($res);
        if($res){
            return json_encode(['code'=>200,'msg'=>'ok']);
        }else{
            return json_encode(['code'=>110,'msg'=>'false']);
        }
    }

    public function update(Request $request)
    {
        $data=$request->all()['data'];
        // dd($data);
        $arr=explode(',',$data);
        // dd($arr);
        
        return view('member_update',['arr'=>$arr]);
    }

    public function doupdate(Request $request)
    {
        
    }

    public function xxoo(Request $request)
    {
        $name=$request->all()['name']??"";
        // dd($name);
        $tel=$request->all()['tel']??"";
        $sign=$request->all()['sign']??"";
        if($name==""){
            echo "名子不能为空";die;
        }
        if($tel==""){
            echo "电话不能为空";die;
        }
        if($tel==""){
            echo "签名不能为空";die;
        }
        $tmp_str=md5('shehui'.$name.$tel);
        // echo $tmp_str;die;
        if($tmp_str!=$sign){
            echo "签名有误";die;
        }
        $data=['name'=>$name,'tel'=>$tel];
        $members=new members;
        $res=$members->insert($data);
        if($res){
            echo "数据插入成功";die;
        }else{
            echo "数据插入失败";
        }
        
    }
    public function a()
    {
        echo phpinfo();
    }

    //文件上传接口
    public function upload()
    {
        
    }

    
}
    