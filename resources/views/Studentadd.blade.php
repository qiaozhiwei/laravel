<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
       <h1 align="center">
       @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br />
                    @endforeach
        @endif
       </h1>
    <form action="{{url('StudentController/doadd')}}" method="post">
    @csrf
        <table border=1 align="center">
            <tr>
                <td>
                    姓名<input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td>
                    年龄<input type="text" name="age">
                </td>
            </tr>
            <tr>
                <td>
                性别<input type="text" name="sex">
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