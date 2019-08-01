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
            <td>试卷名称</td>
            <td>备注</td>
        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>
                <a href="{{url('test/pro')}}?id={{$item->id}}">详情</a>
            </td>
        </tr>
        @endforeach

       
    </table>
    
</body>
</html>