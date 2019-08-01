<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/1.js"></script>
    <title>竞猜列表</title>
</head>
<body>
    <table border=1 align="center">
        <caption>
            <h1>
                <a href="{{url('cai/add')}}">添加竞猜</a>
            </h1>
            <h2>竞猜列表</h2>
            
        </caption>
        <tr>
            <td>ID</td>
            <td>队伍2</td>
            <td>备注</td>
            <td>队伍1</td>
            <td>竞猜结束时间</td>
        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$item->c_id}}</td>
            <td file="name2">{{$item->name2}}</td>
            <td>
                @if($time<$item->c_time)
                <button class="a">我要竞猜</button>
                @elseif($time>$item->c_time)
                <button class="b">查看比赛结果</button><br />
                <button class="c">查看竞猜结果</button>
                @else
                正在比赛
                @endif
            </td>
            <td file="name1">{{$item->name1}}</td>
            <td>{{date("m-d H:i",$item->c_time)}}</td>
        </tr>
        @endforeach
    </table>


    <script>
        $(function(){
            //我要竞猜
            $('.a').click(function(){
                var _this=$(this);
                // console.log(_this);
                var name2=_this.parent('td').prev().text();
                // alert(name2);
                var name1=_this.parent('td').next().text();
                // alert(name1);
                var name= new Array();
                // console.log(name);
                name.push(name1,name2);
                // console.log(name);
                location.href="{{url('cai/cai')}}?name="+name;
            });
            //查看比赛结果
            $('.b').click(function(){
                var _this=$(this);
                var name2=_this.parent('td').prev().text();
                // alert(name2);return false;
                var name1=_this.parent('td').next().text();
                // alert(name1);
                var array=new Array();
                array.push(name1,name2);
                // console.log(array);return false;
               location.href="{{url('cai/exam')}}?array="+array;

            });
            $('.c').click(function(){
                var _this=$(this);
                var name2=_this.parent('td').prev().text();
                // alert(name2);return false;
                var name1=_this.parent('td').next().text();
                // alert(name1);
                var array=new Array();
                array.push(name1,name2);
                // console.log(array);
                location.href="{{url('cai/list')}}?array="+array;
            });
        });
    </script>
</body>
</html>