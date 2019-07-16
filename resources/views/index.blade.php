@extends('layout.goodsparent')
@section('body')
<form action="{{url('Goods/index')}}" method="get">
<div class="layui-form-item">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-inline">
      <input type="text" value="{{$sr}}" name="sr" placeholder="请按商品名称搜索" autocomplete="off" class="layui-input">
	<input type="submit" value="搜索" class="layui-btn layui-btn-radius layui-btn-normal">
	</div>
  </div>
</form>
<h3 align="center">
您访问了{{$num}}次
</h3>
<table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>商品名称</th>
      <th>图片</th>
      <th>价格</th>
      <th>库存</th>
      <th>添加时间</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  @foreach($data as $item)
    <tr>
      <td>{{$item->goods_name}}</td>
      <td>
	  	<img src="{{$item->goods_pic}}" width="100px;" height="100px;">
	  </td>
      <td>{{$item->goods_price}}</td>
      <td>{{$item->number}}</td>
      <td>
	  	{{date("Y-m-d H:i:s",$item->add_time)}}
	  </td>
      <td>
	  	<a href="{{url('Goods/del')}}?id={{$item->id}}">删除</a>|
		  <a href="{{url('Goods/update')}}?id={{$item->id}}">修改</a>|
		  <a href="{{url('Goods/add')}}">添加</a>
	  </td>
    </tr>
	@endforeach
	
  </tbody>
</table>
<h3 align="center">
{{ $data->appends(['sr' => "$sr"])->links() }}
</h3>
@endsection
