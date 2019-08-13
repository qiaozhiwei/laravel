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
            <td>代理商姓名</td>
            <td>二维码</td>
            <td>推广码</td>
            <td>备注</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->user_name}}</td>
            <td>
                @if($v->url=="")
                尚未生成
                @else
                <img src="{{$v->url}}" width="100px;" height="100px;">
                @endif
            </td>
            <td>{{$v->code}}</td>
            <td>
                @if($v->url=="")
                <a href="{{url('distribution/ticket')}}">生成该代理商的二维码</a>
                @else
                已生成二维码
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>