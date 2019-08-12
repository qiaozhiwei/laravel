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
            粉丝列表
        </h1>
    </caption>
        <tr>
            <td>ID</td>
            <td>OPENID</td>
            <td>添加时间</td>
            <td>是否关注</td>
            <td>备注</td>
            <td>备注</td>

        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->openid}}</td>
            <td>{{date("Y-m-d H:i:s",$item->add_time)}}</td>
            <td>
                @if($item->subscribe==1)
                已关注
                @else
                为关注
                @endif
            </td>
            <td>
                <a href="{{url('wechat/pro')}}?openid={{$item->openid}}">详情</a>
            </td>
            <td>
                <a href="{{url('wechat/see_label')}}?openid={{$item->openid}}">查看标签</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>