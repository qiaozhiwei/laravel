<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center" border=1>
        <tr>
            <td>用户名</td>
            <td>密码</td>
            <td>注册时间</td>
            <td>折扣线路</td>
        </tr>
        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v['username']); ?></td>
            <td><?php echo e($v['password']); ?></td>
            <td><?php echo e($v['time']); ?></td>
            <td>
                <a href="<?php echo e(url('dis/create_line')); ?>?uid=<?php echo e($v['id']); ?>"><?php echo e($v['dis']); ?></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/cs/list_user.blade.php ENDPATH**/ ?>