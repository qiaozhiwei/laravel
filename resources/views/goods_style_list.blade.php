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
    <form action="{{url('goods/style_list')}}" method="get">
        <table align="center">
            <tr>
                <td>
                    按属性名搜索：<input type="text" name="name">
                    <input type="submit" value="搜索">
                </td>
            </tr>
        </table>
    </form>
    <table align="center" border=1>
        <tr>
            <td><input type="checkbox" id="id">ID</td>
            <td>属性名</td>
            <td>是否可选</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr id="{{$v->id}}" class="tr">
            <td><input type="checkbox"class="id">{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>
                @if($v->is_radio==1)
                可选
                @else
                不可选
                @endif
            </td>
            <td>
                <a href="">删除</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">
            {{ $data->appends(['name' => "$name"])->links() }}
            </td>
        </tr>
        <tr>
            <td>
                <a href="javascript:;" id="del">批删</a>
                <a href="javascript:;" id="fan">反选</a>
            </td>
        </tr>
    </table>

    <script>
        $('#id').click(function(){
            // alert(111);
            var checked=$(this).prop('checked');
            // console.log(checked);
            if(checked==true){
                var check=$('.id');
                // console.log(check);
                check.each(function(){
                    var c=$(this).prop('checked');
                    // console.log(c);
                    $(this).prop('checked',true);
                });
            }else{
                var check=$('.id');
                // console.log(check);
                check.each(function(){
                    var c=$(this).prop('checked');
                    // console.log(c);
                    $(this).prop('checked',false);
                });
            }

            
            
        });


        //反选

        $('#fan').click(function(){
            var check=$('.id');
            check.each(function(){
                var checked=$(this).prop('checked');    
                // console.log(checked);
                if(checked==true){
                    $(this).prop('checked',false);
                }else{
                    $(this).prop('checked',true);
                } 
            });            
        });

        //批删
        $('#del').click(function(){
            var tr=$('.tr');
            // console.log(tr);
            var arr=new Array();
            tr.each(function(){
                var id=$(this).attr('id');
                // console.log(id);
                arr.push(id);
            });
            // console.log(arr);
            location.href="{{url('goods/del')}}?arr="+arr;
                        
        });
    </script>
</body>
</html>