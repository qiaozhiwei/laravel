<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('text/liuyan')); ?>" method="post">
    <input type="hidden" name="openid" value="<?php echo e($openid); ?>">
    <input type="hidden" name="uid" value="<?php echo e($uid); ?>"">
    <input type="hidden" name="nickname" value="<?php echo e($nickname); ?>">
    <?php echo csrf_field(); ?>
        <table align="center">
            <tr>
                <td>留言内容：<textarea name="content"></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="留言">
                </td>
            </tr>
        </table>
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/text_liuyans.blade.php ENDPATH**/ ?>