<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('wechat/do_push_info')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="tag_id" value="<?php echo e($id); ?>">
        <table align="center">
            <tr>
                <td>
                    内容：<textarea name="content"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="推送">
                </td>
            </tr>
        </table>
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_push_info.blade.php ENDPATH**/ ?>