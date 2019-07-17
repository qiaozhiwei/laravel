<?php $__env->startSection('body'); ?>
<form action="<?php echo e(url('Goods/index')); ?>" method="get">
<div class="layui-form-item">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-inline">
      <input type="text" value="<?php echo e($sr); ?>" name="sr" placeholder="请按商品名称搜索" autocomplete="off" class="layui-input">
	<input type="submit" value="搜索" class="layui-btn layui-btn-radius layui-btn-normal">
	</div>
  </div>
</form>
<h3 align="center">
您访问了<?php echo e($num); ?>次
</h3>
<table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>商品名称</th>
      <th>图片</th>
      <th>价格</th>
      <th>库存</th>
      <th>添加时间</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($item->goods_name); ?></td>
      <td>
	  	<img src="<?php echo e($item->goods_pic); ?>" width="100px;" height="100px;">
	  </td>
      <td><?php echo e($item->goods_price); ?></td>
      <td><?php echo e($item->number); ?></td>
      <td>
	  	<?php echo e(date("Y-m-d H:i:s",$item->add_time)); ?>

	  </td>
      <td>
	  	<a href="<?php echo e(url('Goods/del')); ?>?id=<?php echo e($item->id); ?>">删除</a>|
		  <a href="<?php echo e(url('Goods/update')); ?>?id=<?php echo e($item->id); ?>">修改</a>|
		  <a href="<?php echo e(url('Goods/add')); ?>">添加</a>
	  </td>
    </tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
  </tbody>
</table>
<h3 align="center">
<?php echo e($data->appends(['sr' => "$sr"])->links()); ?>

</h3>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.goodsparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/index.blade.php ENDPATH**/ ?>