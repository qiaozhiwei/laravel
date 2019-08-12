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
        <td>模板ID</td>
        <td>模板标题</td>
        <td>模板内容</td>
        <td>操作</td>
    </tr>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($v['template_id']); ?></td>
        <td><?php echo e($v['title']); ?></td>
        <td><?php echo e($v['content']); ?></td>     
        <td>
            <a href="<?php echo e(url('wechat/del')); ?>?id=<?php echo e($v['template_id']); ?>">删除</a>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
    
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_index.blade.php ENDPATH**/ ?>