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
                <a href="<?php echo e(url('test/add')); ?>">添加题库</a>
            </h1>
            <h1>
                <a href="<?php echo e(url('test/test')); ?>">生成试卷</a>
            </h1>
        </caption>
        <tr>
            <td>ID</td>
            <td>题库名称</td>
            <td>试题类型</td>
            <td>正确答案</td>
            <td>题库链接</td>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->id); ?></td>
            <td><?php echo e($item->name); ?></td>
            <td>
                <?php if($item->select==1): ?>
                单选
                <?php elseif($item->select==2): ?>
                多选
                <?php else: ?>
                判断
                <?php endif; ?>
            </td>
            <td><?php echo e($item->value); ?></td>
            <td>
                <a href="<?php echo e(url('test/index')); ?>"><?php echo e($item->url); ?></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/test_index.blade.php ENDPATH**/ ?>