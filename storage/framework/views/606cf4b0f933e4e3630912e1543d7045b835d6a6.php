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
        <form action="<?php echo e(url('express/doadd')); ?>" method="get">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="openid" value=<?php echo e($openid); ?>>
            <table align="center">
                <tr>
                    <td>
                        Ta：<input type="text" value="<?php echo e($nickname); ?>" name="name">
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
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/express_add.blade.php ENDPATH**/ ?>