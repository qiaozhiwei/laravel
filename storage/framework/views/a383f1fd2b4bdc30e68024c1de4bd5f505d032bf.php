<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/1.js"></script>
</head>
<body>
    <form action="<?php echo e(url('in/docreate')); ?>" method="post">
    <?php echo csrf_field(); ?>
        <table  align="center" border=1>
            <tr>
                <td>项目
                    <input type="text" name="name" id="name">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="添加" class="submit">
                </td>
            </tr>



            <tr>
                <td>问题类型</td>
                <td>问题</td>
                <td>答案</td>   
                <td>备注</td>
            </tr>

            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr q_id="<?php echo e($item->q_id); ?>" class="tr">
                    <td><?php echo e($item->type); ?></td>
                    <td><?php echo e($item->question); ?></td>
                    <td><?php echo e($item->answer); ?></td>
                    <td>
                        <input type="checkbox" >
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </form>

    <script>
        $('.submit').click(function(){
            var array=new Array();
            var name=$('#name').val();
            // alert(name);
            var tr=$('.tr');
            tr.each(function(){
                var q_id=$(this).attr('q_id');
                // console.log(q_id);
                var checked=$(this).find('input').prop('checked');
                // console.log(checked);
                if(checked==true){
                    // console.log(q_id);
                    array.push(q_id);
                }
            });
            // console.log(array);
            $.get(
                "<?php echo e(url('in/docreate')); ?>",
                {array:array,name:name},
                function(res){
                    // console.log(res);
                    alert(res.msg);
                    if(res.code==1){
                        location.href="<?php echo e(url('in/index')); ?>";
                    }
                },
                'json'
            );
            return false;
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/in_create.blade.php ENDPATH**/ ?>