<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php $__env->startSection('pages_section'); ?>
<div class="cart section">
		<div class="container">
			<div class="pages-head">
				<h3>CART</h3>
			</div>
			<div class="content">
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="cart-1">
					<div class="row">
						<div class="col s5">
							<h5>Image</h5>
						</div>
						<div class="col s7">
							<img src="<?php echo e($item->goods_pic); ?>" alt="">
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Name</h5>
						</div>
						<div class="col s7">
							<h5><a href=""><?php echo e($item->goods_name); ?></a></h5>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Quantity</h5>
						</div>
						<div class="col s7">
							<h3><?php echo e($item->goods_number); ?></h3>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Price</h5>
						</div>
						<div class="col s7">
							<h5>$<?php echo e($item->goods_price); ?></h5>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Action</h5>
						</div>
						<div class="col s7">
							<h5><i class="fa fa-trash"></i></h5>
						</div>
					</div>
				</div>
				<div class="divider"></div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<div class="total">
				<div class="row">
					<div class="col s7">
						<h6>Total</h6>
					</div>
					<div class="col s5">
						<h6>$<?php echo e($total); ?></h6>
					</div>
				</div>
			</div>
			<button class="btn button-default" id="tobuy">确认订单</button>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>

	// alert($);
	$(function(){
		// alert($);
		$('#tobuy').click(function(){
			
			var goods_id=new Array();
			var _this=$(this);
			goods_id.push(<?php echo e($goods_id); ?>);
			// alert(goods_id);
			location.href="<?php echo e(url('order/order_index')); ?>?goods_id="+goods_id;
		
		});
	})
</script>
<?php $__env->stopSection(); ?>
</body>
</html>
<?php echo $__env->make('layout.parent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/Car_index.blade.php ENDPATH**/ ?>