<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class in extends Controller
{
    public function index()
    {
        $data=DB::table('proiect')->paginate(5);
        return view('in_index',['data'=>$data]);
    }


    public function add()
    {
        return view('in_add');
    }

    public function a(Request $request)
    {
        $type=$request->all()['type'];
        // dd($type);
        return view('in_a',['type'=>$type]);
    }
    public function b(Request $request)
    {
        $type=$request->all()['type'];
        // dd($type);
        return view('in_b',['type'=>$type]);
    }

    public function doadd(Request $request)
    {
        $data=$request->all();
        // dd($data);
        if($data['type']=="多选"){
            // dd($data);
            $answer=implode(',',$data['answer']);
            // dd($answer);
            $arr=['question'=>$data['question'],'answer'=>$answer,'type'=>$data['type']];
            // dd($arr);
            $res=DB::table('question')->insert($arr);
            // dd($res);
            if($res){
                return redirect('in/index');
            }else{
                return redirect('in/in_b');
            }
        }else{
            $arr=['question'=>$data['question'],'answer'=>$data['answer'],'type'=>$data['type']];
            // dd($arr);
            $res=DB::table('question')->insert($arr);
            if($res){
                return redirect('in/index');
            }else{
                return redirect('in/in_a');
            }
        }
       
    }

    public function create()
    {
        $data=DB::table('question')->get();
        return view('in_create',['data'=>$data]);
    }

    public function docreate(Request $request)
    {
        $data=$request->all();
        // dd($data);
        // dd($data['array']);
        $q_id=implode(',',$data['array']);
        // dd($q_id);
        $arr=['name'=>$data['name'],'add_time'=>time(),'q_id'=>$q_id];
        // dd($arr);
        $res=DB::table('proiect')->insert($arr);
        // dd($res);
        if($res){
            echo json_encode(['code'=>1,'msg'=>'添加成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'添加失败']);            
        }
    }



    public function delete(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $res=DB::table('proiect')->delete($id);
        // dd($res);
        if($res){
            return redirect('in/index');
        }else{
            echo "false";
        }
    }

    public function links(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $route=\Request::getRequestUri();
        // dd($url);
        $url="www.laravel.com"."/in/link?id=$id";
        // dd($url);
        echo $url;
        
    }

    public function link(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['id','=',$id],
        ];
        $data=DB::table('proiect')->where($where)->first();
        // dd($data);
        $data=get_object_vars($data);
        $q_id=$data['q_id'];
        // dd($q_id);
        $wheres=[
            ['q_id','=',$q_id],
        ];
        // dd($wheres);
        $arr=DB::table('question')->where($wheres)->first();
        // dd($arr);
        $arr=get_object_vars($arr);
        // dd($arr);
        return view('in_link',['data'=>$data,'arr'=>$arr]);
    }

}
