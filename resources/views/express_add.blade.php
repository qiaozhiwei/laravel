<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <form action="{{url('express/doadd')}}" method="get">
        @csrf
        <input type="hidden" name="openid" value={{$openid}}>
            <table align="center">
                <tr>
                    <td>
                        Ta：<input type="text" value="{{$nickname}}" name="name">
                    </td>
                </tr>
                <tr>
                    <td>
                        表白内容：<textarea name="content"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        表白人：<input type="text" name="send_name">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="表白">
                    </td>
                </tr>
            </table>
        </form>
    </table>
</body>
</html>