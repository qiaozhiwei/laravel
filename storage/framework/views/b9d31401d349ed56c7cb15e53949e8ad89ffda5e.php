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
                <td>openid</td>
            </tr>
            <?php $__currentLoopData = $openid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
    <form action="<?php echo e(url('wechat/doadd')); ?>" method="post">
    </form> 
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_add.blade.php ENDPATH**/ ?>