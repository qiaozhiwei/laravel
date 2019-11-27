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
    <form action="<?php echo e(url('goods/dostyle')); ?>" method="post">
        <table align="center">
            <tr>
                <td>
                   类型：<select name="type_name">
                       <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($v->id); ?>"><?php echo e($v->name); ?></option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                </td>
            </tr>
            <tr>
                <td>
                    属性：<input type="text" name="name">
                </td>
            </tr>
            <tr>
                    <td>
                        是否可选：<input type="radio" name="is_radio" value="1">是
                                <input type="radio" name="is_radio" value="2">否
                    </td>
                </tr>
            <tr>
                
                <td>
                    <input type="submit" value="添加">
                </td>
            </tr>
        </table>
    </form>


</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/goods_style.blade.php ENDPATH**/ ?>