<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户添加</title>
</head>
<body>
    <form action="<?php echo e(url('live_user/docreate')); ?>" method="post">
    <table align="center">
        <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="user_name">
                </td>
            </tr>
            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="pwd">
                </td>
            </tr>
            <tr>
            <td>权限</td>
                <td>
                    管理员<input type="radio" name="state" value="1">
                    解说<input type="radio" name="state" value="2">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="添加"></td>
            </tr>
    </table>
       
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/live/create.blade.php ENDPATH**/ ?>