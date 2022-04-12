<?php $__env->startSection('content'); ?>
<!-- Main content -->
<input type="hidden" class="getIdMovie" value="<?php echo e($movie->status); ?>">
<input type="hidden" class="getRouteMovie" value="<?php echo e(route('movie-detail.store')); ?>">
<input type="hidden" class="getRouteVote" value="<?php echo e(route('vote.index')); ?>">
<input type="hidden" class="getRouteVoteStore" value="<?php echo e(route('vote.store')); ?>">
<input type="hidden" class="getNow" value="<?php echo e(\Carbon\Carbon::now()); ?>">
<section class="container">
    <div class="col-sm-12">
        <div class="movie">
            <h2 class="page-heading"><?php echo e(__('label.movie_text', ['data' => $movie->name])); ?></h2>
            <div class="movie__info">
                <div class="col-sm-4 col-md-3 movie-mobile">
                    <div class="movie__images">
                        <span class="movie__rating"></span>
                        <img class="resize-cover" alt='' src="<?php echo e(asset(config('app.upload_cover') . $movie->image)); ?>">
                        <div class="button-video play-btn">
                            <a data-fancybox="gallery" href="<?php echo e($movie->trailer); ?>"><i class="fa fa-play text-center" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-9">
                    <input type="hidden" class="rating" data-filled="fa fa-star" data-empty="fa fa-star-o" value="<?php echo e($vote); ?>"/><a class="ng"></a>
                    <p class="movie__option">
                        <strong><?php echo e(__('label.yourVote')); ?></strong>
                        <a class='yourVote'><?php echo e($vote); ?></a><?php echo e(__('/5')); ?>

                    </p>
                    <p class="movie__time"><?php echo e(__('label.movie_time', ['data' => $movie->time])); ?></p>
                    <p class="movie__option"><strong><?php echo e(__('label.country')); ?></strong><?php echo e($movie->country); ?></p>
                    <p class="movie__option"><strong><?php echo e(__('label.director')); ?></strong><?php echo e($movie->directors); ?></p>
                    <p class="movie__option"><strong><?php echo e(__('label.product')); ?></strong><?php echo e($movie->producer); ?></p>
                    <p class="movie__option"><strong><?php echo e(__('label.type')); ?></strong><?php echo e($movie->type); ?></p>
                    <p class="movie__option"><strong><?php echo e(__('label.actor')); ?></strong><?php echo e($movie->cast); ?></p>
                    <p class="movie__option"><strong><?php echo e(__('label.date')); ?></strong><?php echo e($movie->day_start); ?></p>
                </div>
            </div>  
            <div class="clearfix"></div>
            <h2 class="page-heading"><?php echo e(__('label.plot')); ?></h2>
            <p class="movie__describe"><?php echo e($movie->content); ?></p>
            <h2 class="page-heading"><?php echo e(__('label.showtime_ticket')); ?></h2>
            <div class="col-md-3">
                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                    <input class="form-control inputDate" readonly="" type="text">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span> 
                </div>
            </div>
            <div class="choose-container">
                <div class="clearfix"></div>
                <div class="time-select"></div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<form id='showtimeForm' class='booking-form' method="POST" action="<?php echo e(route('choose-seat.store')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="showtime_id" id="showtime_id">
    <div id="booking-next" class="booking-pagination class-hide">
            <a href="#" class="booking-pagination__prev hide--arrow">
                <span class="arrow__text arrow--prev"></span>
                <span class="arrow__info"></span>
            </a>
            <button class="booking-pagination__next">
                <span class="arrow__text arrow--next"><?php echo e(__('next step')); ?></span>
                <span class="arrow__info"><?php echo e(__('choose a sit')); ?></span>
            </button>
    </div>
</form>
<form id="dateAndId">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="idFilter" class="idFilter" value="<?php echo e($movie->id); ?>">
    <input type="hidden" name="dateFilter" class="dateFilter">
</form>
<form id="voteMovie">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="movieId" class="movieId" value="<?php echo e($movie->id); ?>">
    <input type="hidden" name="point" class="point">
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\cinema02\resources\views/frontend/movie/movie-detail.blade.php ENDPATH**/ ?>