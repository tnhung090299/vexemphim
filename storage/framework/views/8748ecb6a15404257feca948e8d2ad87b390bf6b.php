<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(__('label.title')); ?></title>
    <!-- Mobile Specific Metas-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Fonts -->
    <!-- Font awesome - icon font -->
    <link href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">
    <!-- Roboto -->
    <link href='<?php echo e(asset('bower_components/css/index')); ?>' rel='stylesheet' type='text/css'>
    <!-- Open Sans -->
    <link href='<?php echo e(asset('bower_components/css/index')); ?>' rel='stylesheet' type='text/css'>
    <!-- Stylesheets -->
    <link href='<?php echo e(asset('bower_components/bootstrap.min/index.css')); ?>' rel='stylesheet' type='text/css'>
    <!-- jQuery UI --> 
    <link href="<?php echo e(asset('bower_components/jquery-ui1/index.css')); ?>" rel="stylesheet">
    <!-- Mobile menu -->
    <link href="<?php echo e(asset('bower_components/xp_css/css/gozha-nav.css')); ?>" rel="stylesheet" />
    <!-- Select -->
    <link href="<?php echo e(asset('bower_components/xp_css/css/external/jquery.selectbox.css')); ?>" rel="stylesheet" />
    <!-- Magnific-popup -->
    <link href="<?php echo e(asset('bower_components/xp_css/css/external/magnific-popup.css')); ?>" rel="stylesheet" />
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bower_components/xp_css/rs-plugin/css/settings.css')); ?>" media="screen" />
    <!-- Custom -->
    <link href="<?php echo e(asset('bower_components/xp_css/css/style.css?v=1')); ?>" rel="stylesheet" />
    <!-- Modernizr --> 
    <script src="<?php echo e(asset('bower_components/xp_css/js/external/modernizr.custom.js')); ?>"></script>
    <!-- Custom css -->
    <link rel="stylesheet prefetch" href="<?php echo e(asset('bower_components/datepicker/index.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bower_components/swiper/dist/css/swiper.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('bower_components/bootstrap-rating/bootstrap-rating.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom-css/css.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/jquery.fancybox.min.css/index.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/flag-icon-css/css/flag-icon.css')); ?>" />
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="wrapper">
        <!--Header-->
        <?php echo $__env->make('frontend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--Content-->
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!--Footer -->
    <?php echo $__env->make('frontend.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- JavaScript-->
    <!-- jQuery --> 
    <script src="<?php echo e(asset('bower_components/jquery.min/index.js')); ?>"></script>
    <script>window.jQuery || document.write('<script src="<?php echo e(asset('bower_components/xp_css/js/external/jquery-1.10.1.min.js')); ?>"><\/script>')</script>
    <!-- Migrate --> 
    <script src="<?php echo e(asset('bower_components/xp_css/js/external/jquery-migrate-1.2.1.min.js')); ?>"></script>
    <!-- Mobile menu -->
    <script src="<?php echo e(asset('bower_components/xp_css/js/jquery.mobile.menu.js')); ?>"></script>
    <!-- Select -->
    <script src="<?php echo e(asset('bower_components/xp_css/js/external/jquery.selectbox-0.2.min.js')); ?>"></script>
    <!-- Swiper slider -->
    <script src="<?php echo e(asset('bower_components/xp_css/js/external/idangerous.swiper.min.js')); ?>"></script>
    <!-- Form element -->
    <script src="<?php echo e(asset('bower_components/xp_css/js/external/form-element.js')); ?>"></script>
    <!-- Form validation -->
    <script src="<?php echo e(asset('bower_components/xp_css/js/form.js')); ?>"></script>
    <!-- Custom -->
    <script src="<?php echo e(asset('bower_components/xp_css/js/custom.js')); ?>"></script>
    <!-- jQuery UI -->
    <script src="<?php echo e(asset('bower_components/jquery-ui/index.js')); ?>"></script>
    <!-- Magnific-popup -->
    <script src="<?php echo e(asset('bower_components/xp_css/js/external/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/jquery.min/index.js')); ?>"></script>
    <!-- jQuery REVOLUTION Slider -->
    <script type="text/javascript" src="<?php echo e(asset('bower_components/xp_css/rs-plugin/js/jquery.themepunch.plugins.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('bower_components/xp_css/rs-plugin/js/jquery.themepunch.revolution.min.js')); ?>"></script>
    <!-- Bootstrap 3-->
    <script src="<?php echo e(asset('bower_components/bootstrap.min.js/index.js')); ?>"></script>
    <!-- Typeahead -->
    <script src="<?php echo e(asset('typeahead/typeahead.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap-datepicker/index.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('bower_components/swiper/dist/js/swiper.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('bower_components/bootstrap-rating/bootstrap-rating.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('custom-js/scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/jquery.fancybox.min/index.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\wampp\www\vexemphim\resources\views/frontend/layouts/master.blade.php ENDPATH**/ ?>