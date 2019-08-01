<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('news/doadd')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table align="center" >
            <tr>
                <td>
                    新闻标题<input type="text" name="title">
                </td>
            </tr>
            <tr>
                <td>
                    作者<input type="text" name="people">
                </td>
            </tr>
            <tr>
                <td>
                    上传图片<input type="file" name="pic" >
                </td>
            </tr>
            <tr>
                <td>
                    详细内容<textarea name="desc"></textarea>
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