<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YYFC</title>
</head>
<body>
<center>
    <?php if($state==1): ?>
    <a href="<?php echo e(url('live_user/team_match')); ?>">查看比赛结详情</a>
    <a href="<?php echo e(url('live_user/choose_first')); ?>">解说比赛</a>
    <?php elseif($state==2): ?>
    <a href="<?php echo e(url('live_user/team_match')); ?>">查看比赛结详情</a>
    <a href="<?php echo e(url('live_user/choose_first')); ?>">解说比赛</a>
    <?php endif; ?>
</center>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/live/redi.blade.php ENDPATH**/ ?>