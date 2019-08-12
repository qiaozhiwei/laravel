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
<table align="center" border=1>
<input type="hidden" value=<?php echo e($openid); ?> id="openid">
    <caption>
        <h2>
            <p style="color:red">请选择标签的类型</p>
        </h2>
        <p>(一次只能选择一种哦!)</p>
        <h1>
            <a href="javascript:;" id="confirm">确认</a>
        </h1>
    </caption>
        <tr>
            <td>选择</td>
            <td>ID</td>
            <td>标签名</td>
            <td>操作</td>
        </tr>
    <?php $__currentLoopData = $re; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <input type="radio" name="radio" class="label">
            </td>
            <td><?php echo e($v['id']); ?></td>
            <td><?php echo e($v['name']); ?></td>
            <td>
                <?php if($v['id']==1): ?>
                不能删除系统默认保留的标签
                <?php elseif($v['id']==2): ?>
                不能删除系统默认保留的标签
                <?php elseif($v['id']==0): ?>
                不能删除系统默认保留的标签
                <?php else: ?>
                    <a href="<?php echo e(url('wechat/del_label')); ?>?id=<?php echo e($v['id']); ?>">删除</a>||
                <?php endif; ?>
                <a href="<?php echo e(url('wechat/update_label')); ?>?data=<?php echo e($v['name']); ?>.<?php echo e($v['id']); ?>">修改</a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <script>
        $(function(){
            $('#confirm').click(function(){
                var array=new Array();
                var radio=$('.label');
                // console.log(radio);
                radio.each(function(){
                    var checked=$(this).prop('checked');
                    // console.log(checked);
                    if(checked==true){
                        // console.log($(this));
                        var id=$(this).parents('td').next().text();
                        // console.log(id);
                        array.push(id)
                        
                    }
                });
                // console.log(array);
                var openid=$('#openid').val();
                // console.log(openid);return false;
                var data=openid+','+array;
                // console.log(data);return false;
                location.href="<?php echo e(url('wechat/do_set_label')); ?>?data="+data;
                
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_set_label.blade.php ENDPATH**/ ?>