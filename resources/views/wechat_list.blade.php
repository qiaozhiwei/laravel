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
    <input type="hidden" id="id" value="{{$id}}">
    <caption>
        <h1>
            <a href="javascript:;" id="label">确认</a>
        </h1>
    </caption>
        <tr>
            <td>选择</td>
            <td>OPENID</td>
            <td>ID</td>
            <td>添加时间</td>
            <td>是否关注</td>
            <td>备注</td>
        </tr>
        @foreach($arr as $item)
        <tr>
            <td>
                <input type="checkbox" class="checkbox">
            </td>
            <td>{{$item->openid}}</td>
            <td>{{$item->id}}</td>
            <td>{{date("Y-m-d H:i:s",$item->add_time)}}</td>
            <td>
                @if($item->subscribe==1)
                已关注
                @else
                未关注
                @endif
            </td>
            <td>
                <a href="{{url('wechat/pro')}}?openid={{$item->openid}}">详情</a>
            </td>
                
        </tr>
        @endforeach
    </table>

    <script>
        $(function(){
            $('#label').click(function(){
                var checkbox=$('.checkbox');
                // console.log(checkbox);
                var array=new Array();
                checkbox.each(function(){
                    var checked=$(this).prop('checked')
                    // console.log(checked);
                    if(checked==true){
                        var openid=$(this).parents('td').next().text();
                        // console.log(openid);
                        array.push(openid)
                    }
                });
                var id=$('#id').val();
                // alert(id);return false;
                array.push(id)
                // console.log(array);return false;
                location.href="{{url('wechat/set_label')}}?array="+array;
                return false;
            });
        });
    </script>
</body>
</html>