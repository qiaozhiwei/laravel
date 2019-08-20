<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>layout 后台大布局 - Layui</title>
  <link rel="stylesheet" href="/layui/css/layui.css">
	<link rel="stylesheet" href="/css/page.css">
  <script src="/1.js"></script>

</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
          贤心
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;">商品管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('Goods/add')); ?>">添加商品</a></dd>
            <dd><a href="<?php echo e(url('Goods/index')); ?>">商品列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item ">
          <a class="" href="javascript:;">用户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('User/add')); ?>">添加用户</a></dd>
            <dd><a href="<?php echo e(url('User/index')); ?>">用户列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item ">
          <a class="" href="javascript:;">票据管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('bank/add')); ?>">添加票据</a></dd>
            <dd><a href="<?php echo e(url('bank/index')); ?>">票据列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item ">
          <a class="" href="javascript:;">竞猜管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('cai/add')); ?>">添加竞猜</a></dd>
            <dd><a href="<?php echo e(url('cai/index')); ?>">竞猜列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item ">
          <a class="" href="javascript:;">试卷管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('test/add')); ?>">添加试卷</a></dd>
            <dd><a href="<?php echo e(url('test/index')); ?>">试卷列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item ">
          <a class="" href="javascript:;">调研管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('in/create')); ?>">添加调研</a></dd>
            <dd><a href="<?php echo e(url('in/add')); ?>">添加调研问题</a></dd>
            <dd><a href="<?php echo e(url('in/index')); ?>">调研列表</a></dd>
          </dl>
        </li>
        
        <li class="layui-nav-item ">
          <a class="" href="javascript:;">物业管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('property/create')); ?>">添加车位</a></dd>
            <dd><a href="<?php echo e(url('property/list')); ?>">数据统计</a></dd>
            <dd><a href="<?php echo e(url('property/add')); ?>">添加门卫</a></dd>
            <dd><a href="<?php echo e(url('property/login')); ?>">门卫登录</a></dd>
          </dl>
        </li>


        <li class="layui-nav-item ">
          <a class="" href="javascript:;">查看地址</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('real/index')); ?>">查看地址</a></dd>
          </dl>
        </li>


        <li class="layui-nav-item ">
          <a class="" href="javascript:;">新闻管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('news/add')); ?>">新闻添加</a></dd>
            <dd><a href="<?php echo e(url('news/index')); ?>">新闻列表</a></dd>
          </dl>
        </li>

        <li class="layui-nav-item ">
          <a class="" href="javascript:;">微信用户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('wechat/get_info')); ?>">微信用户添加</a></dd>
            <dd><a href="<?php echo e(url('wechat/wechat_index')); ?>">微信用户列表</a></dd>
          </dl>
        </li>


        <li class="layui-nav-item ">
          <a class="" href="javascript:;">模板管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('wechat/view_index')); ?>">模板列表</a></dd>
          </dl>
        </li>

        <li class="layui-nav-item ">
          <a class="" href="javascript:;">用户标签管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('wechat/create_label')); ?>">创建标签</a></dd>
            <dd><a href="<?php echo e(url('wechat/label_index')); ?>">标签列表</a></dd>
          </dl>
        </li>

        <li class="layui-nav-item ">
          <a class="" href="javascript:;">分销</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('distribution/index')); ?>">分销</a></dd>
          </dl>
        </li>

        <li class="layui-nav-item ">
          <a class="" href="javascript:;">菜单管理</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('wechat/menu_add')); ?>">添加菜单</a></dd>
            <dd><a href="<?php echo e(url('wechat/menu_index')); ?>">菜单列表</a></dd>
          </dl>
        </li>


        <li class="layui-nav-item ">
          <a class="" href="javascript:;">表白</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('express/add')); ?>">添加表白</a></dd>
            <dd><a href="<?php echo e(url('express/index')); ?>">用户列表</a></dd>
          </dl>
        </li>

        <li class="layui-nav-item ">
          <a class="" href="javascript:;">留言</a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo e(url('text/index')); ?>">粉丝列表</a></dd>
          </dl>
        </li>

      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
        <?php $__env->startSection('body'); ?>
        后台主页
        <?php echo $__env->yieldSection(); ?>
    </div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<script src="/layui/layui.js"></script>
<?php $__env->startSection('js'); ?>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
<?php echo $__env->yieldSection(); ?>
</script>
</body>
</html><?php /**PATH C:\wnmp\www\laravel\resources\views/layout/goodsparent.blade.php ENDPATH**/ ?>