<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(__('label.title')); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/jquery.dataTables.min/index.css')); ?>">
    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('bower_components/fontawesome/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('bower_components/admin_css/css/sb-admin.css')); ?>" rel="stylesheet">
    <!-- DataTables -->
    <link href="<?php echo e(asset('bower_components/dataTables.bootstrap4.min/index.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('custom-css/admin.css')); ?>">
</head>
<body id="page-top">
    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="wrapper">
    <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div id="content-wrapper">
           <?php echo $__env->yieldContent('content'); ?>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span><?php echo e(__('label.copy-rights')); ?></span>
                    </div>
                </div>
            </footer>
        </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('bower_components/admin_css/vendor/jquery/jquery.min.js')); ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset('bower_components/admin_css/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
    <!-- Custom scripts for all pagsidebar -->
    <script src="<?php echo e(asset('bower_components/admin_css/js/sb-admin.min.js')); ?>"></script>
    <!-- jQuery -->
    <script src="<?php echo e(asset('bower_components/jquery/index.js')); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo e(asset('bower_components/jquery.dataTables.min.js/index.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/dataTables.bootstrap4.min.js/index.js')); ?>"></script>
    <!-- -->
    <script src="<?php echo e(asset('bower_components/mvo1/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- Bootstrap JavaScript -->
    <script src="<?php echo e(asset('bower_components/bootstrap.min/index.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/bootstrap.min.4.1.3/index.js')); ?>"></script>
    <!-- Jquery Validate -->
    <script src="<?php echo e(asset('bower_components/jquery.validate/index.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/chart/index.js')); ?>"></script>
    <!-- App scripts -->
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>