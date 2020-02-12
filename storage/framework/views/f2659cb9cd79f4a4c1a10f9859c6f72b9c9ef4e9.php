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
    <table align="center">
        <tr>
            <td>队伍</td>
            <td>
                操作
            </td>
        </tr>
        <?php $__currentLoopData = $team_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v); ?></td>
            <td><input class="team" type="checkbox" team="<?php echo e($v); ?>"></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><button id="team">下一步</button></td>
        </tr>
    </table>

    

    <script>
        $("#team").click(function(){
            var _this=$(this);
            var arr=new Array();
            var team=$(".team");
            // console.log(team);
            team.each(function(){
                var checked=$(this).prop("checked");
                // console.log(checked);
                if(checked==true){
                    var team_name=$(this).attr('team');
                    arr.push(team_name);
                }
            });
            // console.log(arr);
            // location.href="<?php echo e(url('wechat/push_two')); ?>?array="+array;
            var url="<?php echo e(url('live_user/choose_player')); ?>?arr="+arr;
            location.href=url;
            return false;
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/live/choose_first.blade.php ENDPATH**/ ?>