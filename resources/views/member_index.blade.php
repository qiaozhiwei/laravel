<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <script src="/1.js"></script>
    <title>Document</title>
</head>
<body style="margin-top:5%;margin-left:20%;margin-right:20%;">
    <table align="center" id="table" border=1 class="table table-striped table-bordered" >
    <h1 style="margin-left:43%;margin-bottom:5%">会员列表</h1>
    <caption style="margin-left:28%;">
    <form>
                名字：<input type="text" name="name" id="sr_name" placeholder="按名字搜索">
                电话：<input type="text" name="tel" id="sr_tel" placeholder="按电话搜索">
                <button id="yiku" class="btn btn-default" type="submit">搜索</button>
    </form>
   
    </caption>
        <tr>
            <td>ID</td>
            <td>会员名</td>
            <td>手机</td>
            <td>操作</td>
        </tr>
        
    </table>
    <tbody>
    <div  align="center">
        
<nav aria-label="Page navigation">
  <ul class="pagination">
    <li  id="tbody"></li>
  </ul>
</nav>
        
    </div>
    </tbody>
    <script>
        $(function(){
            //分页
            $(document).on('click','.page',function(){
                var name=$('#sr_name').val();
                var tel=$('#sr_tel').val();
                var arr=new Array();
                var _this=$(this);
                var page=_this.attr('page_num');
                // alert(page);
                $.get(
                    "{{url('/ziyuan')}}",
                    {name:name,tel:tel,page:page},
                    function(res){
                        // console.log(res);
                        if(res.code==200){
                            $.each(res.data.data,function(k,v){
                                // console.log(v);
                            var trs='<caption style="margin-left:28%;">名字：<input type="text" name="name" id="sr_name" value="'+name+'"><br />电话：<input type="text" name="tel" id="sr_tel" value="'+tel+'"><br /><button id="yiku">搜索</button></caption><tr class="tr" id="'+v.id+'"><td>'+v.id+'</td><td>'+v.name+'</td><td>'+v.tel+'</td><td><a href="javascript:;" class="del">删除</a>|<a href="javascript:;" class="update">修改</a></td></tr>';                                
                            // console.log(trs);
                            // $('tbody').hide();
                            // table.append(trs)
                            arr.push(trs);
                            });
                            table.html(arr);
                        }
                    },
                    'json'       
                );
            });

            //搜索
            
            $(document).on('click','#yiku',function(){
                var name=$('#sr_name').val();
                var tel=$('#sr_tel').val();
                // console.log(name);
                // console.log(tel);
                var arr=new Array();

                $.get(
                    "{{url('/ziyuan')}}",
                    {name:name,tel:tel},
                    function(res){
                        if(res.code==200){
                            // console.log(res);return false;
                            $.each(res.data.data,function(k,v){
                                // console.log(v);
                                var trs='<caption style="margin-left:28%;">名字：<input type="text" name="name" id="sr_name" value="'+name+'"><br />电话：<input type="text" name="tel" id="sr_tel" value="'+tel+'"><br /><button id="yiku">搜索</button></caption><tr class="tr" id="'+v.id+'"><td>'+v.id+'</td><td>'+v.name+'</td><td>'+v.tel+'</td><td><a href="javascript:;" class="del">删除</a>|<a href="javascript:;" class="update">修改</a></td></tr>';                                                            
                            // console.log(trs);
                            // $('tbody').hide();
                            arr.push(trs);
                            });
                            $('#tbody').empty();
                            for(var i=1;i<=res.data.last_page;i++){
                            // console.log(i);
                            var a="<a href='javascript:;' class='page' page_num="+i+">"+i+"</a>";
                            // console.log(a);
                            
                            $('#tbody').append(a);
                        }
                        // $('#tbody').empty();
                            table.html(arr);
                        }
                    },
                    'json',
                );
                return false;
            });
            var name=$('#sr_name').val();
                var tel=$('#sr_tel').val();
            var tr=$('.tr');
            var table=$('#table');
            // console.log(tr);
            $.get(
                "{{url('/ziyuan')}}",
                {name:name,tel:tel},
                function(res){
                    // console.log(res);return false;
                    if(res.code==200){
                        $.each(res.data.data,function(k,v){
                            // console.log(v);return false;
                            var trs='<tr class="tr" id="'+v.id+'"><td>'+v.id+'</td><td>'+v.name+'</td><td>'+v.tel+'</td><td><a href="javascript:;" class="del">删除</a>|<a href="javascript:;" class="update">修改</a></td></tr>';
                            // console.log(trs);
                            table.append(trs);
                        })
                        for(var i=1;i<=res.data.last_page;i++){
                            // console.log(i);
                            var a="<a href='javascript:;' class='page' page_num="+i+">"+i+"</a>";
                            // console.log(a);
                            $('#tbody').append(a);
                        }
                        
                    }else{
                        alert(res.msg);
                    }
                },
                'json',
                
            );
            
        $(document).on('click','.del',function(){
            var _this=$(this);
            var tr=_this.parents('tr');
            // console.log(tr);
            var id=tr.prop('id');
            // alert(id);
            var url="{{url('/ziyuan')}}"+'/'+id;
            // console.log(url);return false;
            $.ajax({
                url:url,
                type:'delete',
                dataType: "json",
                success:function(res){
                    if(res.code==200){
                        tr.remove();
                        // console.log(res);
                    }
                }
            })
        });

        $(document).on('click','.update',function(){
            var _this=$(this);
            // console.log(array);
            var array=new Array();
            var id=_this.parents('tr').prop('id');
            // alert(id);return false;
            $.get(
                "{{url('member/query')}}",
                {id:id},
                function(res){
                    // console.log(res);return false;
                    if(res.code==200){
                        $.each(res.data,function(k,v){
                            // console.log(v);
                            array.push(v);
                        });
                        location.href="{{url('member/update')}}?data="+array; 
                    }else{
                        alert(res.msg);
                    }
                },
                'json'
                
            );
                  
        });
            
        });
       
    </script>
</body>
</html>