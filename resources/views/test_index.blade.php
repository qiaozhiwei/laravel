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
                <a href="{{url('test/add')}}">添加题库</a>
            </h1>
            <h1>
                <a href="{{url('test/test')}}">生成试卷</a>
            </h1>
        </caption>
        <tr>
            <td>ID</td>
            <td>题库名称</td>
            <td>试题类型</td>
            <td>正确答案</td>
            <td>题库链接</td>
        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>
                @if($item->select==1)
                单选
                @elseif($item->select==2)
                多选
                @else
                判断
                @endif
            </td>
            <td>{{$item->value}}</td>
            <td>
                <a href="{{url('test/index')}}">{{$item->url}}</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>