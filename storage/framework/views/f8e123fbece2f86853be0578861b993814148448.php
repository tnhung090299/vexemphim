<?php $__env->startSection('content'); ?>
<div class="place-form-area">
    <section class="container">
        <div class="order-container">
            <div class="order">
                <img class="order__images" alt='' src="<?php echo e(asset(config('app.image_url') . 'movieticket.png')); ?>">
                
                <p class="order__title"><?php echo e(__('label.book')); ?><br><span class="order__descript"><?php echo e(__('label.orderDescript')); ?></span></p>
            </div>
        </div>
        <div class="order-step-area">
            <div class="order-step first--step order-step--disable "><?php echo e(__('label.firstStep')); ?></div>
            <div class="order-step second--step"><?php echo e(__('label.secondStep')); ?></div>
        </div>
        <div class="choose-sits">
            <div class="col-sm-12 col-lg-10 col-lg-offset-1">
                <div class="sits-area hidden-xs">
                    <div class="sits-anchor"><?php echo e(__('screen')); ?></div>
                    <div class="sits">
                        <aside class="sits__line">
                            <?php $__currentLoopData = $seatRow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="sits__indecator"><?php echo e($seat->row_name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </aside>
                            <?php $__currentLoopData = $seatCol; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seatRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="sits__row">
                                    <?php $__currentLoopData = $seatRow->seatCols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($data->tickets_count > 0): ?>
                                            <span class="sits__place sits-price--cheap sits-state--not" data-id="-999">Empty</span>
                                        <?php else: ?>
                                            <?php if($seatRow->seat_type_id == 1): ?>
                                                <span class="sits__place sits-price--cheap" data-id='<?php echo e($data->id); ?>' data-place='<?php echo e($data->seat_name); ?>' data-price='<?php echo e($seatRow->seatType->seatPrices[0]->price); ?>'><?php echo e($data->seat_name); ?></span>
                                            <?php elseif($seatRow->seat_type_id == 2): ?>
                                                <span class="sits__place sits-price--middle" data-id='<?php echo e($data->id); ?>'  data-place='<?php echo e($data->seat_name); ?>' data-price='<?php echo e($seatRow->seatType->seatPrices[0]->price); ?>'><?php echo e($data->seat_name); ?></span>
                                            <?php elseif($seatRow->seat_type_id == 3): ?>
                                                <span class="sits__place sits-price--expensive" data-id='<?php echo e($data->id); ?>'  data-place='<?php echo e($data->seat_name); ?>' data-price='<?php echo e($seatRow->seatType->seatPrices[0]->price); ?>'><?php echo e($data->seat_name); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <aside class="sits__checked">
                            <div class="checked-place">
                            </div>
                            <div class="checked-result">
                                <?php echo e(__('0 đ')); ?>

                            </div>
                        </aside>
                        <footer class="sits__number">
                            <?php for($i = 1; $i <= $max; $i++): ?>
                                <span class="sits__indecator"><?php echo e($i); ?></span>
                            <?php endfor; ?>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="clearfix"></div>
<input type="hidden" name="seatSelected" class="seatSelected" value="<?php echo e($seatSelected); ?>">
<form id='showtimeForm' method="POST" action="<?php echo e(route('payment.store')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="seatId[]" id="seatId">   
    <input type="hidden" name="showtimeId" id="showtimeId" value="<?php echo e($id); ?>">
    <input type="hidden" name="result" id="result">
    <div id="booking-next" class="booking-pagination">
        <a href="<?php echo e(URL::previous()); ?>" class="booking-pagination__prev">
            <span class="arrow__text arrow--prev"><?php echo e(__('label.prevStep')); ?></span>
            <span class="arrow__info"><?php echo e(__('label.firstStep')); ?></span>
        </a>
        <div class="class-hide">
            <button type="submit" class="booking-pagination__next">
                <span class="arrow__text arrow--next"><?php echo e(__('label.nextStep')); ?></span>
                <span class="arrow__info"><?php echo e(__('label.checkout')); ?></span>
            </button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.sits__place').click(function () {
        //data element init
        var chooseTime = $(this).attr('data-time');
        var id = $(this).attr('data-id');
        $('.class-hide').show();
    });
    init_BookingTwo();
</script>
<script src="https://js.pusher.com/4.0/pusher.js"></script>
<script type="text/javascript">
    var a = jQuery.parseJSON($('.seatSelected').val());
    $('.sits__place').each(function () {
        var val = $(this).data('id');
        var check = a.indexOf(val.toString());
        if (check != -1) {
            $(this).addClass('somebody-choseen');
        } else {
            $(this).removeClass('somebody-choseen');
        }
    })

    $(document).ready(function (){

        var pusher = new Pusher('ce71fbaacd844a8dda04', {
            cluster: 'ap1',
            forceTLS: true
        });

        var showtimeId = $('#showtimeId').val();
        var channel = pusher.subscribe('queue');
        channel.bind('mess', function(data) {
            if (data.showtime == showtimeId) {
                if (<?php echo e(Auth::id()); ?> != data.user) {
                    if (data.seats != null) {
                        $('.sits__place').each(function () {
                            var val = $(this).data('id');
                            var check = data.seats.indexOf(val.toString());
                            if (check != -1) {
                                $(this).addClass('somebody-choseen');
                            } else {
                                $(this).removeClass('somebody-choseen');
                            }
                        })
                    } else $('.sits__place').removeClass('somebody-choseen');
                }
            }
        });
    })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/frontend/booking/choose-seat.blade.php ENDPATH**/ ?>