<?php

namespace App\Http\Controllers\good;

include "../App/qny/autoload.php";
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Qiniu\Auth;


class goods extends Controller
{
    //无限极分类排序
    public function commit($data,$p_id,$level=1)
    {
        static $arr=[];
        // dd($data);
        foreach($data as $k=>$v){
            // print_r($v);
            if($v['p_id']==$p_id){
                $v['level']=$level;
                $arr[]=$v;
                
                // echo $v['p_id'];
                $this->commit($data,$v['id'],$level+1);

            }
        }
        // print_r($arr);
        return $arr;
        
    }


   //分类

    public function cate()
    {
        $info=DB::table('goods_cate')->get()->toarray();
        $data=[];
        foreach($info as $k=>$v){
            $data[]=get_object_vars($v);
            // var_dump($v);
        }
        // dd($data);
        $arr=$this->commit($data,0);
        // dd($arr);
        return view('goods_cate',['arr'=>$arr]);
    }

    public function docate(Request $request)
    {
        $name=$request->all()['name']??"";
        // dd($name);
        $p_id=$request->all()['p_id']??"";
        if($name==""){
            echo "分类不能为空";die;
        }
        $where=[
            ['name','=',$name],
        ];
        $count=DB::table('goods_cate')->where($where)->count();
        // dd($count);
        if($count>0){
            echo "该分类已有";die;
        }
        $arr=['name'=>$name,'p_id'=>$p_id];
        $res=DB::table('goods_cate')->insert($arr);
        // dd($res);
        if($res){
            return redirect('goods/type');
        }else{
            echo "false";
        }
    }


    //属性

    public function style()
    {
        $data=DB::table('goodstype')->get()->toarray();
        // dd($data);
        return view('goods_style',['data'=>$data]);
    }

    public function dostyle(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $arr=['type_name'=>$data['type_name'],'name'=>$data['name'],'is_radio'=>$data['is_radio']];
        // dd($arr);
        $res=DB::table('goods_style')->insert($arr);
        if($res){
            return redirect('goods/style_list');
        }else{
            echo "false";
        }
    }

    //不带参数
    public function style_list(Request $request)
    {
        //接搜索参数
        $name=$request->all()['name']??"";
        // echo $name;
        $where=[
            ['name','like',"%$name%"],
        ];
        // print_r($where);
        $data=DB::table('goods_style')->where($where)->paginate(3);
        return view('goods_style_list',['data'=>$data,'name'=>$name]);
    }
    
    //属性列表带参数

    public function style_index(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['type_name','=',$id],
        ];
        $data=DB::table('goods_style')->where($where)->get()->toarray();
        // dd($data);
        return view('goods_style_index',['data'=>$data]);
    }


    //类型
    public function type()
    {
        return view('goods_type');
    }

    public function dotype(Request $request)
    {
        $name=$request->all()['name'];
        // dd($data);
        $arr=['name'=>$name];
        $res=DB::table('goodstype')->insert($arr);
        if($res){
            return redirect('goods/type_index');
        }else{
            echo "false";
        }
    }
    //类型列表
    public function type_index()
    {
        $data=DB::table('goodstype')->get()->toarray();
        // dd($data);
        // $id=array_column($data,'id');
        // dd($id);
        $arr=[];
        foreach($data as $k=>$v){
            $v=get_object_vars($v);
            $arr[]=$v;
        }
        // dd($arr);
        foreach($arr as $k=>$v){
            // print_r($v);
            $count=DB::table('goods_style')->where(['type_name'=>$v['id']])->count();
            // echo $count;
            $arr[$k]['count']=$count;
            
        }
        // dd($arr);

        return view('goods_type_index',['arr'=>$arr]);
    }

    public function create_goods()
    {

    }

    //唯一性分类
    public function yi(Request $request)
    {
        $name=$request->all()['name'];
        // dd($name);
        $where=[
            ['name','=',$name],
        ];
        $count=DB::table('goods_cate')->where($where)->count();
        // dd($count);
        if($count>0){   
            return 0;
        }else{
            return 1;
        }
    }

    //批删
    public function del(Request $request)
    {
        $arr=$request->all()['arr'];
        // dd($arr);
        $arr=explode(',',$arr);
        // dd($arr);
        $res=DB::table('goods_style')->whereIn('id',$arr)->delete();
        // dd($res);
        if($res){
            return redirect('goods/style_list');
        }else{
            echo "false";
        }
    }


    public function vedio()
    {
        $data=['id'=>1,'src'=>'http://q0j0tq277.bkt.clouddn.com/Fhq0n_GAppRawyQqp3aAYbShUOHU'];
        echo json_encode(['code'=>1,'arr'=>$data],JSON_UNESCAPED_UNICODE);
    }

    public function test()
    {
        
        // $auth=new Auth();
        // dd($auth);
        // echo date('Y-m-d H:i:s',time()-24*3600);die;
        // echo strtotime(date('Y-m-d H:i:s',time()));die;
        $data=[
            ['id'=>1,'src'=>'http://q0j0tq277.bkt.clouddn.com/ddd426d35d77e972.jpg'],
            ['id'=>2,'src'=>'/images/s.png'],
            ['id'=>3,'src'=>'/images/person.png'],
        ];
        echo json_encode($data);
    }

    public function info()
    {
        $data=DB::table('infp')->get()->toarray();
        // dd($data);
        $arr=[];
        foreach($data as $k=>$v){
            $arr[]=get_object_vars($v);
        }   
        // dd($arr);
        $re=['code'=>200,'arr'=>$arr];
        // dd($re);
        echo json_encode($re,JSON_UNESCAPED_UNICODE);
    }

    public function search(Request $request)
    {
        $name=$request->all()['name']??"";
        // dd($name);
        if($name==""){
            echo json_encode(['code'=>203,'msg'=>'搜索条件为空'],JSON_UNESCAPED_UNICODE);die;
        }
        // $name="";
        $where=[];
        if($name!=""){
            $where=[
                ['name','like',"{$name}%"],
            ];
        }   
        // dd($where);
        $data=DB::table('search')->where($where)->get()->toarray();
        // dd($data);
        if($data!=""){
            $arr=[];
            foreach($data as $k=>$v){
                $arr[]=get_object_vars($v);
            }
            // dd($arr);
            echo json_encode(['code'=>200,'data'=>$arr],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>110,'msg'=>'未搜到数据'],JSON_UNESCAPED_UNICODE);
        }
        
    }

    public function auth()
    {

        // $a=["红色",'蓝色','蓝色'];
        // $b=['37','38','39'];
        // $c=['长','短'];
        // $info=[];
        // foreach($a as $k=>$v){
        //    foreach($b as $kk=>$vv){
        //        foreach($c as $kkk=>$vvv){
        //             $info[]=[$v.$vv.$vvv];
        //        }
        //    }
            
        // }
        // // dd($info);
        $ak="5V9DkGEmJygwe82t-jZ35FryoV_EXmMZd5bIuz2t";
        $sk="DkHe43_m7Ox_0U8c447DpqWED2JIAMpjrg-1brXc";
        $bucket="1902qiaozhiwei";
        $auth=new Auth($ak,$sk);
        // dd($auth);
        $token=$auth->uploadToken($bucket);
        echo $token;
    }


    public function auth_index()
    {
        return view('goods/auth_index');
    }

  
}
