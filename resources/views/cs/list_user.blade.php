<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center" border=1>
        <tr>
            <td>用户名</td>
            <td>密码</td>
            <td>注册时间</td>
            <td>折扣线路</td>
        </tr>
        @foreach($arr as $k=>$v)
        <tr>
            <td>{{$v['username']}}</td>
            <td>{{$v['password']}}</td>
            <td>{{$v['time']}}</td>
            <td>
                <a href="{{url('dis/create_line')}}?uid={{$v['id']}}">{{$v['dis']}}</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>