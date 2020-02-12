<?php $__env->startSection('right'); ?>
<form action="<?php echo e(url('index/doupdate_cate')); ?>" method="post">
<input type="hidden" name="id" value="<?php echo e($id); ?>">
    <table>
        <tr>
            <td>分类名称:</td>
            <td>
                <input type="text" name="c_name" value="<?php echo e($c_name); ?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="修改">
            </td>
        </tr>
    </table>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.userparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/index/cate_update.blade.php ENDPATH**/ ?>