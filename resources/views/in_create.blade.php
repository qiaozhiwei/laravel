<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/1.js"></script>
</head>
<body>
    <form action="{{url('in/docreate')}}" method="post">
    @csrf
        <table  align="center" border=1>
            <tr>
                <td>项目
                    <input type="text" name="name" id="name">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="添加" class="submit">
                </td>
            </tr>



            <tr>
                <td>问题类型</td>
                <td>问题</td>
                <td>答案</td>   
                <td>备注</td>
            </tr>

            @foreach($data as $item)
                <tr q_id="{{$item->q_id}}" class="tr">
                    <td>{{$item->type}}</td>
                    <td>{{$item->question}}</td>
                    <td>{{$item->answer}}</td>
                    <td>
                        <input type="checkbox" >
                    </td>
                </tr>
            @endforeach
        </table>
    </form>

    <script>
        $('.submit').click(function(){
            var array=new Array();
            var name=$('#name').val();
            // alert(name);
            var tr=$('.tr');
            tr.each(function(){
                var q_id=$(this).attr('q_id');
                // console.log(q_id);
                var checked=$(this).find('input').prop('checked');
                // console.log(checked);
                if(checked==true){
                    // console.log(q_id);
                    array.push(q_id);
                }
            });
            // console.log(array);
            $.get(
                "{{url('in/docreate')}}",
                {array:array,name:name},
                function(res){
                    // console.log(res);
                    alert(res.msg);
                    if(res.code==1){
                        location.href="{{url('in/index')}}";
                    }
                },
                'json'
            );
            return false;
        });
    </script>
</body>
</html>