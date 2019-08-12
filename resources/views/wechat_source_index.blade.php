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
            <td>素材ID</td>
            <td>素材名字</td>
            <td>修改时间</td>
            <td>URL</td>
            <td>操作</td>
        </tr>
        @foreach($arr as $item)
        <tr>
            <td>{{$item['media_id']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{date('Y-m-d H:i:s',$item['update_time'])}}</td>
            <td>{{$item['url']}}</td>
            <td>
                <a href="{{url('wechat/del_source')}}?media_id={{$item['media_id']}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>