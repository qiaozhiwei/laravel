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
        <table id="table" align="center">
           <caption>
                <h1>APP模拟请求器</h1>
           </caption>
            <tr>
                <td>
                    请求地址：<input type="text" id="url">
                </td>
            </tr>
            <tr>
                <td>
                    请求方式：<input type="radio" value="1" class="radio" name="method">POST
                            <input type="radio" value="2" class="radio" name="method">GET
                </td>
            </tr>
                <tbody id="tbody" >
                <tr>
                        <td>
                            参数名称：<input type="text" class="can">参数值：<input type="text" class="can"><button class="button">+</button>
                        </td>
                    </tr>
                    </tbody>
                
            <tr>
                <td>
                    <input id="submit" type="submit" value="提交">
                </td>
            </tr>
        </table>


        <script>
            $(document).on('click','.button',function(){
                var _this=$(this);
                var tr=_this.parents('tr');
                console.log(tr);return false;
                $('#a').append(tr);
                return false;
            });

            $('#submit').click(function(){
                var radio=$('.radio');
                // console.log(radio);return false;
                var method="";
                radio.each(function(){
                    var c=$(this).val();
                    // console.log(c);
                    if(c==1){
                        method ="POST";
                    }else{
                        method ="GET";
                    }
                });
                // console.log(method);
                // return false;
                var url=$('#url').val();
                // console.log(url);return false;
                // alert(111);
                var input=$('.can');
                // console.log(input);
                var array=new Array();
                input.each(function(){
                    var value=$(this).val();
                    // console.log(value);
                    array.push(value);
                    
                });
                // console.log(array);
                // return false;
                $.post(
                    url,
                    {arr:array,method:method},
                    function(res){
                        console.log(res);
                    }
                );
                
            });
        </script>
</body>
</html>