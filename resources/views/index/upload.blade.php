@extends('layout.userparent')
@section('right')
<form action="{{url('index/doupload')}}" method="post" enctype="multipart/form-data">
    <table>
    <tr>
        <td>
            歌名:
        </td>
        <td>
            <input type="text" name="name">
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