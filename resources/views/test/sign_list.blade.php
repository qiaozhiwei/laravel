<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>参与人列表</title>
</head>
<body>
    <table align="center">
        <tr>
            <td>姓名</td>
            <td>参与的活动</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->name}}</td>
            <td>{{$v->act_name}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>