<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\user;
use App\Http\Model\Goods;
use App\Http\Controllers\wechat;
use App\Http\Model\member as members;
use DB;


class ziyuan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $name=$request->all()['name']??"";
        $tel=$request->all()['tel']??"";
        // print_r($name);
        // print_r($tel);die;
        $where=[];
        if($name!=""){
            $where[]=['name','like',"%$name%"];
        }
        if($tel!=""){
            $where[]=['tel','like',"%$tel%"];
        }
        // dd($where);
        $members=new members;
        $data=$members->where($where)->paginate(3)->toarray();
        // dd($data);
        if($data!=[]){
            return json_encode(['code'=>200,'data'=>$data],JSON_UNESCAPED_UNICODE);
            // return $data;
        }else{
            echo json_encode(['code'=>110,'msg'=>'查询失败'],JSON_UNESCAPED_UNICODE);die;
            // return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $members=new members;
        // dd($members);
        $name=$request->all()['name'];
        // // dd($name);
        $tel=$request->all()['tel'];
        // dd($tel);
        $data=['name'=>$name,'tel'=>$tel];
        // dd($data);
        $res=$members->insert($data);
        if($res){
            //插入成功
            return json_encode(['errcode'=>200,'msg'=>'添加成功'],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['errcode'=>110,'msg'=>'程序错误'],JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $members=new members;
        $data=$request->all();
        // dd($data);
        $where=[
            ['id','=',$id],
        ];
        // dd($where);
        $arr=['name'=>$data['name'],'tel'=>$data['tel']];
        // $arr=['name'=>'xxoo','tel'=>20000];
        $res=$members->where($where)->update($arr);
        // dd($res);
        if($res){
            return json_encode(['code'=>200,'msg'=>'ok']);
        }else{
            return json_encode(['code'=>110,'msg'=>'false']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $members=new members;
        // $id=$request->all()['id'];
        // $id=8;
        // dd($id);
        if($id==""){
            return json_encode(['cdoe'=>110,'msg'=>'程序错误']);
        }
        $where=[
            ['id','=',$id],
        ];
        // dd($where);
        $res=$members->where($where)->delete();
        // dd($res);
        if($res){
            return json_encode(['code'=>200,'msg'=>'ok']);
        }else{
            return json_encode(['code'=>110,'msg'=>'false']);
        }
    }
}
