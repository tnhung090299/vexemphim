<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <form class="login" method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>
        <p class="login__title"><?php echo e(__('label.Register')); ?><br><span class="login-edition"><?php echo e(__('label.welcome-to-aMovie')); ?></span></p>
        <div class="field-wrap">
            <input id="name" type="text" placeholder='<?php echo e(__('label.Name')); ?>' class="login__input" name="name" required autofocus>
            <?php if($errors->has('name')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('name')); ?></strong>
                </span>
            <?php endif; ?>
            <input id="email" type='email' placeholder='<?php echo e(__('label.Email')); ?>' name='email' required autofocus class="login__input">
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
            <input id="password-confirm" type="password" class="login__input" name="password_confirmation" placeholder='<?php echo e(__('label.Confirm-Password')); ?>' required>
        </div>
        <div class="login__control">
            <button type="submit" class="btn btn-md btn--warning btn--wider"><?php echo e(__('label.Register')); ?></button>
        </div>
    </form>
    <div class="clearfix"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\auth\register.blade.php ENDPATH**/ ?>