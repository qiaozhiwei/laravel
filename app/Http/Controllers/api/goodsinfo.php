<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\aes;
use App\Http\Controllers\api\rsa;
use App\Http\Model\goodsinfo as goodsinfos;


class goodsinfo extends Controller
{
    public function index()
    {
        // echo phpinfo();die;
        return view('goodsinfo_index');
    }

    public function getinfo(Request $request)
    {
        $page=$request->all()['page']??"";
        $good_name=$request->all()['good_name']??"";
        $str="<b style='color:red'>".$good_name."</b>";
        // echo $str;die;
        $goodsinfo=new goodsinfos;
        $where=[];
        if($good_name!=""){
            $where=[
                ['good_name','like',"%$good_name%"],
            ]; 
        }
        //缓存优化
        $redis=new \Redis();
        // dd($redis);
        $redis->connect('127.0.0.1','6379');
        $a=$page.$good_name.'13'; 
        // dd($a);
        $res=$redis->get($a);
        // dd($res);
        $data=[];
        // dd($data);
        $b="";
        if($res==false){
            // echo 111;die;
            $data=$goodsinfo->where($where)->paginate(3)->toarray();
            // dd($data);
            $arr=$data['data'];
            foreach($arr as $k=>$v){
                // echo "<pre>";
                $b=str_replace($good_name,$str,$v['good_name']);
                // $v['good_name']=$b;
                $data['data'][$k]['good_name']=$b;
                // print_r($b); 
            }
            $redis->set($a,json_encode($data,JSON_UNESCAPED_UNICODE));
        }else{
            // echo 2222;die;
            $data=$redis->get($a);
            $data=json_decode($data,1);
            // dd($data);
            $arr=$data['data'];
            foreach($arr as $k=>$v){
                // echo "<pre>";
                $b=str_replace($good_name,$str,$v['good_name']);
                // $v['good_name']=$b;
                $data['data'][$k]['good_name']=$b;
                // print_r($b); 
            }
            // die;
            // print_r($data);die;
        }
        return json_encode(['code'=>200,'data'=>$data]);
    }

    public function create()
    {
        return view('goodsinfo_create');
    }


    public function docreate(Request $request)
    {
        $goodsinfo=new goodsinfos;
        $data=$request->all();
        // dd($data);
        $file=$data['good_pic'];
        // dd($file);
        $path="";
        if($file!=""){
            $path =$file->store('/upload/img');
            // dd($path);
            $path='/storage/'.$path;
            // dd($path);
        }
        // dd($path);
        $arr=$data['arr'];
        $arr=explode(',',$data['arr']);
        // dd($arr);
        $good_name=$arr[0];
        $good_price=$arr[1];
        // var_dump($good_name,$good_price);
        $array=['good_name'=>$good_name,'good_price'=>$good_price,'good_pic'=>$path];
        // dd($array);
        $res=$goodsinfo->insert($array);
        // dd($res);
        if($res){
            return json_encode(['msg'=>'添加成功','code'=>200]);
        }else{
            return json_encode(['msg'=>'添加失败','code'=>101]);
        }
   
    }


    //凯撒加密

    

    public function encryption()
    {
        echo "<pre>";
        $str="kjh";
        $data=range('a','z');
        $arr=range('a','z');
        $newData=array_merge($data,$data);
        dd($newData);
        // dd($data);
        // print_r($data);
        $len=strlen($str);
        // dd($len);
        $a="";
        $b="";
        for($i=0;$i<$len;$i++){
            echo "<pre>";
            // echo $i;
            $a=$str[$i];
            // echo $a;
            $k=array_search($a,$data);
            // echo $k;
            $b.=$data[$k+4];
            // echo $b;
        }
        return $b;
        
    }


    //解密
    
