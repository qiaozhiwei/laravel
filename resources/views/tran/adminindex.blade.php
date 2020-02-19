<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table align="center" border=1>
    <center>
        <a href="{{url('tran/addUser')}}">添加用户</a>
    </center>
        <tr>
            <td>用户名</td>
            <td>添加时间</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->username}}</td>
            <td>{{date("Y-m-d H:i:s",$v->time)}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>