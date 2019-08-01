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
    <table align="center" border=1 width="500px;" height="500px;">
       <tr align="center">
            <td>
                <h1>我要竞猜</h1>

           <b>{{$name2}}VS{{$name1}}</b><br />
           <h2>
           {{$name1}}赢<input type="radio" name="is_yins" value="1">
           {{$name2}}赢<input type="radio" name="is_yins" value="2">
           平<input type="radio" name="is_yins" value="3">
           <br />
           <button class="atang">提交</button>
           </h2>
           </td>
       </tr>
       <script>
            $('.atang').click(function(){
                var array=new Array();
                var name1="{{$name1}}";
                var name2="{{$name2}}";
                // alert(name2);
                var input=$('input');
                // console.log(input);
                input.each(function(){
                    var checked=$(this).prop('checked');
                    // console.log(checked);
                    if(checked==true){
                        var value=$(this).val();  
                        // console.log(value);
                        array.push(value);
                    }
                    
                });
                // console.log(array);
                $.get(
                    "{{url('cai/docai')}}",
                    {array:array,name1:name1,name2:name2},
                    function(res){
                        // console.log(res);
                        alert(res.msg);
                        if(res.code==1){
                            location.href="{{url('cai/index')}}";
                        }
                    },
                    'json'
                );
            });
       </script>
    </table>
</body>
</html>