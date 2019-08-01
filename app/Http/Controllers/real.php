<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class real extends Controller
{
    public function index()
    {
        return view('real_index');
    }

    public function address(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $post=file_get_contents("http://api.map.baidu.com/geocoder/v2/?address={$data['name']}&output=json&ak=CxF13N48UHZ12G8sIVpa2YTG");
        $post=json_decode($post,1);
        // dd($post);
        $lng=$post['result']['location']['lng'];
        // dd($lng);
        $lat=$post['result']['location']['lat'];
        // dd($lat);
        $address=$post['result']['level'];
        // dd($address);
        return view('real_address',['address'=>$address,'lat'=>$lat,'lng'=>$lng]);
    }

    public function url()
    {
        $url="a".","."b".","."c".","."d";
        // dd($url);
        $arr=explode(',',$url);
        // dd($arr);
        $arr=array_reverse($arr);
        dd($arr);
    }
    
}
