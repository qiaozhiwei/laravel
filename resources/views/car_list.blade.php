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
        <h1>车库列表</h1>
    </caption>
        <tr>
            <td>车辆名称</td>
            <td>车牌号</td>
            <td>进库时间</td>
            <td>备注</td>
        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$item->car_name}}</td>
            <td>{{$item->car_number}}</td>
            <td>{{date('Y-m H:i',$item->add_time)}}</td>
            <td>
                <a href="{{url('property/unsetcar')}}?id={{$item->id}}">车辆出库</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>