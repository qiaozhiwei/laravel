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
        <table align="center">
        <div>
        <tr>
            <td>最美女程序员<br /> 
            </td>
                </tr>
                <tr>
                    <td>
                    唐志欣<input type="radio" name="a">
                    阿左<input type="radio" name="a">
                    </td>
                </tr>
            </div>
        <div>
           <tr>
                <td>
                    面向对象的三大特征
                </td>
            </tr>
            <tr>
                <td>
                    封装<input type="checkbox" name="b">
                    继承<input type="checkbox" name="b">
                    多态<input type="checkbox" name="b">
                    开源<input type="checkbox" name="b">
                </td>
            </tr>
           </div>
           <tr>
                <td>
                    <input type="submit" value="添加">
                </td>
            </tr>
        </table>
    </form>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/in_c.blade.php ENDPATH**/ ?>