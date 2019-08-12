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
    <table border=1 align="center">
    <input type="hidden" name="openid" value="{{$openid}}" id="openid">
    <input type="hidden" name="tag_id" value="{{$data}}">
    <!-- <caption>
        <h1>
            <a href="javascript:;" id="delete">取消标签</a>
        </h1>
    </caption> -->
        <tr>
            <td>标签</td>
            <td>操作</td>
        </tr>
        @foreach($arr as $v)
        <tr>
            <td>{{$v}}</td> 
            <td>
               取消标签
            </td>
        </tr>
        @endforeach
    </table>
    <script>
        $(function(){
            $('.delete').click(function(){
                var _this=$(this);
                var openid=$('#openid').val();
                // alert(openid);
                return false;
                location.href="{{url('wechat/label_delete')}}?array="+array;
            });

        });
    </script>
</body>
</html>