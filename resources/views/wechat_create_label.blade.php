<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('wechat/do_create_label')}}" method="post">
        @csrf
        <table align="center">
            <tr>
                <td>
                    标签名：<input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="创建">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>