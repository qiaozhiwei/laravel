<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加门卫</title>
</head>
<body>
    <form action="{{url('property/doadd')}}" method="post">
    @csrf
        <table align="center">
            <tr>
                <td>
                    账户<input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td>
                    密码<input type="password" name="pwd">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="添加">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>