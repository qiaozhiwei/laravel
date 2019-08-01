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
                    尊敬的车主：<?php echo e($car_number); ?>

                </h1>
                <h1>
                    停车：<?php echo e($time); ?>分钟
                </h1>
                <h1>
                    收费：<?php echo e($price); ?>元
                </h1>
            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/property_unsetcar.blade.php ENDPATH**/ ?>