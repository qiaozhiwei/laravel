<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>list</title>
</head>
<body>
    <?php if($state==1): ?>
    <center>
    <a href="<?php echo e(url('live_user/create')); ?>">去添加管理员</a>
    <a href="<?php echo e(url('live_user/create_team')); ?>">去添加比赛</a>
    </center>
    <?php else: ?>
    <?php endif; ?>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/live/list.blade.php ENDPATH**/ ?>