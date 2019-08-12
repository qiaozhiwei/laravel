<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('wechat/do_create_label')); ?>" method="post">
        <?php echo csrf_field(); ?>
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
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_create_label.blade.php ENDPATH**/ ?>