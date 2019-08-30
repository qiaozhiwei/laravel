<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <table align="center" border=0>
    <caption>
    <form action="{{url('sign/index')}}" method="get">
        按商品名称搜索:<input type="text" name="goods_name">
        按商品价格搜索：<input type="text" name="goods_price">
        <input type="submit" value="搜索">
    </form>
    </caption>
        <tr>
            <td>goods_name</td>
            <td>goods_pic</td>
            <td>goods_price</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_pic}}</td>
            <td>{{$v->goods_price}}</td>
        </tr>
        @endforeach
        <tr>
            <td>
            {{ $data->appends(['goods_name' => "$goods_name",'goods_price'=>"$goods_price"])->links() }}
            </td>
        </tr>
    </table>
</body>
</html>