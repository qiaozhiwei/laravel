<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border=1 align="center">
        <tr>
            <td>项目名称</td>
            <td>问题类型</td>
            <td>问题</td>
            <td>答案</td>
            <td>项目添加时间</td>
        </tr>

        <tr>
            <td><?php echo e($data['name']); ?></td>
            <td><?php echo e($arr['type']); ?></td>
            <td><?php echo e($arr['question']); ?></td>
            <td><?php echo e($arr['answer']); ?></td>
            <td><?php echo e(date("Y-m-d H:i:s",$data['add_time'])); ?></td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/in_link.blade.php ENDPATH**/ ?>