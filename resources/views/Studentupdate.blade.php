<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('StudentController/doupdate')}}" method="get">
    <input type="hidden" name="id" value="{{$data->id}}">
        <table border=1 align="center">
            <tr>
                <td>
                    姓名<input type="text" name="name" value="{{$data->name}}">
                </td>
            </tr>
            <tr>
                <td>
                    年龄<input type="text" name="age" value="{{$data->age}}">
                </td>
            </tr>
            <tr>
                <td>
                    ext<input type="text" name="ext" value="{{$data->ext}}">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="修改">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>