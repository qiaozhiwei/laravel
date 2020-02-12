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
            <td>球员</td>
            <td>操作</td>
        </tr>
        @foreach($player_info as $k=>$v)
        <tr>
            <td>{{$v['player_name']}}</td>
            <td><a href=""><input type="checkbox"</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>