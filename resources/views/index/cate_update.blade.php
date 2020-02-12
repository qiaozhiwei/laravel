@extends('layout.userparent')
@section('right')
<form action="{{url('index/doupdate_cate')}}" method="post">
<input type="hidden" name="id" value="{{$id}}">
    <table>
        <tr>
            <td>分类名称:</td>
            <td>
                <input type="text" name="c_name" value="{{$c_name}}">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="修改">
            </td>
        </tr>
    </table>
</form>
@endsection