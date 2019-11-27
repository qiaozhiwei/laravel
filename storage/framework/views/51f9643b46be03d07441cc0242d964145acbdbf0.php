<?php $__env->startSection('right'); ?>
<form method="post" action="http://upload-z1.qiniup.com"
enctype="multipart/form-data">

 <input name="token" type="hidden" value="5V9DkGEmJygwe82t-jZ35FryoV_EXmMZd5bIuz2t:Ir-aPlv1oGcipiZ2O7KZVYcXWZQ=:eyJzY29wZSI6IjE5MDJxaWFvemhpd2VpIiwiZGVhZGxpbmUiOjE1NzQ3ODQxMjB9">
 <input name="file" type="file" />
 <input type="submit" value="上传文件" />
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.userparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/index/img_upload.blade.php ENDPATH**/ ?>