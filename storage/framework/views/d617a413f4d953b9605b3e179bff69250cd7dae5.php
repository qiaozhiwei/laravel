<?php $__env->startSection('pages_section'); ?>
<table align="center" border=1>
	<tr>
		<td>订单号</td>
		<td>订单状态</td>
		<td>收货人姓名</td>
		<td>收货人邮件</td>
		<td>收货人电话</td>
		<td>操作</td>
	</tr>
	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td><?php echo e($item->oid); ?></td>
		<td>
			<?php if($item->state==1): ?>
			未支付
			<?php elseif($item==2): ?>
			已支付
			<?php else: ?>
			已过期
			<?php endif; ?>
		</td>
		<td><?php echo e($item->address_name); ?></td>
		<td><?php echo e($item->address_email); ?></td>
		<td><?php echo e($item->address_tel); ?></td>
		<td>
			<a href="<?php echo e(url('pay')); ?>?oid=<?php echo e($item->oid); ?>">去付款</a>
		</td>
	</tr>
	<?php $__env->startSection('footer'); ?>
	<?php $__env->stopSection(); ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.parent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/order_indexs.blade.php ENDPATH**/ ?>