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
    <form>
   
        <table align="center">
        <tr class="tr">
                <td>
                    题库名称:
                    <input type="text" name="name" id="text">
                </td>
            </tr>
            
            <tr class="tr">
                <td>
                    <select name="select" class="a" id="yiku">
                        <option value="0">请选择</option>
                        <option value="1">单选</option>
                        <option value="2">多选</option>
                        <option value="3">判断</option>
                    </select>
                </td>
            </tr>

        <!-- 单选 -->
            <tr style="display:none" id="radio" class="tr">
                <td>
                    laravel框架定义中间件的关键字是<br />
                    <input type="radio" name="k" value="middleware">A:&nbsp;&nbsp;middleware<br />
                    <input type="radio" name="k" value="controller">B:&nbsp;&nbsp;controller<br />
                    <input type="radio" name="k" value="model">C:&nbsp;&nbsp;model<br />
                    <input type="radio" name="k" value="migration">D:&nbsp;&nbsp;migration
                </td>
            </tr>

        <!-- 多选 -->   
            <tr style="display:none" id="checkbox" class="tr">
                <td>
                    面向对象的特征是<br />
                    <input type="checkbox" name="b[]"  value="封装">A:&nbsp;&nbsp;封装<br />
                    <input type="checkbox" name="b[]"  value="继承">B:&nbsp;&nbsp;继承<br />
                    <input type="checkbox" name="b[]"  value="多态">C:&nbsp;&nbsp;多态<br />
                    <input type="checkbox" name="b[]"  value="抽象">D:&nbsp;&nbsp;抽象<br />
                </td>
            </tr>

        <!-- 判断 -->

            <tr style="display:none" id="panduan" class="tr">
                <td>
                    laravel只能使用composer安装<br />
                    正确<input type="radio" name="c"  value="正确">
                    错误<input type="radio" name="c"  value="错误">
                </td>
            </tr>
           


            <tr>
                <td>
                    <input type="submit" value="添加" class="submit">
                </td>
            </tr>
        </table>
    </form>



    <script>
        $('.a').change(function(){
            var _this=$(this);  
            var value=_this.val();
            // alert(value);return false;
            if(value==0){
                $('#radio').css('display','none');
                $('#checkbox').css('display','none');
                $('#panduan').css('display','none');
            }else if(value==1){
                //单选
                $('#radio').css('display','block');
                $('#checkbox').css('display','none');
                $('#panduan').css('display','none');
            }else if(value==2){
                //多选
                $('#checkbox').css('display','block');
                $('#radio').css('display','none');
                $('#panduan').css('display','none');
            }else if(value==3){
                //判断
                $('#panduan').css('display','block');
                $('#checkbox').css('display','none');
                $('#radio').css('display','none');

            }
            
            
        });
        $('.submit').click(function(){
            var block=new Array();
            var tr=$('.tr');
            // console.log(tr);
            tr.each(function(){
                if($(this).css("display")=="block"){
                    var input=$(this).find('input');
                    // console.log(input);
                    input.each(function(){
                        var _this=$(this);
                        var checked=$(this).prop('checked');
                        // console.log(checked);
                        if(checked==true){
                            var value=_this.val();
                            // console.log(value);
                             block.push(value);
                        }
                        
                    });
                }
            });
            // console.log(block);
            var name=$('#text').val();
            var select=$('#yiku').val();
            // alert(select);
            // alert(name);
            $.get(
                "{{url('test/doadd')}}",
                {name:name,select:select,block:block},
                function(res){
                    // console.log(res);
                    if(res.code==1){
                        alert(res.msg);
                        location.href="{{url('test/index')}}";
                    }
                },
                'json'
            );
           
            return false;
        });
    </script>
</body>
</html>