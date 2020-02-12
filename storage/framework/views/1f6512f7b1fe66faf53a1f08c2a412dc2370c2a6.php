<?php $__env->startSection('right'); ?>
<table border=1>
    <tr>
        <td>ID</td>
        <td>分类名称</td>
        <td>备注</td>
    </tr>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($item->c_id); ?></td>
        <td><?php echo e($item->c_name); ?></td>
        <td>
        <a href="<?php echo e(url('index/cate_delete')); ?>?id=<?php echo e($item->c_id); ?>">删除</a>
        <a href="<?php echo e(url('index/cate_update')); ?>?id=<?php echo e($item->c_id); ?>">修改</a>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.userparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/index/cate_index.blade.php ENDPATH**/ ?>