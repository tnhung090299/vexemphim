<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('admin-home')); ?>"><?php echo e(__('label.dashboard')); ?></a>
        </li>
    </ol>
    <!-- Page Content -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-users"></i>
                    </div>
                    <div class="mr-5"><?php echo e(__('label.chart_user', ['data' => $countUser])); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo e(route('user.index')); ?>">
                    <span class="float-left"><?php echo e(__('label.chart_detail')); ?></span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-film"></i>
                    </div>
                    <div class="mr-5"><?php echo e(__('label.chart_movie', ['data' => $countMovie])); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo e(route('movie.index')); ?>">
                    <span class="float-left"><?php echo e(__('label.chart_detail')); ?></span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-ticket-alt"></i>
                    </div>
                    <div class="mr-5"><?php echo e(__('label.chart_tickets', ['data' => $countTicket])); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo e(route('ticket.index')); ?>">
                    <span class="float-left"><?php echo e(__('label.chart_detail')); ?></span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-money-bill-wave"></i>
                    </div>
                    <div class="mr-8"><?php echo e(__('label.chart_money', ['data' => number_format($totalMoney)])); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo e(route('adm-bill.index')); ?>">
                    <span class="float-left"><?php echo e(__('label.chart_detail')); ?></span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php echo $rating->container(); ?>

    </div>
    <?php echo $rating->script(); ?>

    <div class="col-md-6">
        <?php echo $tav->container(); ?>

    </div>
    <?php echo $tav->script(); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/homepages/home.blade.php ENDPATH**/ ?>