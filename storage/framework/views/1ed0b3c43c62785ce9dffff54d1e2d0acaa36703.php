<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <title>Document</title>
</head>
<body>

    <center>所有线路</center>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <table align="center" border=1>
        <tr>
            <td>线路名称</td>
            <td>价格</td>
            <td>注册时间</td>
            <td>折扣比例</td>
            <td>操作</td>
        </tr>
        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v['linename']); ?></td>
            <td><?php echo e($v['lineprice']); ?></td>
            <td><?php echo e($v['time']); ?></td>
            <td><input type="text" id="linename" name="dis"></td>
            <td>
                <a href="javascript:;" class="create" lid="<?php echo e($v['id']); ?>" uid="<?php echo e($v['uid']); ?>">添加</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <center>已添加线路</center>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <table align="center" border=1 id="table">
    <tr>
            <td>线路名称</td>
            <td>价格</td>
            <td>注册时间</td>
            <td>折扣比例</td>
            <td>操作</td>
        </tr>
        <?php $__currentLoopData = $info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v['linename']); ?></td>
            <td><?php echo e($v['lineprice']); ?></td>
            <td><?php echo e($v['time']); ?></td>
            <td><?php echo e($v['discount']); ?></td>
            <td>111</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    

    <script>
        $(document).on("click",".create",function(){
            // alert(1111);
            var _this=$(this);
            // console.log(_this);
            var uid=_this.attr("uid");
            // alert(uid);
            var lid=_this.attr("lid");
            // alert(lid);
            var discount=_this.parent("td").prev("td").children('input').val();
            // console.log(linename);
            $.post(
                "<?php echo e(url('dis/docreate_line')); ?>",
                {discount:discount,uid:uid,lid:lid},
                function(res){
                    // console.log(res);return false;
                    if(res.code==1){
                        var tr='<tr>\
                                    <td>'+res.arr.linename+'</td>\
                                    <td>'+res.arr.linepirce+'</td>\
                                    <td></td>\
                                    <td>'+res.arr.discount+'</td>\
                                    <td>删除</td>\
                                </tr>';

                                // console.log(tr);
                        $("#table").append(tr);
                    }
                },
                'json'
                
            );
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/cs/create_line.blade.php ENDPATH**/ ?>