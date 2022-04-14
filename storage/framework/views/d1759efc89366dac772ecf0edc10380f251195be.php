<?php $__env->startSection('content'); ?>
<section class="container">
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="<?php echo e(asset(config('app.image_url') . 'tickets.png')); ?>">
            <p class="order__title"><?php echo e(__('Thank you')); ?><br><span class="order__descript"><?php echo e(__('you have successfully purchased tickets')); ?></span></p>
        </div>
        <div class="ticket">
            <div class="ticket-position">
                <div class="ticket__indecator indecator--pre">
                    <div class="indecator-text pre--text"><?php echo e(__('label.onlineTicket')); ?></div> 
                </div>
                <div class="ticket__inner">
                    <div class="ticket-secondary">
                        <span class="ticket__item"><?php echo e(__('label.tk_ticketNumber')); ?><strong class="ticket__number"><?php echo e($code); ?></strong></span>
                        <span class="ticket__item ticket__date"><?php echo e(\Carbon\Carbon::parse($showtime->timestart)->format('d/m/Y')); ?></span>
                        <span class="ticket__item ticket__time"><?php echo e(\Carbon\Carbon::parse($showtime->timestart)->format('H:i')); ?></span>
                        <span class="ticket__item"><?php echo e(__('label.tk_cinema')); ?><span class="ticket__cinema"><?php echo e($showtime->room->cinema->name); ?></span></span>
                        <span class="ticket__item"><?php echo e(__('label.tk_address')); ?><span class="ticket__hall"><?php echo e($showtime->room->cinema->address); ?></span></span>
                        <span class="ticket__item ticket__price"><?php echo e(__('label.tk_price')); ?><strong class="ticket__cost"><?php echo e(number_format($totalMoney)); ?></strong><?php echo e(__('label.tk_dvt')); ?></span>
                    </div>
                    <div class="ticket-primery">
                        <span class="ticket__item ticket__item--primery ticket__film"><?php echo e(__('label.tk_film')); ?><br><strong class="ticket__movie"><?php echo e($showtime->movie->name); ?></strong></span>
                        <span class="ticket__item ticket__item--primery"><?php echo e(__('label.tk_seat')); ?><span class="ticket__place">
                            <?php $__currentLoopData = $arrSeat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($data->seat_name . ', '); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span></span>
                    </div>
                </div>
                <div class="ticket__indecator indecator--post">
                    <div class="indecator-text post--text"><?php echo e(__('label.onlineTicket')); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\frontend\booking\ticket.blade.php ENDPATH**/ ?>