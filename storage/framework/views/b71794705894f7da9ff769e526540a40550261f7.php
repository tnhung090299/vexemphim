<?php $__env->startSection('content'); ?>
<section class="container">
    <ul class="nav nav-tabs">
        <li>
            <a href="<?php echo e(route('now-showing')); ?>"><?php echo e(__('label.now')); ?></a>
        </li>
        <li class="active">
            <a><?php echo e(__('label.soon')); ?></a>
        </li>
    </ul>
    <div class="col-sm-12">
        <div class="cinema-wrap">
            <div class="row">
                <?php $__currentLoopData = $movie; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xs-6 col-sm-3 cinema-item">
                        <div class="cinema">
                            <a href='<?php echo e(route('movie-detail.show', ['id' => $data->id])); ?>' class="cinema__images">
                                <img class="resize-cover" alt='' src="<?php echo e(asset(config('app.upload_cover') . $data->image)); ?>">
                                <span class="cinema-rating"><?php echo e(__('label.rate', ['data' => round($data->votes->avg('point'), config('const.round'))])); ?></span>
                            </a>
                            <a class="cinema-title text-overflow"><?php echo e($data->name); ?></a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\frontend\movie\comming-soon.blade.php ENDPATH**/ ?>