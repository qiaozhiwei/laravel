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
            <td>试卷名称</td>
            <td>试卷名类型及答案</td>
        </tr>
        <tr>
            <td>{{$data['id']}}</td>
            <td>{{$data['name']}}</td>
            <td>
                {{$arr}}
            </td>
        </tr>
        <caption>
            
        </caption>
    </table>
</body>
</html>