<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class bank extends Controller
{
    public function index(Request $request)
    {
        $nums="";
        $start=$request->all('start')['start']??"";
        // var_dump($start);
        $end=$request->all('end')['end']??"";
        // var_dump($end);
        $redis=new \Redis();
            // dd($redis);
        $redis->connect('127.0.0.1','6379');
        if($start=="" && $end==""){
            
        }else{
            
            $num=$redis->incr('num');
            // echo "您搜索了".$num."次";
            $nums=$num;
        }
        $where=[];
        if(empty($start)){
            $where=[
                ['end','like',"%{$end}%"],
            ];
        }
        if(empty($end)){
            $where=[
                ['start','like',"%{$start}%"],
            ];
        }
        // dd($where);
        if($start && $end){
            // echo 111; 
            $where=[
                ['end','like',"%{$end}%"],
                ['start','like',"%{$start}%"],
            ];
            // dd($where);
        }
        $data=DB::table('bank')->where($where)->paginate(3);
        // var_dump($nums);
        // dd($data);
        if(!$nums==""){
            if($nums>5){
                $info=json_encode($data);
                // dd($info);
                $redis->set('info',$info,3*60);
            }
        }
        // $arr=$redis->get('info');
        // $data=json_decode($redis->get('info'),true);
        // dd($arr);
        // dd($data);
        
        return view('bank_index',['data'=>$data,'start'=>$start,'end'=>$end,'num'=>$nums]);
    }


    public function add()
    {
        return view('bank_add');
    }
    public function doadd(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $start_time=time()+90000;
        // dd(date('Y-m-d H:i:s',$strat_time));
        $end_time=time()+150000;
        $arr=['train'=>$data['train'],'start'=>$data['start'],'end'=>$data['end'],'price'=>$data['price'],'number'=>$data['number'],'start_time'=>$start_time,'end_time'=>$end_time];
        // dd($arr);
        $res=DB::table('bank')->insert($arr);
        // dd($res);
        if($res){
            return redirect('bank/index');
        }else{
            return redirect('bank/add');
        }
        
        
    }

    public function yuyue()
    {

    }
}
