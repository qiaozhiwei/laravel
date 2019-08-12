<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('wechat/do_upload_permanent')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table align="center">
            <tr>
                <td>
                    图片：<input type="file" name="img">
                </td>
            </tr>
            <tr>
                <td>
                    音频：<input type="file" name="voice">
                </td>
            </tr>
            <tr>
                <td>
                    视频：<input type="file" name="video">
                </td>
            </tr>
            <tr>
                <td>
                    缩略图：<input type="file" name="thumb">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="提交">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>