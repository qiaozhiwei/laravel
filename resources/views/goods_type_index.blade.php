<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center">
        <tr>
            <td>商品类型名称</td>
            <td>属性个数</td>
            <td>操作</td>
        </tr>
        @foreach($arr as $v)
        <tr>
            <td>{{$v['name']}}</td>
            <td>{{$v['count']}}</td>
            <td>
                <a href="{{url('goods/style_index')}}?id={{$v['id']}}">属性列表</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>