    public function Decrypt()
    {
        $data=range('a','z');
        $str=$this->encryption();
        // dd($str);
        $len=strlen($str);
        $b="";
        for($i=0;$i<$len;$i++){
            echo "<pre>";
            // echo $i;
            $a=$str[$i];
            // echo $a;
            $k=array_search($a,$data);
            // echo $k;
            $b.=$data[$k-4];
            // echo $b;
        }
        return $b;
    }
    //对称加解
    public function code()
    {
        $key="fdjfdsfjakfjadii";
        $aes=new aes($key);
        // $data=['name'=>'乔志伟','age'=>100,'mobile'=>11111111];
        $data="name=乔志伟&age=11&mobile=1111";
        // dd($data);
        // $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($data);
        return $aes->encrypt($data);
    }

    //对称解密

    public function deCode()
    {
        $key="1234567890123456";
        $aes=new aes($key);
        $data=$this->code();
        // dd($data);
        $data=$aes->decrypt($data);
        $data=json_decode($data,true);
        return $data;
        // return openssl_decrypt(base64_decode($string), 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
    }

    


    //对称加解密
    public function aes(aes $aes)
    {
        //最好实例化使用类
        $encrypt=$aes->decrypt('c2ec46c3b8194d49e837929257689b73');
        dd($encrypt);
    }
    //非对称加解密

    public function rsa()
    {
        // //私钥
$privkey = "-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCxb1xeaxjto2a6MaHtkFM6G7vq7ARhw9G7cwSLpPeOVITqOq1h
m3/exOeYKNjyZVaPuxUQoUD+H4P5bCCXcV7rSmNMXEA8+pbRiwmePXoGBvAYps8n
WLuxNxMkDBaYkA7NCFZ66VTvD7qBXVa5ihJNOkNsSa6eOuRIz/h6LeqLiQIDAQAB
AoGAOEi//z9vz+oWaxfVattuWy9zA8lMdoq8W/7XQUjaMm8DHp3wY9cEz/CcGntS
nkmhFMTeoMDWMgZjQdqX2BJhbjCOd8p3OZH61lPZjeeEvfTjh/4BeShZ3ymvgmf6
Byd5uoczCu17BqUBJCG0niVnrS1tPqGsUjN8mIlE+5/fuqUCQQDa33k3+LifQCGJ
V84ny748ItY9FNthoGQ77hbEg0Ivfwe3WSdMkAFwanWWq4ZM32fitmZKbPOZb54l
UHRbQzgPAkEAz4hzXNabjeIniDqNg2FMaiEYkzVjNE7RJ6PWebOJlfUatDXcDB1n
e7ouMjY3j6HdQzosOK2gb9gj+btVLWeq5wJATj39E2kydptyYaql48wN4WmCtKs0
EZ5ItrPSJ8XUby42D/Eq/0+rdAhaqNYAWJK0jHMv9gMkwgEIw8YTElzhOQJAQUY0
qr2hXYYFUxa/jdQbmcHhHeQL2Nb1eBdTDSJIIw9dn9LU7EaPVt4fS5G79gQ+OLfi
Us1hiewcnJ6sUsSpfwJBAJzEOS/QIfdVWTfO8I13cix1Etb3KDLQhdrZMsvK3DV2
t9YPk4vPe1SOMBrPaqhIyLUh/XcCWQ8P5YAxTgiJn10=
-----END RSA PRIVATE KEY-----";//$keys['privkey'];
//公钥
$pubkey  = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCxb1xeaxjto2a6MaHtkFM6G7vq
7ARhw9G7cwSLpPeOVITqOq1hm3/exOeYKNjyZVaPuxUQoUD+H4P5bCCXcV7rSmNM
XEA8+pbRiwmePXoGBvAYps8nWLuxNxMkDBaYkA7NCFZ66VTvD7qBXVa5ihJNOkNs
Sa6eOuRIz/h6LeqLiQIDAQAB
-----END PUBLIC KEY-----";
        $rsa=new rsa;
        // dd($rsa);
        $rsa->init($privkey,$pubkey,TRUE);
        $data=['name'=>1111,'sex'=>22222,'age'=>333333];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $re=$rsa->pub_encode($data);
        // dd($re);
        return $re;
    }
    

