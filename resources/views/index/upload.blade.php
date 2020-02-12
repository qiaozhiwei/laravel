@extends('layout.userparent')
@section('right')
<form action="{{url('index/doupload')}}" method="post" enctype="multipart/form-data">
    <table>
    <tr>
        <td>分类:</td>
        <td>
            <select name="c_id">
            @foreach($data as $k=>$v)
                <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
            @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>
            歌名:
        </td>
        <td>
            <input type="text" name="name">
        </td>
    </tr>
    <tr>
            <td>作者</td>
            <td>
                <input type="text" name="person">
            </td>
        </tr>
        <tr>
            <td>选择文件</td>
            <td><input type="file" name="media"></td>
        </tr>
        <tr>
            <td>专辑封面</td>
            <td>
                <input type="file" name="img">
            </td>
        </tr>

        <tr>
            <td>
                <input type="submit" value="上传">
            </td>
        </tr>

       
    </table>
</form>
@endsection