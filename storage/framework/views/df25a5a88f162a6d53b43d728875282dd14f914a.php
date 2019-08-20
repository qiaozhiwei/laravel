<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border=1 align="center">
    <caption>
        <h1>
            <a href="<?php echo e(url('text/send')); ?>">我的留言</a>
        </h1>
    </caption>
        <tr>
            <td>用户</td>
            <td>操作</td>
        </tr>
        <?php $__currentLoopData = $nickname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v['nickname']); ?></td>
            <td>
                <a href="<?php echo e(url('text/liuyans')); ?>?openid=<?php echo e($v['openid']); ?>&uid=<?php echo e($uid); ?>&&nickname=<?php echo e($v['nickname']); ?>">留言</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/text_index.blade.php ENDPATH**/ ?>