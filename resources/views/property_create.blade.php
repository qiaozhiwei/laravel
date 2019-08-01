<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('property/docreate')}}" method="post">
    @csrf
    <table align="center">

        <tr>
            <td>
                数量：<input type="text" name="parking_num">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="添加">
            </td>
        </tr>
    </form>
    </table>
</body>
</html>