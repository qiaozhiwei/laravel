<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('haoyan/docreate')}}" method="post">
    @csrf
        <table align="center">
            <tr>
                <td>
                    一级菜单：<input type="text" name="name_one">
                </td>
            </tr>
            <tr>
            <tr>
                <td>
                    二级菜单：<input type="text" name="name_two">
                </td>
            </tr>
            <tr>
                <td>
                    类型：<input type="text" name="type">
                </td>
            </tr>
            <tr>
                <td>
                    url：<input type="text" name="url" placeholder="类型为view">
                </td>
            </tr>
            <tr>
                <td>
                    key：<input type="text" name="key" placeholder="类型为click">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="添加">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>