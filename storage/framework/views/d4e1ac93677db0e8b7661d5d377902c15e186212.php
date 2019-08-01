<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('property/doaddcar')); ?>" method="post">
    <?php echo csrf_field(); ?>
        <table align="center" >
            <tr>
                <td>
                车辆名称：<input type="text" name="car_name">
                </td>
            </tr>
            <tr>
                <td>
                    车牌号：<input type="text" name="car_number">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="进入车库">
                </td>
            </tr>
        </table>
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/property_addcar.blade.php ENDPATH**/ ?>