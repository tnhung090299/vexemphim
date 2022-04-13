<?php $__env->startSection('content'); ?>
<input type="hidden" class="getIdMovie" value="1">
<input type="hidden" class="getRouteMovie" value="<?php echo e(route('movie-detail.store')); ?>">
<input type="hidden" class="getNow" value="<?php echo e(\Carbon\Carbon::now()); ?>">
<section class="container">
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="<?php echo e(asset(config('app.image_url') . 'movieticket.png')); ?>">
            <p class="order__title"><?php echo e(__('label.book')); ?><br><span class="order__descript"><?php echo e(__('label.orderDescript')); ?></span></p>
        </div>
    </div>
    

</section>
<div class="col-sm-12">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#movie"><?php echo e(__('label.byMovie')); ?></a></li>
        <li><a data-toggle="tab" href="#cinema"><?php echo e(__('label.byCinema')); ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane  active" id="movie">
            <div class="choose-film">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide" data-film="<?php echo e($movie->name); ?>" data-id="<?php echo e($movie->id); ?>">
                                <img class="styleBgImage" src="<?php echo e(asset(config('app.upload_cover') . $movie->image)); ?>">
                                <p class="choose-film__title"><?php echo e($movie->name); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>  
            <section class="container">
                <div class="col-sm-12">
                    <div class="choose-indector choose-indector--film">
                        <strong><?php echo e(__('label.choosen')); ?></strong><span class="choosen-area"></span>
                    </div>
                    <h2 class="page-heading"><?php echo e(__('label.cityDate')); ?></h2>
                    <div class="choose-container choose-container--short ">
                        <div id="datepicker" class="input-group date col-md-3" data-date-format="yyyy-mm-dd">
                            <input class="form-control inputDate" readonly="" type="text">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span> 
                        </div>
                    </div>
                    <h2 class="page-heading"><?php echo e(__('label.pickTime')); ?></h2>
                    <div class="choose-container">
                        <div class="clearfix"></div>
                        <div class="time-select"></div>
                    </div>
                </div>
            </section>
        </div>
        <div class="tab-pane" id="cinema">
            <section class="container">
                <div class="list-group col-md-4">
                    <a class="list-group-item active"><b><?php echo e(__('label.selectCinema')); ?></b></a>
                    <?php $__currentLoopData = $cinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="javascript:void(0)" class="list-group-item cinemaId" data-id="<?php echo e($cinema->id); ?>"><?php echo e($cinema->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="list-group col-md-4">
                    <a class="list-group-item active"><b><?php echo e(__('label.selectMovie')); ?></b></a>
                    <div class="chooseMoive">
                        <a class="list-group-item">Vui lòng chọn phim</a>
                    </div>
                </div>
                <div class="list-group col-md-4">
                    <a class="list-group-item active"><b><?php echo e(__('label.selectSession')); ?></b></a>
                    <ul class="list-group chooseTime">
                        <li class="list-group-item">Vui lòng chọn suất</li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <form id='showtimeForm' class='booking-form' method="POST" action="<?php echo e(route('choose-seat.store')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="showtime_id" id="showtime_id">
        <div id="booking-next" class="booking-pagination class-hide">
            <a href="#" class="booking-pagination__prev hide--arrow">
                <span class="arrow__text arrow--prev"></span>
                <span class="arrow__info"></span>
            </a>
            <button class="booking-pagination__next">
                <span class="arrow__text arrow--next"><?php echo e(__('label.nextStep')); ?></span>
                <span class="arrow__info"><?php echo e(__('label.chooseSit')); ?></span>
            </button>
        </div>
    </form>
    <input type="hidden" class="uploadCover" value="<?php echo e(asset(config('app.upload_cover'))); ?>">
    <form id="dateAndId">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="idFilter" class="idFilter">
        <input type="hidden" name="dateFilter" class="dateFilter">
    </form>
</div>
<input type="hidden" class="getIdCinema" value="">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('custom-js/booking.js')); ?>"></script>
<script type="text/javascript">
    today = new Date()
    dayIndex = today.getDay()
    console.log(dayIndex)
    $('.cinemaId').click(function () {
        $('.chooseMoive').html(`<a class="list-group-item">Vui lòng chọn phim</a>`);
        $('.chooseTime').html(`<a class="list-group-item">Vui lòng chọn suất</a>`);
        $('.cinemaId').removeClass('text-right');
        $(this).addClass('text-right');
        var uploadCover = $('.uploadCover').val();
        var id = $(this).data('id');
        $('.getIdCinema').val(id);
        $.get( 'booking/' + id, function (data ) {
            var html = '';
            $.each(data, function(key, value) {
                html += `<a href="javascript:void(0)" class="list-group-item movieId" data-id="` + value.id + `"><img src="` + uploadCover + `/` + value.image + `">` + value.name + `</a>`;
            });
            $('.chooseMoive').html(html);
        });
    });
    $('body').on('click', '.movieId', function () {
        $('.movieId').removeClass('text-right');
        $(this).addClass('text-right');
        var id = $(this).data('id');
        var cinemaId = $('.getIdCinema').val();
        var arr = [cinemaId, id];

        $.get('booking/' + arr + '/edit', function (data) {
            var html = '';
            var check = 0;
            $.each(data, function (key, value) {
                html += `<li class="list-group-item">` + key;
                $.each(value, function(key1, value1) {

                    html += `<ul class="list-inline">` + key1 + ` -- `;
                    $.each(value1, function (key2, value2) {
                        html += `<li class="list-inline-item"><button type="button" data-id="` + value2.id + `" class="btn btn-default btn-sm showtimeId">` + value2.time + `</button></li>`;
                    })
                    html += `</ul>`;
                });
                html +=`</li>`;
            });
            $('.chooseTime').html(html);
        });
    });
    $('body').on('click', '.showtimeId', function () {
        var id = $(this).data('id');
        $('.showtimeId').removeClass('btn-info');
        $(this).addClass('btn-info');
        $('.class-hide').show();
        //gán showtime_id form
        $('#showtime_id').val(id);
    })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/frontend/booking/booking.blade.php ENDPATH**/ ?>