<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/1.js"></script>
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(url('cai/doadd')); ?>" method="post">
    <?php echo csrf_field(); ?>
        <table  align="center">
            <tr>
                <td>队伍1<input type="text" name="name1" class="a"></td>
            </tr>
            <tr>
                <td>队伍2<input type="text" name="name2" class="b"></td>
            </tr>
            
            <tr>
                <td>
                    <input type="submit" value="添加竞猜" class="submit">
                </td>
            </tr>
        </table>
    </form>
    <script>
        // alert($);
        $(function(){
            $('.submit').click(function(){
                var name1=$('.a').val();
                // alert(name1);
                var name2=$('.b').val();
                // alert(name2);
                if(name1==name2){
                    alert('竞猜队伍须不同');return false;
                }
                // return false;
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/cai_add.blade.php ENDPATH**/ ?>