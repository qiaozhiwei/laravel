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
    <table align="center">
        <tr>
            <td>队伍</td>
            <td>
                操作
            </td>
        </tr>
        @foreach($team_info as $k=>$v)
        <tr>
            <td>{{$v}}</td>
            <td><input class="team" type="checkbox" team="{{$v}}"></td>
        </tr>
        @endforeach
        <tr>
            <td><button id="team">下一步</button></td>
        </tr>
    </table>

    

    <script>
        $("#team").click(function(){
            var _this=$(this);
            var arr=new Array();
            var team=$(".team");
            // console.log(team);
            team.each(function(){
                var checked=$(this).prop("checked");
                // console.log(checked);
                if(checked==true){
                    var team_name=$(this).attr('team');
                    arr.push(team_name);
                }
            });
            // console.log(arr);
            // location.href="{{url('wechat/push_two')}}?array="+array;
            var url="{{url('live_user/choose_player')}}?arr="+arr;
            location.href=url;
            return false;
        });
    </script>
</body>
</html>