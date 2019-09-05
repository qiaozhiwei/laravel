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
    <form action="">
    <input type="hidden" name="id" value="<?php echo e($arr[0]); ?>" id="hidden">
        <table align="center" id="table">
            <tr>
                <td>
                    会员名字：<input type="text" name="name" value="<?php echo e($arr[1]); ?>" id="name">
                </td>
            </tr>
            <tr>
                <td>
                    电话：<input type="text" name="tel" value="<?php echo e($arr[2]); ?>" id="tel">
                </td>
            </tr>
            <tr>
                <td>
                    <button>修改</button>
                </td>
            </tr>
        </table>
    </form>
    <script>
        // alert($);
        $(function(){
            $('button').click(function(){
                var name=$('#name').val();
                var tel=$('#tel').val();
                var id=$('#hidden').val();
                // console.log(id);
                var url="<?php echo e(url('/ziyuan')); ?>"+'/'+id;
                // console.log(url);return false;
            $.ajax({
                type:'POST',
                data:{_method:"PUT",name:name,tel:tel},
                url:url,
                dataType: "json",  
                success:function(res){
                    if(res.code==200){
                        if(res.code==200){
                            location.href="<?php echo e(url('member/index1')); ?>";
                        }else{
                            alert(res.code);
                        }
                    }
                }
            })
                return false;
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/member_update.blade.php ENDPATH**/ ?>