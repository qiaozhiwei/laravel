@extends('layout.userparent')
@section('right')
<table border=1>
    <tr>
        <td>ID</td>
        <td>分类名称</td>
        <td>备注</td>
    </tr>
    @foreach($data as $item)
    <tr>
        <td>{{$item->c_id}}</td>
        <td>{{$item->c_name}}</td>
        <td>
        <a href="{{url('index/cate_delete')}}?id={{$item->c_id}}">删除</a>
        <a href="{{url('index/cate_update')}}?id={{$item->c_id}}">修改</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection