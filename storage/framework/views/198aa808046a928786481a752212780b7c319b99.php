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
            粉丝列表
        </h1>
    </caption>
        <tr>
            <td>ID</td>
            <td>OPENID</td>
            <td>添加时间</td>
            <td>是否关注</td>
            <td>备注</td>
            <td>备注</td>

        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->id); ?></td>
            <td><?php echo e($item->openid); ?></td>
            <td><?php echo e(date("Y-m-d H:i:s",$item->add_time)); ?></td>
            <td>
                <?php if($item->subscribe==1): ?>
                已关注
                <?php else: ?>
                为关注
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo e(url('wechat/pro')); ?>?openid=<?php echo e($item->openid); ?>">详情</a>
            </td>
            <td>
                <a href="<?php echo e(url('wechat/see_label')); ?>?openid=<?php echo e($item->openid); ?>">查看标签</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_get_index.blade.php ENDPATH**/ ?>