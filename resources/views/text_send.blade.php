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
            <td>ID</td>
            <td>Uid</td>
            <td>留言内容</td>
            <td>留言用户昵称</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->uid}}</td>
            <td>{{$v->content}}</td>
            <td>{{$v->nickname}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>