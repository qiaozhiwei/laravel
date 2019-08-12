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
            <td>素材ID</td>
            <td>素材名字</td>
            <td>修改时间</td>
            <td>URL</td>
            <td>操作</td>
        </tr>
        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item['media_id']); ?></td>
            <td><?php echo e($item['name']); ?></td>
            <td><?php echo e(date('Y-m-d H:i:s',$item['update_time'])); ?></td>
            <td><?php echo e($item['url']); ?></td>
            <td>
                <a href="<?php echo e(url('wechat/del_source')); ?>?media_id=<?php echo e($item['media_id']); ?>">删除</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_source_index.blade.php ENDPATH**/ ?>