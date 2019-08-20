<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border=1 align="center">
    <caption>
        <h1>
            <a href="{{url('text/send')}}">我的留言</a>
        </h1>
    </caption>
        <tr>
            <td>用户</td>
            <td>操作</td>
        </tr>
        @foreach($nickname as $v)
        <tr>
            <td>{{$v['nickname']}}</td>
            <td>
                <a href="{{url('text/liuyans')}}?openid={{$v['openid']}}&uid={{$uid}}&&nickname={{$v['nickname']}}">留言</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>