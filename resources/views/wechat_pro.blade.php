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
            <td>
                <h1>
                头像：<img src="{{$data['headimgurl']}}" width="150px;" height="150px;">
                </h1>
                <h1>
                性别：@if($data['sex']==1)
                    男
                    @else
                    女
                    @endif
                </h1>
                <h1>
                昵称：{{$data['nickname']}}
                </h1>
                <h1>
                城市：{{$data['province']}}.{{$data['city']}}
                </h1>
                <h1>
                OPENID：{{$data['openid']}}
                </h1>
            </td>
        </tr>
    </table>
</body>
</html>