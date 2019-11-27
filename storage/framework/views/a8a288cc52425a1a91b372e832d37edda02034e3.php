<?php $__env->startSection('right'); ?>
<form action="<?php echo e(url('index/docreate_cate')); ?>" method="post">
    <table>
        <tr>
            <td>分类名称:</td>
            <td>
                <input type="text" name="c_name">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="添加">
            </td>
        </tr>
    </table>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.userparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/index/cate_create.blade.php ENDPATH**/ ?>