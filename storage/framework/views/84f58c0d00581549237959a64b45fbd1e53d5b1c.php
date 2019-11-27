<?php $__env->startSection('right'); ?>
<form action="<?php echo e(url('index/doupload')); ?>" method="post" enctype="multipart/form-data">
    <table>
    <tr>
        <td>
            歌名:
        </td>
        <td>
            <input type="text" name="name">
        </td>
    </tr>
        <tr>
            <td>选择文件</td>
            <td><input type="file" name="media"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="上传">
            </td>
        </tr>
    </table>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.userparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/index/upload.blade.php ENDPATH**/ ?>