<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class cai extends Controller
{
    public function index()
    {
        // echo (time()-86400);die;
        // echo time();die;
        $data=DB::table('cai')->get()->toarray();
        // dd($data);
        return view('cai_index',['data'=>$data,'time'=>time()]);
    }
    public function add()
    {
        return view('cai_add');
    }
    public function doadd(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $c_time=time()+86400;
        $arr['c_time']=$c_time;
        $arr['name1']=$data['name1'];
        $arr['name2']=$data['name2'];
        // dd($arr);
        $res=DB::table('cai')->insert($arr);
        // dd($res);
        if($res){
            return redirect('cai/index');
        }else{
            return redirect('cai/add');
        }
    }

    public function cai(Request $request)
    {
        $name=$request->all()['name'];
        // dd($name);
        $name=explode(',',$name);
        // dd($name);
        $name1=$name[0];
        $name2=$name[1];
        // dd($name2);
        return view('cai_cai',['name1'=>$name1,'name2'=>$name2]);
    }

    public function docai(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $arr=['name1'=>$data['name1'],'name2'=>$data['name2'],'yin'=>$data['array'][0]];
        // dd($arr);
        $res=DB::table('exam')->insert($arr);
        // dd($res);
        if($res){
            echo json_encode(['code'=>1,'msg'=>'竞猜成功']);
        }else{
            echo json_encode(['code'=>0,'msg'=>'添加失败']);
        }
        
    }

    public function exam(Request $request)
    {
        $data=$request->all()['array'];
        // dd($data);
        $arr=explode(",",$data);
        // dd($arr);
        $name1=$arr[0];
        $name2=$arr[1];
        // dd($name2);
        
        // $yin=DB::table()->;
        
        return view('cai_exam',['name1'=>$name1,'name2'=>$name2]);
        
    }

    public function list(Request $request)
    {
        $data=$request->all()['array'];
        // dd($data);
        $arr=explode(",",$data);
        // dd($arr);
        $name1=$arr[0];
        $name2=$arr[1];
        // dd($name2);
        $where=[
            ['name1','=',$name1],
            ['name2','=',$name2],
        ];
        // dd($where);
        $count=DB::table('exam')->where($where)->count();
        // dd($count);
        // echo time();die;
        if($count<=0){
            echo "您还没竞猜过该项目";die;
        }else{
            $yin=DB::table('exam')->select('yin')->first();
            // dd($yin);
            $yin=get_object_vars($yin);
            $yin=$yin['yin'];
            // dd($yin);
            $is_yin=DB::table('exam')->select('is_yin')->first();
            // dd($is_yin);
            $is_yin=get_object_vars($is_yin);
            $is_yin=$is_yin['is_yin'];
            // dd($is_yin);
            if($yin==$is_yin){
                // echo 111;
                $a="{$name2}碾压式胜利";
                $b="很遗憾您竞猜失败";
            }else{
                $a="{$name1}胜出";
                // echo 2222;
                $b="恭喜您竞猜成功";
            }

            return view('cai_list',['name1'=>$name1,'name2'=>$name2,'a'=>$a,'b'=>$b]);
        }
        
    }
}
