<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('in/doadd')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <table align="center">
    <div>
        <tr>
            <td><input type="text" name="question"> 
            </td>
                </tr>
                <tr>
                    <td>
                    唐志欣<input type="radio" name="answer" value="唐志欣">
                    阿左<input type="radio" name="answer" value="阿左">
                    </td>
                </tr>
            </div>
            <tr>
                <td>
                    <input type="submit" value="添加">
                </td>
            </tr>
            <input type="hidden" name="type" value="<?php echo e($type); ?>">
    </table>
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/in_a.blade.php ENDPATH**/ ?>