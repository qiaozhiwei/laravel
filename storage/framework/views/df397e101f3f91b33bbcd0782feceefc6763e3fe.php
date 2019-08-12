<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php $__env->startSection('body'); ?>
<form class="layui-form" action="<?php echo e(url('Goods/doadd')); ?>" method="post" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
  <div class="layui-form-item">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_name" required  lay-verify="required" placeholder="请输入商品名称" autocomplete="off" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">商品图片</label>
    <div class="layui-input-inline">
      <input type="file" name="goods_pic" required   autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">价格</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_price" required  lay-verify="required" placeholder="请输入商品价格" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">库存</label>
    <div class="layui-input-inline">
      <input type="text" name="number" required  lay-verify="required" placeholder="请输入商品库存" autocomplete="off" class="layui-input">
    </div>
  </div>


  <div class="layui-form-item">
    <label class="layui-form-label">是否新品</label>
    <div class="layui-input-block">
      <input type="radio" name="is_new" value="1" title="是">
      <input type="radio" name="is_new" value="2" title="不是">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">是否热卖</label>
    <div class="layui-input-block">
      <input type="radio" name="is_hot" value="1" title="是">
      <input type="radio" name="is_hot" value="2" title="不是">
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <input type="submit" class="layui-btn" value="立即提交">
      <input type="reset" class="layui-btn layui-btn-primary" value="重置">
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form;
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});
</script>
<?php $__env->stopSection(); ?>
</body>
</html>
<?php echo $__env->make('layout.goodsparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/add.blade.php ENDPATH**/ ?>