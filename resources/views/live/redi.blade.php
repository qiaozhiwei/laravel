<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YYFC</title>
</head>
<body>
<center>
    @if($state==1)
    <a href="{{url('live_user/team_match')}}">查看比赛结详情</a>
    <a href="{{url('live_user/choose_first')}}">解说比赛</a>
    @elseif($state==2)
    <a href="{{url('live_user/team_match')}}">查看比赛结详情</a>
    <a href="{{url('live_user/choose_first')}}">解说比赛</a>
    @endif
</center>
</body>
</html>