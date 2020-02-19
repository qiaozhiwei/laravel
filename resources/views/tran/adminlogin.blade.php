<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('tran/do_adminlogin')}}" method="post">
    <h1 align="center">Admin</h1>
        <table align="center">
            <tr>
                <td>账号</td>
                <td><input type="text" name="username"></td>
            </tr>
        
        <tr>
            <td>密码</td>
            <td><input type="password" name="pwd"></td>
        </tr>
        <td>
            <td>
                <input type="submit" value="登陆">
            </td>
        </td>
        </table>
    </form>
</body>
</html>