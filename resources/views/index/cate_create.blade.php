@extends('layout.userparent')
@section('right')
<form action="{{url('index/docreate_cate')}}" method="post">
    <table>
        <tr>
            <td>分类名称:</td>
            <td>
                <input type="text" name="c_name">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="添加">
            </td>
        </tr>
    </table>
</form>
@endsection