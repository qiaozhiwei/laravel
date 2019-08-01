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
                <h1>新闻详情页</h1>
            </td>
        </tr>
        <tr>
            <td>
                作者：{{$data->people}}
            </td>
        </tr>
        <tr>
            <td>
                访问量：{{$num}}
            </td>
        </tr>
        <tr>
            <td>
                详细内容：{{$data->desc}}
            </td>
        </tr>
    </table>
</body>
</html>