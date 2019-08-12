<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/1.js"></script>
    <title>Document</title>
</head>
<body>
    <table border=1 align="center">
    <input type="hidden" name="openid" value="<?php echo e($openid); ?>" id="openid">
    <input type="hidden" name="tag_id" value="<?php echo e($data); ?>">
    <!-- <caption>
        <h1>
            <a href="javascript:;" id="delete">取消标签</a>
        </h1>
    </caption> -->
        <tr>
            <td>标签</td>
            <td>操作</td>
        </tr>
        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v); ?></td> 
            <td>
               取消标签
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <script>
        $(function(){
            $('.delete').click(function(){
                var _this=$(this);
                var openid=$('#openid').val();
                // alert(openid);
                return false;
                location.href="<?php echo e(url('wechat/label_delete')); ?>?array="+array;
            });

        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_see_label.blade.php ENDPATH**/ ?>