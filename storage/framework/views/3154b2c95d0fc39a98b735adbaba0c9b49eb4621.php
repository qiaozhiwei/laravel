<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <table align="center" border=0>
    <caption>
    <form action="<?php echo e(url('sign/index')); ?>" method="get">
        按商品名称搜索:<input type="text" name="goods_name">
        按商品价格搜索：<input type="text" name="goods_price">
        <input type="submit" value="搜索">
    </form>
    </caption>
        <tr>
            <td>goods_name</td>
            <td>goods_pic</td>
            <td>goods_price</td>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v->goods_name); ?></td>
            <td><?php echo e($v->goods_pic); ?></td>
            <td><?php echo e($v->goods_price); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
            <?php echo e($data->appends(['goods_name' => "$goods_name",'goods_price'=>"$goods_price"])->links()); ?>

            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/sign_index.blade.php ENDPATH**/ ?>