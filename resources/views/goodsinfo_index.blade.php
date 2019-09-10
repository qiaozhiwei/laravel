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


    <table align="center" border=1 id="table" class="table table-striped table-bordered">


    <h1 style="margin-left:43%;margin-bottom:5%">商品列表</h1>
    <caption style="margin-left:38%;">
    <input type="text" name="good_name" id="good_name" placeholder="按商品名称搜索">
    <button id="button">搜索</button>
    </caption>
        <tr>
            <td>商品名称</td>
            <td>价格</td>
            <td>图片</td>
        </tr>
       <tbody id="tbody">

       </tbody>
        
    </table>


    <div align="center">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li id="a"></li>
            </ul>
        </nav>
    </div>


    <script>
        
        var good_name=$('#good_name').val();
        if(good_name==""){
            $.get(
            "{{url('goodsinfo/getinfo')}}",
            {good_name:good_name},            
            function(res){
                // console.log(res);return false;
                if(res.code==200){
                    $.each(res.data.data,function(k,v){
                        // console.log(v);
                        var tr='<tr class="tr"><td>'+v.good_name+'</td><td>'+v.good_price+'</td><td><img src='+v.good_pic+' width="150px;" height="100px;"></td></tr>';
                        // console.log(tr);
                        
                        $('#tbody').append(tr);
                        
                    });
                    for(var i=1;i<=res.data.last_page;i++){
                        var a='<a href="javascript:;" class="page">'+i+'</a>';
                        $('#a').append(a);
                    }
                }
            },
            'json'
        );
        }else{
                        //不为空
                    $.get(
                        "{{url('goodsinfo/getinfo')}}",
                        {good_name:good_name},            
                        function(res){
                            // console.log(res);return false;
                            if(res.code==200){
                                $.each(res.data.data,function(k,v){
                                    // console.log(v);
                                    var tr='<tr class="tr"><td>'+v.good_name+'</td><td>'+v.good_price+'</td><td><img src='+v.good_pic+' width="150px;" height="100px;"></td></tr>';
                                    // console.log(tr);
                                    
                                    $('#tbody').append(tr);
                                    
                                });
                                for(var i=1;i<=res.data.last_page;i++){
                                    var a='<a href="javascript:;" class="page">'+i+'</a>';
                                    $('#a').append(a);
                                }
                            }
                        },
                        'json'
                    );
        }
        
        //搜索
        $(document).on('click','#button',function(){
            
            $('#tbody').empty();
            $('#a').empty(a);
            var good_name=$('#good_name').val();
            if(good_name==""){
                //条件为空
                $.get(
                "{{url('goodsinfo/getinfo')}}",
                {good_name:good_name},
                function(res){
                    // console.log(res);return false;
                    if(res.code==200){
                        $.each(res.data.data,function(k,v){
                        // console.log(v);return false;
                        var tr='<tr class="tr"><td>'+v.good_name+'</td><td>'+v.good_price+'</td><td><img src='+v.good_pic+' width="150px;" height="100px;"></td></tr>';
                        // console.log(tr);
                        $('#tbody').append(tr);
                    });
                    for(var i=1;i<=res.data.last_page;i++){
                        var a='<a href="javascript:;" class="page">'+i+'</a>';
                        $('#a').append(a);
                    }
                    }
                },
                'json'
            );
            }else{
                        //条件不为空
                        $.get(
                            "{{url('goodsinfo/getinfo')}}",
                            {good_name:good_name},
                            function(res){
                                // console.log(res);return false;s
                                if(res.code==200){
                                    $.each(res.data.data,function(k,v){
                                    // console.log(v);return false;
                                    var tr='<tr class="tr"><td>'+v.good_name+'</td><td>'+v.good_price+'</td><td><img src='+v.good_pic+' width="150px;" height="100px;"></td></tr>';
                                    // console.log(tr);
                                    $('#tbody').append(tr);
                                });
                                for(var i=1;i<=res.data.last_page;i++){
                                    var a='<a href="javascript:;" class="page">'+i+'</a>';
                                    $('#a').append(a);
                                }
                                }
                            },
                            'json'
                        );
            }
            
        });
        //分页
        $(document).on('click','.page',function(){
            $('#tbody').empty();
            $('#a').empty(a);
            var _this=$(this);
            var page=_this.text()
            var good_name=$('#good_name').val();
            if(good_name==""){
                $.get(
                "{{url('goodsinfo/getinfo')}}",
                {page:page,good_name:good_name},
                function(res){
                    // console.log(res);
                    if(res.code==200){
                        $.each(res.data.data,function(k,v){
                        // console.log(v);return false;
                        var tr='<tr class="tr"><td>'+v.good_name+'</td><td>'+v.good_price+'</td><td><img src='+v.good_pic+' width="150px;" height="100px;"></td></tr>';
                        // console.log(tr);
                        $('#tbody').append(tr);
                    });

                    for(var i=1;i<=res.data.last_page;i++){
                        var a='<a href="javascript:;" class="page">'+i+'</a>';
                        $('#a').append(a);
                    }
                    }
                },
                'json'       
            );
            }else{
                        //不为空
                    // alert(page);
                    $.get(
                        "{{url('goodsinfo/getinfo')}}",
                        {page:page,good_name:good_name},
                        function(res){
                            // console.log(res);
                            if(res.code==200){
                                $.each(res.data.data,function(k,v){
                                // console.log(v);return false;
                                var tr='<tr class="tr"><td>'+v.good_name+'</td><td>'+v.good_price+'</td><td><img src='+v.good_pic+' width="150px;" height="100px;"></td></tr>';
                                // console.log(tr);
                                $('#tbody').append(tr);
                            });

                            for(var i=1;i<=res.data.last_page;i++){
                                var a='<a href="javascript:;" class="page">'+i+'</a>';
                                $('#a').append(a);
                            }
                            }
                        },
                        'json'       
                    );
            }
            
        });
    </script>
</body>
</html>