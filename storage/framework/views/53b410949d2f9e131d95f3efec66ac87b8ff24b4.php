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
                <td>
                    <input type="text" name="question" value="面向对象三大特征">
                </td>
            </tr>
            <tr>
                <td>
                    封装<input type="checkbox" name="answer[]" value="封装">
                    继承<input type="checkbox" name="answer[]" value="继承">
                    多态<input type="checkbox" name="answer[]" value="多态">
                    开源<input type="checkbox" name="answer[]" value="开源">
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
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/in_b.blade.php ENDPATH**/ ?>