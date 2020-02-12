@extends('layout.userparent')
@section('right')
<form action="https://api.weixin.qq.com/cgi-bin/material/add_material" method="post" enctype="multipart/form-data">
<input type="hidden" name="access_token" value="{{$access_token}}">
    <table>
    <tr>
        <td>
            资源类型:
        </td>
        <td>
            <input type="text" name="type">
        </td>
    </tr>
        <tr>
            <td>选择文件</td>
            <td><input type="file" name="media"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="上传">
            </td>
        </tr>
    </table>
</form>
@endsection