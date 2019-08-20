<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>二级菜单</title>
</head>
<body>
<form action="<?php echo e(url('wechat/doadd_two')); ?>" method="post">
    <?php echo csrf_field(); ?>
        <table align="center">
        <caption>
            <h1>
                菜单添加
            </h1>
        </caption>
            <tr>
                <td>
                    菜单类型：<select name="menu_type">
                        <option value="1">一级菜单</option>
                        <option value="2">二级菜单</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    菜单名字：<input type="text" name="name_one">
                </td>
            </tr>
            <tr>
                <td>
                    二级菜单名字：<input type="text" name="name_two">
                </td>
            </tr>
            <tr>
                <td>
                    二级菜单类型：<input type="text" name="type">
                </td>
            </tr>
            <tr>
                <td>
                key：<input type="text" name="key" placeholder="类型为click">
                </td>
            </tr>
            <tr>
                <td>
                    url：<input type="text" name="url" placeholder="类型为view">
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
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/menu_add_two.blade.php ENDPATH**/ ?>