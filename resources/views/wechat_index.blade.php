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
        <td>模板ID</td>
        <td>模板标题</td>
        <td>模板内容</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v['template_id']}}</td>
        <td>{{$v['title']}}</td>
        <td>{{$v['content']}}</td>     
        <td>
            <a href="{{url('wechat/del')}}?id={{$v['template_id']}}">删除</a>
        </td>
    </tr>
    @endforeach
</table>
    
</body>
</html>