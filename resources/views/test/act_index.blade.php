<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>活动列表</title>
</head>
<body>
        <table style="background-color:#DDDDDD" align="center" border=2>
        <center>
            <h1>
                <a href="{{url('act/sign_list')}}">参与人列表</a>
            </h1>
        </center>
            <tr>
                <td>活动名称</td>
                <td>集合时间</td>
                <td>报名结束时间</td>
                <td>活动经费</td>
                <td>活动简介</td>
                <td>活动剩余可参数人数</td>
                <td>备注</td>
            </tr>
            @foreach($info as $k=>$v)
            <tr>
                <td>{{$v->act_name}}</td>
                <td>{{date("Y-m-d H:i:s",$v->time_test)}}</td>
                <td>{{date("Y-m-d H:i:s",$v->time_end)}}</td>
                <td>{{$v->money}}</td>
                <td>{{$v->desc}}</td>
                <td>{{$v->total_people-$v->exis_num}}</td>
                <td>
                    @if($v->time_end<=$time)
                    报名已结束
                    @elseif($v->total_people-$v->exis_num==0)
                    该活动已无名额
                    @else
                    <a href="{{url('act/sign')}}?a_id={{$v->act_id}}">报名</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
</body>
</html>