   public function rsa_code()
   {
               // //私钥
$privkey = "-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCxb1xeaxjto2a6MaHtkFM6G7vq7ARhw9G7cwSLpPeOVITqOq1h
m3/exOeYKNjyZVaPuxUQoUD+H4P5bCCXcV7rSmNMXEA8+pbRiwmePXoGBvAYps8n
WLuxNxMkDBaYkA7NCFZ66VTvD7qBXVa5ihJNOkNsSa6eOuRIz/h6LeqLiQIDAQAB
AoGAOEi//z9vz+oWaxfVattuWy9zA8lMdoq8W/7XQUjaMm8DHp3wY9cEz/CcGntS
nkmhFMTeoMDWMgZjQdqX2BJhbjCOd8p3OZH61lPZjeeEvfTjh/4BeShZ3ymvgmf6
Byd5uoczCu17BqUBJCG0niVnrS1tPqGsUjN8mIlE+5/fuqUCQQDa33k3+LifQCGJ
V84ny748ItY9FNthoGQ77hbEg0Ivfwe3WSdMkAFwanWWq4ZM32fitmZKbPOZb54l
UHRbQzgPAkEAz4hzXNabjeIniDqNg2FMaiEYkzVjNE7RJ6PWebOJlfUatDXcDB1n
e7ouMjY3j6HdQzosOK2gb9gj+btVLWeq5wJATj39E2kydptyYaql48wN4WmCtKs0
EZ5ItrPSJ8XUby42D/Eq/0+rdAhaqNYAWJK0jHMv9gMkwgEIw8YTElzhOQJAQUY0
qr2hXYYFUxa/jdQbmcHhHeQL2Nb1eBdTDSJIIw9dn9LU7EaPVt4fS5G79gQ+OLfi
Us1hiewcnJ6sUsSpfwJBAJzEOS/QIfdVWTfO8I13cix1Etb3KDLQhdrZMsvK3DV2
t9YPk4vPe1SOMBrPaqhIyLUh/XcCWQ8P5YAxTgiJn10=
-----END RSA PRIVATE KEY-----";//$keys['privkey'];
//公钥
$pubkey  = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCxb1xeaxjto2a6MaHtkFM6G7vq
7ARhw9G7cwSLpPeOVITqOq1hm3/exOeYKNjyZVaPuxUQoUD+H4P5bCCXcV7rSmNM
XEA8+pbRiwmePXoGBvAYps8nWLuxNxMkDBaYkA7NCFZ66VTvD7qBXVa5ihJNOkNs
Sa6eOuRIz/h6LeqLiQIDAQAB
-----END PUBLIC KEY-----";

        $rsa=new rsa;
        $rsa->init($privkey,$pubkey,TRUE);
        $data=$this->rsa();
        // dd($data);
        $re=$rsa->priv_decode($data);
        $re=json_decode($re,1);
        dd($re);
        
   }

   public function xxoo(Request $request)
   {
        $key="1234567890123456";
        $aes=new aes($key);
    // xxoo=3a0720e5fe91cb627841e226b3e4b4309750af2444a8b224c680dc385802aa8f454de10749974788da314f068aff52ca050187a0cde5a9872cbab091ab73e553&key=757ccd0cdc5c90eadbeeecf638dd0000050187a0cde5a9872cbab091ab73e553
       $data=$request->all()['xxoo']??[];
       $aes_key=$request->all()['key']??[];
    //    dd($aes_key);
       if($data==[]){
            return json_encode(['msg'=>'数据为空,靓仔'],JSON_UNESCAPED_UNICODE);
       }
       if($aes_key==[]){
            return json_encode(['msg'=>'密钥不能为空,小伙'],JSON_UNESCAPED_UNICODE);
       }
       if($aes_key!=[]){
            $a=$aes->decrypt($aes_key);
            // dd($a);
            if($a!="1234567890123456"){
                return json_encode(['msg'=>'密钥不对,小伙'],JSON_UNESCAPED_UNICODE);                
            }
       }
        // dd($data);
        
        $data=$aes->decrypt($data);
        // dd($data);
        $data=json_decode($data,1);
        return $data;
        
        
   }

       

}
