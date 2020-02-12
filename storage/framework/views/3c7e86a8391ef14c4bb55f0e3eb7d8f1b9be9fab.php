<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('live_user/docreate_team')); ?>" method="post">
        <table align="center">
            <tr>
                <td>队伍一：</td>
                <td><input type="text" name="name_first"></td>
            </tr>
            <tr>
                <td>队伍二：</td>
                <td><input type="text" name="name_second"></td>
            </tr>
            <tr>
                <td>比赛开始时间：</td>
                <td><input type="text" name="start_time"></td>
            </tr>
            <tr>
                <td><input type="submit" value="添加"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php /**PATH C:\wnmp\www\laravel\resources\views/live/create_team.blade.php ENDPATH**/ ?>