<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@extends('layout.goodsparent')
@section('body')
<form class="layui-form" action="{{url('Goods/doupdate')}}" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="{{$data->id}}">
@csrf
  <div class="layui-form-item">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_name" required  lay-verify="required" placeholder="请输入商品名称" autocomplete="off" class="layui-input" value="{{$data->goods_name}}">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">商品图片</label>
    <div class="layui-input-inline">
      <input type="file" name="goods_pic"  autocomplete="off" class="layui-input">
      <img src="{{$data->goods_pic}}" alt="" width="100px;" hieght="100px;">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">价格</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_price" required  lay-verify="required" placeholder="请输入商品价格" autocomplete="off" class="layui-input" value="{{$data->goods_price}}">
    </div>
  </div>


  <div class="layui-form-item">
    <div class="layui-input-block">
      <input type="submit" class="layui-btn" value="立即修改">
      <input type="reset" class="layui-btn layui-btn-primary" value="重置">
    </div>
  </div>
</form>
@endsection
@section('js')
<script>
//Demo
layui.use('form', function(){
  var form = layui.form;
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});
</script>
@endsection
</body>
</html>