<?php $__env->startSection('title','登录'); ?>

<?php $__env->startSection('pages_section'); ?>
<div class="pages section">

		<div class="container">
			<div class="pages-head">
				<h3>LOGIN</h3>
			</div>
			<div class="login">
				<div class="row">
					<form class="col s12" method="post" action="<?php echo e(url('StudentController/dologin')); ?>">
                    <?php echo csrf_field(); ?>
						<div class="input-field">
							<input type="text" class="validate valid" name="user_name" placeholder="USERNAME" required="">
						</div>
						<div class="input-field">
							<input type="password" class="validate valid" name="user_pwd" placeholder="PASSWORD" required="">
						</div>
						<a href=""><h6>Forgot Password ?</h6></a>
                        <input type="submit" class="btn button-default" value="Login">
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

    
<?php echo $__env->make('layout.parent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wnmp\www\laravel\resources\views/Studentlogin.blade.php ENDPATH**/ ?>