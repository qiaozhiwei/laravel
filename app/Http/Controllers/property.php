<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class property extends Controller
{
    public function create()
    {
        return view('property_create');
    }
    
    public function docreate(Request $request)
    {
        $parking_num=$request->all()['parking_num'];
        // dd($parking_num);
        $num=DB::table('parking')->select('parking_num')->first();
        $num=get_object_vars($num);
        $num=$num['parking_num'];
        // dd($num);
        $new_num=$num+$parking_num;
        $arr=['parking_num'=>$new_num];
        // dd($arr);
        $res=DB::table('parking')->update($arr);
        // dd($res);
        if($res){
            return redirect('property/index');
        }else{
            echo "false";
        }
    }
    
    public function add()
    {
        return view('property_add');
    }

    public function doadd(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $where=[
            ['name','=',$data['name']],
        ];
        // dd($where);
        $count=DB::table('guard')->where($where)->count();
        // dd($count);
        if($count>0){
            echo "该用户名已存在";die;
        }
        $arr=['name'=>$data['name'],'pwd'=>$data['pwd'],'add_time'=>time()];
        // dd($arr);
        $res=DB::table('guard')->insert($arr);
        // dd($res);
        if($res){
            return redirect('property/index');
        }else{
            echo "false";
        }
    }

    public function index()
    {
        $data=DB::table('guard')->get();
        return view('property_index',['data'=>$data]);
    }


    public function car(Request $request)
    {
        $name=$request->all()['name'];
        // dd($name);
        $where=[
            ['name','=',$name],
        ];
        $count=DB::table('guard')->where($where)->count();
        // dd($count);
        if($count<=0){
            echo "您不是我公司的员工,无权操作";die;
        }
        $parking_num=DB::table('parking')->select('parking_num')->first();
        $parking_num=get_object_vars($parking_num);
        $parking_num=$parking_num['parking_num'];
        // dd($parking_num);
        return view('property_car',['parking_num'=>$parking_num]);
    }

    public function addcar()
    {
        return view('property_addcar');
    }

    public function doaddcar(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $arr=['car_name'=>$data['car_name'],'car_number'=>$data['car_number'],'add_time'=>time(),'state'=>1];
        // dd($arr);
        $res=DB::table('car_info')->insert($arr);
        // dd($res);
        if($res){
            $parking_num=DB::table('parking')->select('parking_num')->first();
            $parking_num=get_object_vars($parking_num);
            $parking_num=$parking_num['parking_num'];
            // dd($parking_num);
            $update=['parking_num'=>$parking_num-1];
            // dd($update);
            DB::table('parking')->update($update);
            $start=strtotime("0:00");
            // dd($start);
            $end=strtotime("24:00");
            // dd($end);
            $where=[
                ['add_time','>=',$start],
                ['delete_time','<=',$end],
            ];
            // dd($where);
            // echo (time()-86400);die;
            $count=DB::table('car_info')->count();
            // dd($count);
            // dd($today_total);
            $redis=new \Redis();
            // dd($redis);
            $redis->connect('127.0.0.1','6379');
            $redis->set('count',$count);
        //---------------------------------
            return redirect('property/car_index');
        }else{
            echo "false";
        }
    }

    public function car_index()
    {
        $where=[
            ['state','=',1],
        ];
        $data=DB::table('car_info')->where($where)->get();
        return view('car_list',['data'=>$data]);
    }

    public function unsetcar(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        //将车位查出来
        $parking_num=DB::table('parking')->select('parking_num')->first();
        $parking_num=get_object_vars($parking_num);
        $parking_num=$parking_num['parking_num'];
        // dd($parking_num);
        //-------------------------
        $where=[
            ['id','=',$id],
        ];
        //计费算法
        $data=['delete_time'=>time()];
        // dd($data);
        //修改出库时间,以便后续操作
        DB::table('car_info')->where($where)->update($data);
        //获得该车辆出库时间
        $delete_time=DB::table('car_info')->where($where)->select('delete_time')->first();
        $delete_time=get_object_vars($delete_time);
        $delete_time=$delete_time['delete_time'];
        // dd($delete_time);
        //获得该车辆入库时间
        $add_time=DB::table('car_info')->where($where)->select('add_time')->first();
        $add_time=get_object_vars($add_time);
        $add_time=$add_time['add_time'];
        // dd($add_time);
        //相减
        // echo date('H:i:s',$add_time);
        // echo "<hr />";
        // echo date('H:i:s',$delete_time);die;

        $time=$delete_time-$add_time;
        // dd($time);
        //除60取整
        $time=ceil($time/60);
        //转为整型(分钟)
        $time=intval($time);
        // dd($time);
        // echo (time()+21600);die;
        // echo (date('Y-m-d H:i:s',1564048975));die;

        $price="";
        //做判断
        if($time<=15){
            $arr=['state'=>2,'total'=>0];
            $total=0;
            $price=$total;
            DB::table('car_info')->where($where)->update($arr);
            //腾出车位
            $update=['parking_num'=>$parking_num+1];
            DB::table('parking')->update($update);
        }else if($time>15 && $time<=360){
            $total=ceil($time/30);
            $total=intval($total)*2;
            $price=$total;
            // dd($total);
            $arr=['state'=>2,'total'=>$total];
            DB::table('car_info')->where($where)->update($arr);
            //腾出车位
            $update=['parking_num'=>$parking_num+1];
            DB::table('parking')->update($update);
        }else{
            $total=ceil($time/60)*1;
            $total=intval($total);
            $price=$total;
            // dd($total);
            $arr=['state'=>2,'total'=>$total];
            DB::table('car_info')->where($where)->update($arr);
            //腾出车位
            $update=['parking_num'=>$parking_num+1];
            DB::table('parking')->update($update);
        }
        // dd($price);
        $car_number=DB::table('car_info')->select('car_number')->where($where)->first();
        $car_number=get_object_vars($car_number);
        $car_number=$car_number['car_number'];
        // dd($car_number);
        //redis存值
        // echo date('Y-m-d H:i:s',1564070400);die;
        $start=strtotime("0:00");
        // dd($start);
        $end=strtotime("24:00");
        // dd($end);
        $where=[
            ['add_time','>=',$start],
            ['delete_time','<=',$end],
        ];
        // dd($where);
        // echo (time()-86400);die;
        $today_total=DB::table('car_info')->where($where)->select('total')->get()->toarray();
        // dd($today_total);
        $today_total=array_column($today_total,'total');
        $today_total=array_sum($today_total);
        // dd($today_total);
        $redis=new \Redis();
        // dd($redis);
        $redis->connect('127.0.0.1','6379');
        $redis->set('today_total',$today_total);
        //------------------------------------------------------------------------------
        return view('property_unsetcar',['time'=>$time,'car_number'=>$car_number,'price'=>$price]);
    }

    
    public function list()
    {
        //取redis值
        $redis= new \Redis();
        // dd($redis);
        $redis->connect('127.0.0.1','6379');
        $count=$redis->get('count');
        // dd($count);
        $today_total=$redis->get('today_total');
        // dd($today_total);
        return view('property_list',['count'=>$count,'today_total'=>$today_total]);
    }

    public function login()
    {
        return view('property_login');
    }

    public function dologin(Request $request)
    {
        $data=$request->all();
        // dd($data);
        
        $where=[
            ['name','=',$data['name']],
            ['pwd','=',$data['pwd']],
        ];
        // dd($where);
        $count=DB::table('guard')->where($where)->count();
        // dd($count);
        if($count>0){
            return redirect('property/index');
        }else{
            echo "账号或密码错误";
        }
    }
}
