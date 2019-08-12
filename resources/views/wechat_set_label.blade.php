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
<input type="hidden" value={{$openid}} id="openid">
    <caption>
        <h2>
            <p style="color:red">请选择标签的类型</p>
        </h2>
        <p>(一次只能选择一种哦!)</p>
        <h1>
            <a href="javascript:;" id="confirm">确认</a>
        </h1>
    </caption>
        <tr>
            <td>选择</td>
            <td>ID</td>
            <td>标签名</td>
            <td>操作</td>
        </tr>
    @foreach($re as $v)
        <tr>
            <td>
                <input type="radio" name="radio" class="label">
            </td>
            <td>{{$v['id']}}</td>
            <td>{{$v['name']}}</td>
            <td>
                @if($v['id']==1)
                不能删除系统默认保留的标签
                @elseif($v['id']==2)
                不能删除系统默认保留的标签
                @elseif($v['id']==0)
                不能删除系统默认保留的标签
                @else
                    <a href="{{url('wechat/del_label')}}?id={{$v['id']}}">删除</a>||
                @endif
                <a href="{{url('wechat/update_label')}}?data={{$v['name']}}.{{$v['id']}}">修改</a>
            </td>
        </tr>
    @endforeach
    </table>
    <script>
        $(function(){
            $('#confirm').click(function(){
                var array=new Array();
                var radio=$('.label');
                // console.log(radio);
                radio.each(function(){
                    var checked=$(this).prop('checked');
                    // console.log(checked);
                    if(checked==true){
                        // console.log($(this));
                        var id=$(this).parents('td').next().text();
                        // console.log(id);
                        array.push(id)
                        
                    }
                });
                // console.log(array);
                var openid=$('#openid').val();
                // console.log(openid);return false;
                var data=openid+','+array;
                // console.log(data);return false;
                location.href="{{url('wechat/do_set_label')}}?data="+data;
                
            });
        });
    </script>
</body>
</html>