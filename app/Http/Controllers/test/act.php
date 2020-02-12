<?php

namespace App\Http\Controllers\test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class act extends Controller
{
    //添加活动
    public function create_act()
    {
        // echo date("Y-m-d H:i:s",time());die;
        return view("test/create_act");
    }

    public function docreate_act(Request $request)
    {
        // dd($request->all());
        $data=['act_name'=>$request->all()['act_name'],"time_test"=>strtotime($request->all()['time_test']),"time_end"=>strtotime($request->all()['time_end']),"money"=>$request->all()['money'],"desc"=>$request->all()['desc'],"total_people"=>$request->all()['total_people']];
        // dd($data);
        $res=DB::table("act")->insert($data);
        // echo $res;
        if($res){
            return redirect("act/act_index");
        }else{
            echo "出错";
        }
    }

    public function act_index()
    {
        $info=DB::table("act")->get();
        // dd($info[0]->act_name);
        return view("test/act_index",["info"=>$info,"time"=>time()]);
    }

    public function sign(Request $request)
    {
        $act_id=$request->all()['a_id'];
        return view("test/create_sign",['act_id'=>$act_id]);
    }

    public function dosign(Request $request)
    {
        // dd($request->all());
        $where=[
            ['act_id','=',$request->all()['act_id']]
        ];
        // dd($where);
        $arr=DB::table("act")->where($where)->first();
        // dd($arr->act_id);
        if($arr->total_people-$arr->exis_num==0){
            echo "名额已满";die;
        }
        $wheres=[
            ['name','=',$request->all()['name']],
            ['act_id','=',$request->all()['act_id']]
        ];
        $count=DB::table("sign")->where($wheres)->count();
        // dd($count);
        if($count>0){
            echo "您近日已经参与过该活动";die;
        }
        $ww=[
            ['name','=',$request->all()['name']],
        ];
        $name_count=DB::table("sign")->where($ww)->get()->count();
        // dd($name_count);
        $ce="";
        if($name_count!=0){
            // dd($request->all()['act_id']);
            //拿到新活动的集合时间
            $lll=[
                ['act_id','=',$request->all()['act_id']],
            ];
            $new_time=DB::table("act")->where($lll)->select("time_test")->first();
            $new_time=get_object_vars($new_time)['time_test'];
            // dd($new_time);
            //拿到已参加的活动的时间
            $sss=DB::table("sign")->where($ww)->get()->toarray();
            $ids=[];
            foreach($sss as $k=>$v){
                $ids[]=$v->act_id;
            }
            $ids=array_unique($ids);
            // echo $request->all()['act_id'];
            // dd($ids);
            $array=[];
            $ggg=DB::table("act")->whereIn("act_id",$ids)->get()->toarray();
            foreach($ggg as $k=>$v){
                $array[]=get_object_vars($v);
            }
            // echo $new_time;
            // dd($array);
            foreach($array as $k=>$v){
                if($new_time==$v['time_test']){
                    $ce.=$v['time_test'];
                }else{
                    $ce.="";
                }
            }
        }
        // dd($ce);
        if($ce!=""){
            echo "您在".date("Y-m-d H:i:s",$ce)."日的活动冲突,请核对";die;
        }
        $wheress=[
            ['phone','=',$request->all()['phone']],
            ['act_id','=',$request->all()['act_id']]
        ];
        $count_phone=DB::table("sign")->where($wheress)->count();
        // dd($count_phone);
        if($count_phone>0){
            echo "该手机号已经被绑定";die;
        }
        $data=['phone'=>$request->all()['phone'],'name'=>$request->all()['name'],"act_id"=>$request->all()['act_id']];
        // dd($data);
        $res=DB::table("sign")->insert($data);
        DB::table("act")->where($where)->update(['exis_num'=>$arr->exis_num+1]);
        // dd($res);
        if($res){
            return redirect("act/act_index");
        }else{
            echo "报名失败";
        }
        
        
    }

    public function sign_list()
    {
        $data=DB::table('sign')
        ->leftJoin('act', 'sign.act_id', '=', 'act.act_id')
        ->get()
        ->toarray();
        // dd($data);
        // $arr=[];
        // foreach($data as $k=>$v){
        //     $arr[]=get_object_vars($v);
        // }
        // // dd($arr);
        // $info=[];
        // foreach($arr as $k=>$v){
        //     $info[$v['name']][]=$v['act_name'];
        //     $info[$v['name']][]=$v['name'];
        // }
        // dd($info);
        // echo "<pre>";
        // $infos=[];
        // foreach($info as $k=>$v){
        //     // print_r($v);
        //     $infos[]=array_unique($v);
        // }
        // dd($infos);
        return view("test/sign_list",['data'=>$data]);
    }

    public function aaa()
    {
        $data=[5,2,6,8,1,3];
        $count=count($data);
        for($i=1;$i<$count;$i++){//冒泡的轮数
            for($a=0;$a<$count-$i;$a++){//每一轮中比较的次数
                if($data[$a]>$data[$a+1]){
                    $b=$data[$a];
                    $data[$a]=$data[$a+1];
                    $data[$a+1]=$b;
                }
            }
        }
        echo "<pre>";
        print_r($data);
    }
}


