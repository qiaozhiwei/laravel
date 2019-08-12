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
        <caption>
            <h1>标签列表</h1>
            <h1>
            
            </h1>
            <h1>
                <a href="{{url('wechat/ticket')}}">生成公众号二维码</a><br />
                <a href="{{url('wechat/wechat_index')}}">公众号粉丝列表</a><br />
                <a href="{{url('wechat/create_label')}}">添加标签</a>
            </h1>
        </caption>
        <tr>
            <td>标签ID</td>
            <td>标签名</td>
            <td>此标签下粉丝数</td>
            <td>备注</td>
            <td>操作1</td>
            <td>操作2</td>
            <td>操作3</td>
        </tr>
    @foreach($re as $v)
        <tr>
            <td>{{$v['id']}}</td>
            <td>{{$v['name']}}</td>
            <td>{{$v['count']}}</td>
            <td>
                @if($v['id']==1)
                不能删除或编辑系统默认保留的标签
                @elseif($v['id']==2)
                不能删除或编辑系统默认保留的标签
                @elseif($v['id']==0)
                不能删除或编辑系统默认保留的标签
                @else
                    <a href="{{url('wechat/del_label')}}?id={{$v['id']}}" class="delete">删除</a>||
                    <a href="{{url('wechat/update_label')}}?data={{$v['name']}}.{{$v['id']}}">编辑</a>
                @endif


                
            </td>
            <td>
                @if($v['count']==0)
                该标签下还没有粉丝
                @else
                    <a href="{{url('wechat/label_user_list')}}?id={{$v['id']}}">该标签下粉丝列表</a>
                @endif
                
            </td>
            <td>
                @if($v['id']==0)
                没有权限
                @elseif($v['id']==1)
                没有权限
                @elseif($v['id']==2)
                没有权限
                @else
                <a href="{{url('wechat/get_list')}}?id={{$v['id']}}&count={{$v['count']}}">为粉丝打标签</a>
                @endif
            </td>
            <td>
                @if($v['count']==0)
                该标签下没有粉丝无法推送
                @else
                <a href="{{url('wechat/push_info')}}?id={{$v['id']}}">推送消息</a>
                @endif
            </td>
        </tr>
    @endforeach
    </table>

    <script>
        $(function(){
            $('.delete').click(function(){
                var _this=$(this);
                var res=confirm('是否确认删除');
               if(res==false){
                    return false;
               }
            });
        });
    </script>
</body>
</html>