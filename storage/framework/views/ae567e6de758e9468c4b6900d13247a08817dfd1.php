<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('property/docreate')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <table align="center">

        <tr>
            <td>
                数量：<input type="text" name="parking_num">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="添加">
            </td>
        </tr>
    </form>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/property_create.blade.php ENDPATH**/ ?>