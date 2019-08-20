<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('text/liuyan')}}" method="post">
    <input type="hidden" name="openid" value="{{$openid}}">
    <input type="hidden" name="uid" value="{{$uid}}"">
    <input type="hidden" name="nickname" value="{{$nickname}}">
    @csrf
        <table align="center">
            <tr>
                <td>留言内容：<textarea name="content"></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="留言">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>