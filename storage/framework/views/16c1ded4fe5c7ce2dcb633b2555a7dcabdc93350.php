<?php $__env->startSection('right'); ?>
<form action="https://api.weixin.qq.com/cgi-bin/material/add_material" method="post" enctype="multipart/form-data">
    <table>
    <tr>
        <td>
            access_token:
        </td>
        <td>
            <input type="text" name="access_token">
        </td>
    </tr>
    <tr>
        <td>
            资源类型:
        </td>
        <td>
            <input type="text" name="type">
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
<?php echo $__env->make('layout.userparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/index/music_upload.blade.php ENDPATH**/ ?>