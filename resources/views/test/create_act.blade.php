<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/1.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('act/docreate_act')}}" method="post">
        <table align="center">
            <tr>
                <td>活动：</td>
                <td>
                    <input type="text" name="act_name">
                </td>
            </tr>
            <tr>
                <td>活动集合时间：</td>
                <td>
                    <input type="text" name="time_test" id="time_test">
                </td>
               
            </tr>
            <tr>
                <td>活动报名结束时间：</td>
                <td>
                    <input type="text" name="time_end" id="time_end">
                </td>
            </tr>
            <tr>
                <td>活动经费：</td>
                <td>
                    <input type="text" name="money">
                </td>
            </tr>
            <tr>
                <td>活动介绍：</td>
                <td>
                    <textarea name="desc"></textarea>
                </td>
            </tr>
            <tr>
                <td>活动参与人数：</td>
                <td>
                    <input type="text" name="total_people">
                </td>
            </tr>
            <tr>
                <td><input type="submit" id="submit" value="提交"></td>
            </tr>
        </table>
    </form>
    <script>
        $("#submit").click(function(){
            var time_test=$("#time_test").val();
            var time_end=$("#time_end").val();
            // console.log(time_end);
            if(time_test<time_end){
                alert("活动报名结束时间需要小于集合时间");
                return false;
            }
        });
    </script>
</body>
</html>