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
    <caption>
        <h1>
            <a href="{{url('property/addcar')}}">车辆入库</a>
        </h1>
    </caption>
        <tr>
            <td>门卫</td>
            <td>添加时间</td>
            <td>备注</td>
        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{date('Y-m H:i',$item->add_time)}}</td>
            <td>
                <a href="{{url('property/car')}}?name={{$item->name}}">车辆管理</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>