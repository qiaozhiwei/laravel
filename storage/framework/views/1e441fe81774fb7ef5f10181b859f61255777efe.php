<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table align="center" border=1>
    <center>
        <a href="<?php echo e(url('tran/addUser')); ?>">添加用户</a>
    </center>
        <tr>
            <td>用户名</td>
            <td>添加时间</td>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v->username); ?></td>
            <td><?php echo e(date("Y-m-d H:i:s",$v->time)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/tran/adminindex.blade.php ENDPATH**/ ?>