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
    <form action="<?php echo e(url('goods/docate')); ?>" method="post">
        <table align="center">
            <tr>
                <td>
                    分类：<input type="text" name="name" id="cate"><span id="span"></span>
                </td>
            </tr>
            <tr>
                <td>
                    父类：<select name="p_id">
                        <option value="0">无父类</option>
                        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($v['id']); ?>"><?php echo e($v['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="添加" id="submit">
                </td>
            </tr>
        </table>
    </form>
    <script>
        $('#cate').blur(function(){
            var name=$(this).val();
            // alert(name);
            $.get(
                "<?php echo e(url('goods/yi')); ?>",
                {name:name},
                function(res){
                    // console.log(res);
                    if(res==0){
                        $('#span').html('该分类已存在');
                        $('#submit').attr('disabled','true');
                        
                    }else{
                        $('#span').html('');
                        $('#submit').removeAttr('disabled');
                    }
                }
            );
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/goods_cate.blade.php ENDPATH**/ ?>