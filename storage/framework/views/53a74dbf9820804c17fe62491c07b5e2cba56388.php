<?php $__env->startSection('body'); ?>
<form action="<?php echo e(url('bank/index')); ?>" method="get">
    <p>
        出发地:<input type="text" name="start" value="<?php echo e($start); ?>">
        目的地:<input type="text" name="end" value="<?php echo e($end); ?>">
        <input type="submit" value="搜索">
    </p>
</form>
<table class="layui-table">
 <caption>
    <h3>
      您搜索了<?php echo e($num); ?>次
    </h3>
 </caption>
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>车次</th>
      <th>出发地</th>
      <th>目的地</th>
      <th>价钱</th>
      <th>票数</th>
      <th>出发时间</th>
      <th>到达时间</th>
      <th>备注</th>
    </tr> 
  </thead>
  <tbody>
      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($item->train); ?></td>
      <td><?php echo e($item->start); ?></td>
      <td><?php echo e($item->end); ?></td>
      <td><?php echo e($item->price); ?></td>
      <td>
          <?php if($item->number>=100): ?>
          有
          <?php elseif($item->number==0): ?>
          无
          <?php else: ?>
          <?php echo e($item->number); ?>

          <?php endif; ?>
      </td>
      <td><?php echo e(date("Y-m-d H:i:s",$item->start_time)); ?></td>
      <td><?php echo e(date("Y-m-d H:i:s",$item->end_time)); ?></td>
      <td>
       <?php if($item->number==0): ?>
        无票
        <?php else: ?>
        <a href="javascript:;">预约</a>
        <?php endif; ?>       
      </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
<tr>
    <td>
    <?php echo e($data->appends(['start' => "$start",'end'=>"$end"])->links()); ?>

    </td>
</tr>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.goodsparent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/bank_index.blade.php ENDPATH**/ ?>