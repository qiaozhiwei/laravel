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
    <form action="{{url('StudentController/index')}}">
        <caption>
            <input type="text" name="search" value="{{$search}}">
                <input type="submit" value="搜索">
        </caption>
        
    </form>
        <tr>
                <td>ID</td>
                <td>姓名</td>
                <td>年龄</td>
                <td>性别</td>
                <td>添加时间</td>
                <td>操作</td>
          </tr> 
        @foreach($student as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->age}}</td>
                <td>{{$item->sex}}</td>
                <td>{{date("Y-m-d H:m:s",$item->create_time)}}</td>
                <td>
                    <a href="{{url('StudentController/delete')}}?id={{$item->id}}">删除</a>
                    <a href="{{url('StudentController/update')}}?id={{$item->id}}">修改</a>
                </td>
            </tr>
        @endforeach
        <tr>
            <td>{{ $student->appends(['search' =>"$search"])->links() }}</td>
        </tr>
    </table>
</body>
</html>