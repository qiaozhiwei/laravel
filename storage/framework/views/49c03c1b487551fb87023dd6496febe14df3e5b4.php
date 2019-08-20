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
    <table align="center" border=0>
    <caption>
        <h1>菜单列表</h1>
        <h1>
            <a href="<?php echo e(url('wechat/menu_add')); ?>">添加菜单</a>
        </h1>
        <h1>
            <a href="javascript:;" id="push">去搞</a>
        </h1>
    </caption>
        <tr>
            <td>菜单等级&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>选择&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>菜单编号&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>菜单名称&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>二级菜单&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>事件类型&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>KEY&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>URL&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>备注&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php if($v->menu_type==1): ?>
                    一级菜单
                    <?php else: ?>
                    二级菜单
                    <?php endif; ?>
                </td>
                <td>
                    <input type="checkbox" class="checkbox">
                </td>
                <td><?php echo e($v->id); ?></td>
                <td><?php echo e($v->name_one); ?></td>
                <td><?php echo e($v->name_two); ?></td>
                <td><?php echo e($v->type); ?></td>
                
                <td><?php echo e($v->key); ?></td>
                <td><?php echo e($v->url); ?></td>
                <td>
                    <a href="<?php echo e(url('wechat/menu_del')); ?>?id=<?php echo e($v->id); ?>">删除</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <script>
        $('#push').click(function(){
            var array=new Array();
            var checkbox=$('.checkbox');
            // console.log(checkbox);
            checkbox.each(function(){
                var checked=$(this).prop('checked');
                // console.log(checked);
                if(checked==true){
                    var id=$(this).parents('td').next('td').text();
                    // console.log(id);
                    // console.log(type);
                    array.push(id);
                }
            });
            // return false;
            // console.log(array);
            location.href="<?php echo e(url('wechat/push_two')); ?>?array="+array;
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/menu_index.blade.php ENDPATH**/ ?>