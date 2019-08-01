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
        <tr>
            <td>ID</td>
            <td>项目名称</td>
            <td>添加时间</td>
            <td>备注</td>
            <td>
                操作
            </td>
        </tr>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->id); ?></td>
            <td><?php echo e($item->name); ?></td>
            <td><?php echo e(date('Y-m-d H:i:s',$item->add_time)); ?></td>
            <td>
                <a href="<?php echo e(url('in/delete')); ?>?id=<?php echo e($item->id); ?>">删除</a>
            </td>
            <td>
               <a href="<?php echo e(url('in/links')); ?>?id=<?php echo e($item->id); ?>">启用</a>
            </td>
            
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr >
            <td colspan="5">
            <?php echo e($data->links()); ?>

            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/in_index.blade.php ENDPATH**/ ?>