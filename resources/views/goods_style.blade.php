<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/1.js"></script>
    <title>Document</title>
</head>
<body>
    <form action="{{url('goods/dostyle')}}" method="post">
        <table align="center">
            <tr>
                <td>
                   类型：<select name="type_name">
                       @foreach($data as $v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                       @endforeach
                   </select>
                </td>
            </tr>
            <tr>
                <td>
                    属性：<input type="text" name="name">
                </td>
            </tr>
            <tr>
                    <td>
                        是否可选：<input type="radio" name="is_radio" value="1">是
                                <input type="radio" name="is_radio" value="2">否
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