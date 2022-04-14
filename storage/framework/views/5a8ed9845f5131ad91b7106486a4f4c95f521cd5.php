<?php $__env->startSection('content'); ?>
<!-- Slider -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      
        <div class="swiper-slide">
            <a href="<?php echo e(route('movie-detail.show', ['id' => $slide->movie->id])); ?>">
                <img src="<?php echo e(asset(config('app.upload_slide') . $slide->image)); ?>">
            </a>
            <div class="button-video play-btn">
                <a data-fancybox="gallery" href="<?php echo e($slide->movie->trailer); ?>"><i class="fa fa-play text-center" aria-hidden="true"></i></a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<!--end slider -->
<!-- Main content -->
<section class="container">
    <div class="movie-best">
        <div class="col-sm-10 col-sm-offset-1 movie-best__rating"><?php echo e(__('label.movie_best')); ?></div>
        <div class="col-sm-12 change--col">
            <?php $__currentLoopData = $best; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="movie-beta__item ">
                <img class="resize-best-movie" alt='' src="<?php echo e(asset(config('app.upload_cover') . $data->image)); ?>">
                <span class="best-rate"><?php echo e(__('label.rate', ['data' => round($data->point, 1)])); ?></span>
                <ul class="movie-beta__info">
                    <li><span class="best-voted"><?php echo e(__('label.vote_day', ['data' => '70'])); ?></span></li>
                    <li>
                        <p class="movie__time"><?php echo e(__('label.movie_time', ['data' => $data->time])); ?></p>
                        <p><?php echo e(__('label.movie_type', ['data' => $data->type])); ?></p>
                    </li>
                    <li class="last-block">
                        <a href="<?php echo e(route('movie-detail.show', ['id' => $data->id])); ?>" class="slide__link"><?php echo e(__('label.more')); ?></a>
                    </li>
                </ul>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="col-sm-10 col-sm-offset-1 movie-best__check"><?php echo e(__('label.all_now')); ?></div>
    </div>
    <div class="clearfix"></div>
    <h2 id='target' class="page-heading heading--outcontainer"><?php echo e(__('label.now_cinema')); ?></h2>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-8 col-md-9">
                <?php $__currentLoopData = $new; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="movie movie--test movie--test--dark movie--test--left">
                        <div class="movie__images">
                            <a href="<?php echo e(route('movie-detail.show', ['id' => $data->id])); ?>" class="movie-beta__link">
                                <img class="resize-now-movie-home" alt='' src="<?php echo e(asset(config('app.upload_cover') . $data->image)); ?>">
                            </a>
                        </div>
                        <div class="movie__info">
                            <a href='<?php echo e(route('movie-detail.show', ['id' => $data->id])); ?>' class="movie__title"><?php echo e(__('label.movie_title', ['data' => $data->name])); ?></a>
                            <p class="movie__time"><?php echo e(__('label.movie_time', ['data' => $data->time])); ?></p>
                            <p class="movie__option"><?php echo e(__('label.movie_type', ['data' => $data->type])); ?></p>
                            <div class="movie__rate row">
                                <div class="col-md-9">
                                    <input type="hidden" class="rating" data-filled="fa fa-star" data-empty="fa fa-star-o" disabled="" value="<?php echo e(round($data->votes->avg('point'), config('const.round'))); ?>" />
                                </div>
                                <div class="col-md-3">
                                    <span class="movie__rating"><?php echo e(__('label.rate', ['data' => round($data->votes->avg('point'), config('const.round'))])); ?></span>
                                </div>
                            </div>               
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
        </div>
    </div>     
</section> 
<div class="clearfix"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('custom-css/home.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('custom-js/home.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\frontend\homepages\home.blade.php ENDPATH**/ ?>