<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>后台登录-X-admin2.2</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="/x-admin/css/font.css">
        <link rel="stylesheet" href="/x-admin/css/xadmin.css">
        <!-- <link rel="stylesheet" href="./css/theme5.css"> -->
        <script src="/x-admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/x-admin/js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            // 是否开启刷新记忆tab功能
            // var is_remember = false;
        </script>
    </head>
    <body class="index">
        <!-- 顶部开始 -->
        <div class="container">
            <div class="logo">
                <a href="./index.html">X-admin v2.2</a></div>
            <div class="left_open">
                <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
            </div>
            <ul class="layui-nav left fast-add" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">+新增</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('最大化','http://www.baidu.com','','',true)">
                                <i class="iconfont">&#xe6a2;</i>弹出最大化</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
                                <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
                                <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开','member-list.html')">
                                <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
                                <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav right" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">admin</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a></dd>
                        <dd>
                            <a onclick="xadmin.open('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
                        <dd>
                            <a href="./login.html">退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item to-index">
                    <a href="/">前台首页</a></li>
            </ul>
        </div>
        <!-- 顶部结束 -->
        <!-- 中部开始 -->
        <!-- 左侧菜单开始 -->
        <div class="left-nav">
            <div id="side-nav">
                <ul id="nav">
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="音乐管理">&#xe6b8;</i>
                            <cite>音乐管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('index/music_upload')}}">上传音乐素材</a>
                            </li>
                            <li>
                                <a href="{{url('index/upload')}}">上传资源到本地</a>
                            </li>
                           
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="音乐管理">&#xe6b8;</i>
                            <cite>后台轮播图管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('index/img_upload')}}">上传图片素材</a>
                            </li>
                           
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="后台分类管理">&#xe6b8;</i>
                            <cite>后台分类管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('index/cate_create')}}">添加分类</a>
                            </li>
                            <li>
                                <a href="{{url('index/cate_index')}}">分类列表</a>
                            </li>
                           
                        </ul>
                    </li>

                    
                </ul>
            </div>
        </div>
        <!-- <div class="x-slide_left"></div> -->
        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div class="page-content">
            <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
                <ul class="layui-tab-title">
                    <li class="home">
                        <i class="layui-icon">&#xe68e;</i>我的桌面</li>
                    </ul>
                    @section('right')
        
                    @show
                
                <div id="tab_show"></div>
            </div>
        </div>
        
        <!-- 右侧主体结束 -->
        <!-- 中部结束 -->
        <script>//百度统计可去掉
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

</html>