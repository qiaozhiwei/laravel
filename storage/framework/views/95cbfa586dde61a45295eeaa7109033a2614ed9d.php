<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border=1 align="center">
    <form action="<?php echo e(url('StudentController/index')); ?>">
        <caption>
            <input type="text" name="search" value="<?php echo e($search); ?>">
                <input type="submit" value="搜索">
        </caption>
        
    </form>
        <tr>
                <td>ID</td>
                <td>姓名</td>
                <td>年龄</td>
                <td>性别</td>
                <td>添加时间</td>
                <td>操作</td>
          </tr> 
        <?php $__currentLoopData = $student; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->id); ?></td>
                <td><?php echo e($item->name); ?></td>
                <td><?php echo e($item->age); ?></td>
                <td><?php echo e($item->sex); ?></td>
                <td><?php echo e(date("Y-m-d H:m:s",$item->create_time)); ?></td>
                <td>
                    <a href="<?php echo e(url('StudentController/delete')); ?>?id=<?php echo e($item->id); ?>">删除</a>
                    <a href="<?php echo e(url('StudentController/update')); ?>?id=<?php echo e($item->id); ?>">修改</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($student->appends(['search' =>"$search"])->links()); ?></td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/StudentList.blade.php ENDPATH**/ ?>