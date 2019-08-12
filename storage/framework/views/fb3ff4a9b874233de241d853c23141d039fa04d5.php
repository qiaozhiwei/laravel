<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center">
        <tr>
            <td>
                <h1>
                头像：<img src="<?php echo e($data['headimgurl']); ?>" width="150px;" height="150px;">
                </h1>
                <h1>
                性别：<?php if($data['sex']==1): ?>
                    男
                    <?php else: ?>
                    女
                    <?php endif; ?>
                </h1>
                <h1>
                昵称：<?php echo e($data['nickname']); ?>

                </h1>
                <h1>
                城市：<?php echo e($data['province']); ?>.<?php echo e($data['city']); ?>

                </h1>
                <h1>
                OPENID：<?php echo e($data['openid']); ?>

                </h1>
            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/wechat_pro.blade.php ENDPATH**/ ?>