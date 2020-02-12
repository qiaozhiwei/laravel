<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('act/dosign')); ?>" method="post">
    <input type="hidden" name="act_id" value="<?php echo e($act_id); ?>">
        <table align="center">
            <tr>
                <td>电话：</td>
                <td>
                    <input type="text" name="phone">
                </td>
            </tr>
            <tr>
                <td>姓名：</td>
                <td>
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="报名"></td>
            </tr>
        </table>
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/test/create_sign.blade.php ENDPATH**/ ?>