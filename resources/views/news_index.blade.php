<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center" border=1>
        <tr>
            <td>ID</td>
            <td>新闻标题</td>
            <td>作者</td>
            <td>添加时间</td>
            <td>新闻图片</td>
            <td>备注</td>
            <td>操作</td>
        </tr>
            @foreach($data as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->people}}</td>
            <td>{{date('Y-m-d H:i:s'),$item->add_time}}</td>
            <td>
                <img src="{{$item->pic}}" width="100px;" height="100px;">
            </td>
            <td>
                <a href="{{url('news/delete')}}?id={{$item->id}}">删除</a>
            </td>
            <td>
                <a href="{{url('news/pro')}}?id={{$item->id}}">详情</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6">
                {{ $data->links() }}
            </td>
            
        </tr>
    </table>
</body>
</html>