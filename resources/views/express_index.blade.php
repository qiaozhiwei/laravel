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
            <td>OPENID</td>
            <td>备注</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->openid}}</td>
            <td>
                <a href="{{url('express/add')}}?openid={{$v->openid}}">对Ta表白</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>