<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('bank/doadd')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <table>
            <tr>
                <td>
                    车次<input type="text" name="train">
                </td>
            </tr>
            <tr>
                <td>
                    出发站<input type="text" name="start">
                </td>
            </tr>
            <tr>
                <td>
                    目的地<input type="text" name="end">
                </td>
            </tr>
            <tr>
                <td>
                    价格<input type="text" name="price">
                </td>
            </tr>
            <tr>
                <td>
                    票数<input type="text" name="number">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="添加">
                </td>
            </tr>
        </table>
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/bank_add.blade.php ENDPATH**/ ?>