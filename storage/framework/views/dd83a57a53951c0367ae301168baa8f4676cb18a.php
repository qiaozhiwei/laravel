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
                <a href="<?php echo e(url('distribution/add')); ?>">添加代理商</a>
            </h1>
        </caption>
        <tr>
            <td>ID</td>
            <td>代理商姓名</td>
            <td>二维码</td>
            <td>推广码</td>
            <td>备注</td>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v->id); ?></td>
            <td><?php echo e($v->user_name); ?></td>
            <td>
                <?php if($v->url==""): ?>
                尚未生成
                <?php else: ?>
                <img src="<?php echo e($v->url); ?>" width="100px;" height="100px;">
                <?php endif; ?>
            </td>
            <td>
                <?php if($v->url==""): ?>
                    无推广码
                    <?php else: ?>
                    <?php echo e($v->code); ?>

                    <?php endif; ?>
            </td>
            <td>
                <?php if($v->url==""): ?>
                <a href="<?php echo e(url('distribution/ticket')); ?>?name=<?php echo e($v->user_name); ?>">生成该代理商的二维码</a>
                <?php else: ?>
                已生成二维码
                    <a href="<?php echo e(url('distribution/pro')); ?>?name=<?php echo e($v->user_name); ?>">查看推广用户</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/distribution_index.blade.php ENDPATH**/ ?>