<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php $__env->startSection('footer'); ?>    
<input type="hidden" value="<?php echo e($id); ?>" id="good_id">
<div class="pages section">
		<div class="container">
			<div class="shop-single">
				<img src="<?php echo e($data->goods_pic); ?>">
				<h5><?php echo e($data->goods_name); ?></h5>
				<div class="price">$20 <span>$<?php echo e($data->goods_price); ?></span></div>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam eaque in non delectus, error iste veniam commodi mollitia, officia possimus, repellendus maiores doloribus provident. Itaque, ab perferendis nemo tempore! Accusamus</p>
				<a href="javascript:;" id="ToCar" class="btn button-default">ADD TO CART</a>
			</div>
			<div class="review">
					<h5>1 reviews</h5>
					<div class="review-details">
						<div class="row">
							<div class="col s3">
								<img src="img/user-comment.jpg" alt="" class="responsive-img">
							</div>
							<div class="col s9">
								<div class="review-title">
									<span><strong>John Doe</strong> | Juni 5, 2016 at 9:24 am | <a href="">Reply</a></span>
								</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis accusantium corrupti asperiores et praesentium dolore.</p>
							</div>
						</div>
					</div>
				</div>
			
		</div>
	</div>
    <div class="footer">
		<div class="container">
			<div class="about-us-foot">
				<h6>Mstore</h6>
				<p>is a lorem ipsum dolor sit amet, consectetur adipisicing elit consectetur adipisicing elit.</p>
			</div>
			<div class="social-media">
				<a href=""><i class="fa fa-facebook"></i></a>
				<a href=""><i class="fa fa-twitter"></i></a>
				<a href=""><i class="fa fa-google"></i></a>
				<a href=""><i class="fa fa-linkedin"></i></a>
				<a href=""><i class="fa fa-instagram"></i></a>
			</div>
			<div class="copyright">
				<span>© 2017 All Right Reserved</span>
			</div>
		</div>
	</div>
	<input type="hidden" name="session" class="atang" value="<?php echo e(Session::get('user_name')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
	$(function(){
		$('#ToCar').click(function(){
			var session=$('.atang').val();
			// console.log(session);return false;
			if(session==""){
				alert('请先登录');
				location.href="<?php echo e(url('StudentController/login')); ?>";
			}
			var id=<?php echo e($id); ?>;
			// alert(id);
			$.get(
				"<?php echo e(url('Car/create')); ?>",
				{id:id},
				function(res){
					// console.log(res);
					if(res.code=1){
						alert(res.msg);
						location.href="<?php echo e(url('Car/index')); ?>";
					}else{
						alert(res.msg);
					}
				},
				'json'
			);
			
		});
	});
</script>
<?php $__env->stopSection(); ?>
</body>
</html>
<?php echo $__env->make('layout.parent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/pro.blade.php ENDPATH**/ ?>