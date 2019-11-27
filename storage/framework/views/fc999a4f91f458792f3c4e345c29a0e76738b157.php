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
            <td>商品类型名称</td>
            <td>属性个数</td>
            <td>操作</td>
        </tr>
        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v['name']); ?></td>
            <td><?php echo e($v['count']); ?></td>
            <td>
                <a href="<?php echo e(url('goods/style_index')); ?>?id=<?php echo e($v['id']); ?>">属性列表</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/goods_type_index.blade.php ENDPATH**/ ?>