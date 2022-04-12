<nav class="navbar navbar-expand navbar-dark bg-dark static-top">    
    <a class="navbar-brand mr-1" href="<?php echo e(route('admin-home')); ?>">
        <?php echo e(__('label.hi', ['data' => Auth::user()->name])); ?>

    </a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <a href="<?php echo e(route('home')); ?>" class="logo">
        <img width="50" height="50" alt='logo' src="<?php echo e(asset(config('app.image_url') . 'Logo.png')); ?>">
    </a>
    <ul class="navbar-nav ml-auto">                    
        <li class="nav-item dropdown no-arrow">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#"><?php echo e(__('label.Settings')); ?></a>
                <a class="dropdown-item" href="#"><?php echo e(__('label.Activity')); ?></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" data-toggle="modal" data-target="#logoutModal"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    Đăng Xuất
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </li>
    </ul>
</nav>
<?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/layouts/header.blade.php ENDPATH**/ ?>