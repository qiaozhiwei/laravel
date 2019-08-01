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
    <caption>
        <h1>
            <a href="<?php echo e(url('property/addcar')); ?>">车辆入库</a>
        </h1>
    </caption>
        <tr>
            <td>门卫</td>
            <td>添加时间</td>
            <td>备注</td>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->name); ?></td>
            <td><?php echo e(date('Y-m H:i',$item->add_time)); ?></td>
            <td>
                <a href="<?php echo e(url('property/car')); ?>?name=<?php echo e($item->name); ?>">车辆管理</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/property_index.blade.php ENDPATH**/ ?>