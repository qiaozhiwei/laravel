<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center">
        <tr>
            <td>
                <h1>车辆管理系统</h1>
                
            </td>
        </tr>
        <tr>
            <td>
                <h2>小区车位：{{$parking_num}}</h2>
                <h2>剩余车位：{{$parking_num}}</h2>
            </td>
        </tr>
        <tr>
            <td>
            <h2>
                    <a href="{{url('property/car_index')}}">车辆离开</a>
                </h2>
            </td>
        </tr>
    </table>
</body>
</html>