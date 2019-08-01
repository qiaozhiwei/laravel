<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/1.js"></script>
    <title>竞猜列表</title>
</head>
<body>
    <table border=1 align="center">
        <caption>
            <h1>
                <a href="<?php echo e(url('cai/add')); ?>">添加竞猜</a>
            </h1>
            <h2>竞猜列表</h2>
            
        </caption>
        <tr>
            <td>ID</td>
            <td>队伍2</td>
            <td>备注</td>
            <td>队伍1</td>
            <td>竞猜结束时间</td>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->c_id); ?></td>
            <td file="name2"><?php echo e($item->name2); ?></td>
            <td>
                <?php if($time<$item->c_time): ?>
                <button class="a">我要竞猜</button>
                <?php elseif($time>$item->c_time): ?>
                <button class="b">查看比赛结果</button><br />
                <button class="c">查看竞猜结果</button>
                <?php else: ?>
                正在比赛
                <?php endif; ?>
            </td>
            <td file="name1"><?php echo e($item->name1); ?></td>
            <td><?php echo e(date("m-d H:i",$item->c_time)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>


    <script>
        $(function(){
            //我要竞猜
            $('.a').click(function(){
                var _this=$(this);
                // console.log(_this);
                var name2=_this.parent('td').prev().text();
                // alert(name2);
                var name1=_this.parent('td').next().text();
                // alert(name1);
                var name= new Array();
                // console.log(name);
                name.push(name1,name2);
                // console.log(name);
                location.href="<?php echo e(url('cai/cai')); ?>?name="+name;
            });
            //查看比赛结果
            $('.b').click(function(){
                var _this=$(this);
                var name2=_this.parent('td').prev().text();
                // alert(name2);return false;
                var name1=_this.parent('td').next().text();
                // alert(name1);
                var array=new Array();
                array.push(name1,name2);
                // console.log(array);return false;
               location.href="<?php echo e(url('cai/exam')); ?>?array="+array;

            });
            $('.c').click(function(){
                var _this=$(this);
                var name2=_this.parent('td').prev().text();
                // alert(name2);return false;
                var name1=_this.parent('td').next().text();
                // alert(name1);
                var array=new Array();
                array.push(name1,name2);
                // console.log(array);
                location.href="<?php echo e(url('cai/list')); ?>?array="+array;
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/cai_index.blade.php ENDPATH**/ ?>