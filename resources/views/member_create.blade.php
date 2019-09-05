<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <script src="/1.js"></script>
    <title>Document</title>
</head>
<body >
    <form>
        <table align="center" >
            <tr>
                <td>
                    会员名：<input type="text" name="name" class="name">
                </td>
            </tr>
            <tr>
                <td>
                    手机：<input type="text" name="tel" class="tel">
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
            $('#button').on('click',function(){
                var name=$('.name').val();
                var tel=$('.tel').val();
                // console.log(name);
                // console.log(tel);
                $.post(
                    "{{url('/ziyuan')}}",
                    {name:name,tel:tel},
                    function(res){
                        console.log(res);
                    },
                    'josn'
                );
                return false;
            });
        });
    </script> 
</body>
</html>