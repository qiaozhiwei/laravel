<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('wechat/do_update_label')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="id" value=<?php echo e($id); ?>>
        <table align="center">
            <tr>
                <td>
                    标签名：<input type="text" name="name" value="<?php echo e($name); ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="修改">
                </td>
            </tr>
        </table>
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wecahr_update_label.blade.php ENDPATH**/ ?>