<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GoodsController extends Controller
{
    public function index()
    {
        $data=DB::table('goods')->get()->toArray();
        // dd($data);
        return view('index',['data'=>$data]);
    }

    public function add()
    {
        return view('add');
    }
}
