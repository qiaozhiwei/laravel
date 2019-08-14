<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <table align="center" border="1">
            <tr>
                <td>OPENID</td>
            </tr>
            @foreach($data as $v)
                <tr>
                    <td>{{$v->openid}}</td>
                </tr>
                @endforeach
        </table>
</body>
</html>