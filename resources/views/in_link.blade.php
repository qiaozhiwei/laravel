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
            <td>项目名称</td>
            <td>问题类型</td>
            <td>问题</td>
            <td>答案</td>
            <td>项目添加时间</td>
        </tr>

        <tr>
            <td>{{$data['name']}}</td>
            <td>{{$arr['type']}}</td>
            <td>{{$arr['question']}}</td>
            <td>{{$arr['answer']}}</td>
            <td>{{date("Y-m-d H:i:s",$data['add_time'])}}</td>
        </tr>
    </table>
</body>
</html>