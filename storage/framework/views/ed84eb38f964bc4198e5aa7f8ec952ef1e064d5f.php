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
    <form action="">
        <table align="center">
            <tr>
                <td>商品名称：<input type="text" name="good_name" id="good_name"></td>
            </tr>
            <tr>
                <td>
                    商品价钱：<input type="text" name="good_price" id="good_price">
                </td>
            </tr>
            <tr>
                <td>
                    商品图片：<input type="file" name="good_pic" id="good_pic">
                </td>
            </tr>
            <tr>
                <td>
                    <button id="button">添加</button>
                </td>
            </tr>
        </table>
    </form>
    <script>
        $(function(){
            $('#button').click(function(){
                var good_name=$('#good_name').val();
                // alert(good_name);
                var good_price=$('#good_price').val();
                // alert(good_price);
                var file=new FormData();
                // console.log(file);
                var good_pic=$('#good_pic')[0].files[0];
                // console.log(good_pic);return false;
                var arr=new Array();
                arr.push(good_name);
                arr.push(good_price);
                // console.log(arr);return false;
                file.append('good_pic',good_pic);
                // console.log(file);
                
                $.ajax({
                    url:"<?php echo e(url('goodsinfo/docreate')); ?>?arr="+arr,
                    async:true,
                    type:"POST",
                    data:file,
                    dataType:'json',
                    processData:false,//数据是否格式化处理
                    contentType:false,//http post数据类型
                    success:function(res){
                        // console.log(res);
                        alert(res.msg);
                        if(res.code==200){
                            location.href="<?php echo e(url('goodsinfo/index')); ?>";
                        }
                    },

                });
                return false;
                
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/goodsinfo_create.blade.php ENDPATH**/ ?>