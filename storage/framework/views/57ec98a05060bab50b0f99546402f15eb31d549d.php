<?php $__env->startSection('content'); ?>   
<!-- Main content -->
<section class="container">
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="<?php echo e(asset(config('app.image_url') . 'tickets.png')); ?>">
            <p class="order__title"><?php echo e(__('label.book')); ?><br><span class="order__descript"><?php echo e(__('label.orderDescript')); ?></span></p>
        </div>
    </div>
        <div class="order-step-area">
            <div class="order-step first--step order-step--disable "><?php echo e(__('label.firstStep')); ?></div>
            <div class="order-step second--step order-step--disable"><?php echo e(__('label.secondStep')); ?></div>
            <div class="order-step third--step"><?php echo e(__('label.thirdStep')); ?></div>
        </div>
    <div class="col-sm-12">
        <div class="checkout-wrapper">
            <h2 class="page-heading"><?php echo e(__('label.price')); ?></h2>
            <ul class="book-result">
                <li class="book-result__item"><?php echo e(__('label.tickets')); ?><span class="book-result__count booking-ticket"><?php echo e(count($seat)); ?></span></li>
                <li class="book-result__item"><?php echo e(__('label.total')); ?><span class="book-result__count booking-cost"><?php echo e(number_format($totalMoney)); ?><?php echo e(__('label.tk_dvt')); ?></span></li>
            </ul>
            <h2 class="page-heading"><?php echo e(__('label.choosePayment')); ?></h2>
            <div class="payment">
                
                <div class="tips">
                    Payment card number: (4) VISA, (51 -> 55) MasterCard, (36-38-39) DinersClub, (34-37) American Express, (65) Discover, (5019) dankort
                </div>

                <div class="container2">
                    <div class="col1">
                        <div class="card">
                            <div class="front">
                                <div class="type">
                                    <img class="bankid" />
                                </div>
                                <span class="chip"></span>
                                <span class="card_number">&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; </span>
                                <div class="date"><span class="date_value">MM / YYYY</span></div>
                                <span class="fullname">FULL NAME</span>
                            </div>
                            <div class="back">
                                <div class="magnetic"></div>
                                <div class="bar"></div>
                                <span class="seccode">&#x25CF;&#x25CF;&#x25CF;</span>
                                <span class="chip"></span><span class="disclaimer">This card is property of Random Bank of Random corporation. <br> If found please return to Random Bank of Random corporation - 21968 Paris, Verdi Street, 34 </span>
                            </div>
                        </div>
                    </div>
                    <div class="col2">
                        <label>Card Number</label>
                        <input class="number" type="text" ng-model="ncard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                        <label>Cardholder name</label>
                        <input class="inputname" type="text" placeholder="" />
                        <label>Expiry date</label>
                        <input class="expire" type="text" placeholder="MM / YYYY" />
                        <label>Security Number</label>
                        <input class="ccv" type="text" placeholder="CVC" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                    </div>
                </div>
            </div> 
        </div>
        <form method="POST" action="<?php echo e(route('bill.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="arrId[]" value="<?php echo e($seatId); ?>">
            <input type="hidden" name="showtimeId" value="<?php echo e($id); ?>">
            <input type="hidden" name="totalMoney" value="<?php echo e($totalMoney); ?>">
            <div class="order">
                <button class="btn btn-md btn--warning btn--wide"><?php echo e(__('label.purchase')); ?></button>
            </div>
        </form>
    </div>
</section>
<div class="clearfix"></div>
<div class="booking-pagination">
    <a href="<?php echo e(URL::previous()); ?>" class="booking-pagination__prev">
        <p class="arrow__text arrow--prev"><?php echo e(__('label.prevStep')); ?></p>
        <span class="arrow__info"><?php echo e(__('label.chooseSit')); ?></span>
    </a>
    <a href="#" class="booking-pagination__next hide--arrow">
        <p class="arrow__text arrow--next"><?php echo e(__('label.nextStep')); ?></p>
        <span class="arrow__info"></span>
    </a>
</div>
<div class="clearfix"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" type="text/css" href="custom-css/payment.css">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js'></script>
    <script src="custom-js/payment.js" type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\frontend\booking\payment.blade.php ENDPATH**/ ?>