<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Goods;
use DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $redis=new \Redis();
        // dd($redis);
        $redis->connect('127.0.0.1','6379');
        $num=$redis->incr('num');
        echo "访问次数为".$num;
        // dd($num);
        $search=$request->all()['search']??'';
        // dd($search);
        $where=[
            ['name','like',"%{$search}%"],
        ];
        // dd($where);
        $info=Goods::where($where)->paginate(3);
        // $info['num']=$num;
        // dd($info);
        return view('StudentList',['student'=>$info],['search'=>$search]);
        // echo 111111;
    }
    public function add()
    {
        return view('Studentadd');
    }

    public function doadd(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'sex' => 'required',
        ],
        [
            'name.required'=>'名字必填',
            'age.required'=>'年龄必填',
            'sex.required'=>'性别必填'
        
        ]
    );
        $data=$request->all();
        // dd($data);die;
        $arr=['name'=>$data['name'],'age'=>$data['age'],'sex'=>$data['sex'],'create_time'=>time()];
        // dd($arr);die;
        $res=DB::table('student')->insert($arr);
        // dump($res);
        if($res){
            return redirect('StudentController/index');
        }else{
            echo "false";
        }
        
    }

    
    public function delete(Request $request)
    {
        $id= $request->all()['id'];
        // dd($id);
        $res=DB::table('student')->delete($id);
        // dd($res);
        if($res){
            return redirect('StudentController/index');
        }else{
            echo "false";
        }
    }
    
    public function update(Request $request)
    {
        $id=$request->all()['id'];
        $data=DB::table('student')->where(['id'=>$id])->first();
        // dd($data);
        return view('Studentupdate',['data'=>$data]);
    }

    public function doupdate(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $res=DB::table('student')->where(['id'=>$data['id']])->update($data);
        // dd($res);
        if($res){
            return redirect('StudentController/index');
        }else{
            echo "false";
        }
    }

    public function aa()
    {
        echo phpinfo();
    }


    public function login()
    {
        
        return view('Studentlogin');
    }

    public function dologin(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $user_name=$data['user_name'];
        // dd($user_name);
        $request->session()->put('user_name',"$user_name");
        // dd($request->session());
        $u_name=session('user_name');
        // dd($u_name);
        $where=[
            ['user_name','=',$user_name],
        ];
        $arr=DB::table('register')->select('user_name')->where($where)->get()->toArray();
        $u_name1=array_column($arr,'user_name');
        // dd($u_name1[0]);
        if($u_name==$u_name1[0]){
            return redirect('StudentController/index');
        }else{
            return redirect('StudentController/login');
        }
       
        
        
    }

    public function del(Request $request)
    {
        $request->session()->forget('user_name');
    }

    public function register()
    {
        return view('Studentregister');
    }

    public function doregister(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $arr=['user_name'=>$data['user_name'],'user_pwd'=>$data['user_pwd'],'time'=>time()];
        // dd($arr);
        $where=[
            ['user_name','=',$arr['user_name']],
        ];
        $count=DB::table('register')->where($where)->count();
        // dd($count);
        if($count>0){
            echo "用户名已注册";die;
        }
        $res=DB::table('register')->insert($arr);
        // dd($res);
        if($res){
            return redirect('StudentController/login');
        }else{
            echo "false";
        }
    }

    public function upload()
    {
        return view('Studentupload');
    }

    public function doupload(Request $request)
    {
        // dd(storage_path('app\public'));
        // dd($_FILES);
        $path=$request->file('pic')->store('good_img');
        // dd($path);
        $path=asset("storage/".$path);
        // dd($path);
        
    }
}
