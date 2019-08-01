<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center">
        <tr>
            <td>
            <h1>
                经度：<?php echo e($lat); ?>

            </h1>
            <h1>
                纬度：<?php echo e($lng); ?>

            </h1>
                <h1>
                <?php echo e($address); ?>

                </h1>
            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/real_address.blade.php ENDPATH**/ ?>