<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/1.js"></script>
</head>
<body>
    <form action="<?php echo e(url('in/doadd')); ?>" method="post">
    <?php echo csrf_field(); ?>
        <table align="center" >

        <tr>
            <td>
            <button>单选</button>
            <button>多选</button>
            </td>
        </tr>
            
        </table>
    </form>

    <script>
        $('button').click(function(){
            var _this=$(this);
            var value=_this.text();
            // alert(value);
            var type='单选';
            var types="多选";
            if(value=="单选"){
                location.href="<?php echo e(url('in/a')); ?>?type="+type;
            }else if(value=="多选"){
                location.href="<?php echo e(url('in/b')); ?>?type="+types;
            }else{
                location.href="<?php echo e(url('in/c')); ?>";
            }
            return false;
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/in_add.blade.php ENDPATH**/ ?>