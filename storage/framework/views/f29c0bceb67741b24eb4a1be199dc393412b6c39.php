<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <form class="login" method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <p class="login__title"><?php echo e(__('label.Sign-in')); ?><br><span class="login-edition"><?php echo e(__('label.welcome-to-aMovie')); ?></span></p>
        <div class="social social--colored">
            <a href='<?php echo e(url('redirect/facebook')); ?>' class="social__variant fa fa-facebook"></a>
            <a href='<?php echo e(url('redirect/google')); ?>' class="social__variant fa fa-google-plus"></a>
        </div>
        <p class="login__tracker">or</p>
        <div class="field-wrap">
            <input id="email" type='email' placeholder='<?php echo e(__('label.Email')); ?>' name='email' value="<?php echo e(old('email')); ?>" required autofocus class="login__input">
            <?php if($errors->has('email')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
            <?php endif; ?>
            <input id="password" type='password' placeholder='<?php echo e(__('label.Password')); ?>' name='password' required class="login__input">
            <?php if($errors->has('password')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
            <?php endif; ?>
            <input type='checkbox' name="remember" id="remember" class='login__check styled'>
            <label for='remember' class='login__check-info'><?php echo e(__('label.Remember-Me')); ?></label>
        </div>
        <div class="login__control">
            <button type='submit' class="btn btn-md btn--warning btn--wider"><?php echo e(__('label.Sign-in')); ?></button>
            <?php if(Route::has('password.request')): ?>
                <a class="login__tracker form__tracker" href="<?php echo e(route('password.request')); ?>">
                    <?php echo e(__('label.Forgot-Your-Password')); ?>

                </a>
            <?php endif; ?>
        </div>
    </form>
    <div class="clearfix"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/auth/login.blade.php ENDPATH**/ ?>