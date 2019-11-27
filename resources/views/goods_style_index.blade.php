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
            <td>属性名称</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->name}}</td>
            <td>
                <a href="">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>