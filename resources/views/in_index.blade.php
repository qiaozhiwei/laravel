<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border=1 align="center">
        <tr>
            <td>ID</td>
            <td>项目名称</td>
            <td>添加时间</td>
            <td>备注</td>
            <td>
                操作
            </td>
        </tr>
    @foreach($data as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{date('Y-m-d H:i:s',$item->add_time)}}</td>
            <td>
                <a href="{{url('in/delete')}}?id={{$item->id}}">删除</a>
            </td>
            <td>
               <a href="{{url('in/links')}}?id={{$item->id}}">启用</a>
            </td>
            
        </tr>
        @endforeach
        <tr >
            <td colspan="5">
            {{ $data->links() }}
            </td>
        </tr>
    </table>
</body>
</html>