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
    <form action="{{url('dotest')}}" method="post">
            <tr>
                <td>
                    试卷名称<input type="text" name="name" class="kkk">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="生成试卷" class="create">
                </td>
            </tr>
    </form>
    <table border=1 >
        <caption>
            <h1>
                <a href="{{url('test/add')}}">添加题库</a>
            </h1>
            
        </caption>
        <tr>
            <td>ID</td>
            <td>试题类型</td>
            <td>正确答案</td>
            <td>题库链接</td>
            <td>备注</td>
        </tr>
        @foreach($data as $item)
        <tr class="tr">
            <td>{{$item->id}}</td>
            <td id="type">@if($item->select==1)单选@elseif($item->select==2)多选@else判断@endif</td>
            <td class="daan">{{$item->value}}</td>
            <td>
                <a href="{{url('test/index')}}">{{$item->url}}</a>
            </td>
            <td>
                <input type="checkbox" >
            </td>
        </tr>
        @endforeach
    </table>

    <script>
        $(function(){
            $('.create').click(function(){
                var array=new Array();
                // console.log($(this));
                var input=$('.tr').find('input');
                // console.log(input);
                input.each(function(){
                    var checked=$(this).prop('checked');
                    // console.log(checked);
                    if(checked==true){
                        var type=$(this).parents('tr').find('td').eq(1).text();
                        // console.log(type);
                        var daan=$(this).parents('tr').find('td').eq(2).text();
                        // console.log(daan);
                        array.push(type);
                        array.push(daan);
                    }
                });      
                // console.log(array);    
                var name=$('.kkk').val();
                // alert(name);return false;
                $.get(
                    "{{url('test/dotest')}}",
                    {array:array,name:name},
                    function(res){
                        // console.log(res);
                        alert(res.msg);
                        if(res.code==1){
                            location.href="{{url('test/list')}}";
                        }
                    },
                    'json'
                );      
                return false;
            });
        });
    </script>
</body>
</html>