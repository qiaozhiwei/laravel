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
    <table align="center" border=1>
    <input type="hidden" name="tag_id" value="{{$id}}" id="tag_id">
    <caption>
        <h1>
            <p style="color:blue">粉丝列表</p>
            
        </h1>
        <h2>
            <a href="javascript:;" id="unset">取消标签</a>
        </h2>
    </caption>
        <tr>
            <td>选项</td>
            <td>OPENID</td>
        </tr>
        @foreach($data as $item)
        <tr>
            <td>
                <input type="checkbox" class="checkbox">
            </td>
            <td>{{$item}}</td>
        </tr>
        @endforeach
    </table>
    <script>
        $(function(){
            $('#unset').click(function(){
                var array=new Array();
                var checkbox=$('.checkbox');
                // console.log(checkbox);
                checkbox.each(function(){
                    var checked=$(this).prop('checked')
                    // console.log(checked);
                    if(checked==true){
                        var openid=$(this).parents('td').next().text();
                        // console.log(openid);
                        array.push(openid);
                    }
                });
                var tag_id=$('#tag_id').val();
                // alert(tag_id);
                array.push(tag_id);
                // console.log(array);return false;
                location.href="{{url('wechat/label_unset')}}?array="+array;
            });
        });
    </script>
</body>
</html>