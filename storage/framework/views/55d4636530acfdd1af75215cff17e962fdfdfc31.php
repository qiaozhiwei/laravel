<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>聊天室</title>
    <script src="/1.js"></script>
</head>
<body>
<b id="state" kk="<?php echo e($state); ?>"></b>
<b id="user_name" kk="<?php echo e($user_name); ?>"></b>
    <div style="background-color:gray;width:1000px;height:600px;float:left;">
    <img src="http://www.laravel.com/storage/wechat_img_DB-Tk2I_YfGh1sxAeL-nCBruJmV4Ksokb_IvOjJ3dUY5Gey5Tdq-RZPkzuWvHekz.jpg" width="1000px;">
    </div>
    <div style="background-color:#F5F5F5;width:500px;height:600px;float:left">
        <div style="margin-bottom:540px;">
        <b style="margin-left:20px;" id="b">
            
        </b>
        </div>
        <div style="margin-left:10px;margin-bottom:10px;">
            <input type="text" style="float:left" id="value">
            <button>发送</button>
        </div>
    </div>
    <script>

    
        if(window.WebSocket){
            var ws=new WebSocket("ws://123.57.18.167:9502");
            var state=$("#state").attr('kk');
            var user_name=$("#user_name").attr('kk');
            // console.log(state,user_name);
            

            ws.onopen=function(even){
                var a=state+"/"+user_name;
                var str='{"type":"login","data":"'+a+'"}';
                // console.log(str);
                ws.send(str);
                // console.log(even);

            }

            ws.onmessage=function(even){
                // console.log(even.data);
                var data=even.data;
                $("#b").append(data);
                
            }

            $(document).on('click','button',function(){
                var value=$("#value").val();
                // console.log(value);
                var str='{"type":"talk","data":"'+value+'"}';

                ws.send(str);

            });

        }
        

    </script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/live/chat.blade.php ENDPATH**/ ?>