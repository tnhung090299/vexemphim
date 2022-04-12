<!-- Header section -->
<header class="header-wrapper">
    <div class="container">
        <!-- Logo link-->
        <a href="<?php echo e(route('home')); ?>" class="logo">
            <img alt='logo' src="<?php echo e(asset(config('app.image_url') . 'logo.png')); ?>">
        </a> 
        <!-- Main website navigation-->
        <nav id="navigation-box">
            <!-- Toggle for mobile menu mode -->
            <a href="#" id="navigation-toggle">
                <span class="menu-icon">
                    <span class="icon-toggle" role="button" aria-label="Toggle Navigation">
                      <span class="lines"></span>
                    </span>
                </span>
            </a> 
            <!-- Link navigation -->
            <ul id="navigation">
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#"><?php echo e(__('label.movie')); ?></a>
                    <ul class="mega-menu container">
                        <li class="col-md-6 mega-menu__coloum">
                            <a href="<?php echo e(route('now-showing')); ?>"><h4 href='' class="mega-menu__heading"><?php echo e(__('label.now')); ?></h4></a>
                            <?php $__currentLoopData = $new; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="gallery-item col-md-6">
                                    <a href='<?php echo e(route('movie-detail.show', ['id' => $data->id])); ?>' class="gallery-item__image">
                                        <img class="resize-menu-movie" alt='' src="<?php echo e(asset(config('app.upload_cover') . $data->image)); ?>">
                                    </a>
                                    <a class="text-overflow"><?php echo e($data->name); ?></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </li>
                        <li class="col-md-6 mega-menu__coloum">
                            <a href="<?php echo e(route('comming-soon')); ?>"><h4 class="mega-menu__heading"><?php echo e(__('label.soon')); ?></h4></a>
                            <?php $__currentLoopData = $soon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="gallery-item col-md-6">
                                    <a href='<?php echo e(route('movie-detail.show', ['id' => $data->id])); ?>' class="gallery-item__image">
                                        <img class="resize-menu-movie" alt='' src="<?php echo e(asset(config('app.upload_cover') . $data->image)); ?>">
                                    </a>
                                    <a class="text-overflow"><?php echo e($data->name); ?></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><?php echo e(__('label.support')); ?></a>
                </li>
            </ul>
        </nav>
        <div class="control-panel right40">
            <input type="search" name="search" id="searchNav" title="Search" class="typeahead" placeholder="Search">
        </div>
        <!-- Additional header buttons / Auth and direct link to booking-->
        <div class="control-panel right5">
            <div class="col-md-9">
                <?php if(auth()->guard()->guest()): ?>
                    <!-- <div class="control-panel"> -->
                    <a href="<?php echo e(route('login')); ?>" class="btn btn--sign"><?php echo e(__('label.login')); ?></a>
                <?php if(Route::has('register')): ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn--sign"><?php echo e(__('label.reg')); ?></a>
                <?php endif; ?>
                <?php else: ?>
                    <!-- <div class="control-panel"> -->
                    <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"> 
                            <?php echo e(Auth::user()->name); ?>

                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo e(route('profile.index')); ?>"><?php echo e(__('label.profile')); ?></a></li>
                            <?php if(Auth::user()->role == 1): ?>
                                <li><a href="<?php echo e(route('admin-home')); ?>"><?php echo e(__('label.Admin')); ?></a></li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo e(route('logout')); ?>" data-toggle="modal" data-target="#logoutModal"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    Đăng Xuất
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                    </div> 
                <?php endif; ?>
            </div>
            <div class="col-md-3">
                <a href="<?php echo e(route('booking.index')); ?>" class="btn btn-md btn--warning btn--book btn-control--home"><?php echo e(__('label.book')); ?></a>
            </div>
        </div>
        <div class="control-panel lang-right">
            <a href="<?php echo e(route('lang', ['lang' => 'vi'])); ?>"><span class="flag-icon flag-icon-vn"></span></a>
            <a href="<?php echo e(route('lang', ['lang' => 'en' ])); ?>"><span class="flag-icon flag-icon-gb"></span></a>
        </div>
    </div>
    <input type="hidden" class="notFound" value="<?php echo e(__('label.notFound')); ?>">
    <input type="hidden" class="linkUploadCover" value="<?php echo e(asset(config('app.upload_cover'))); ?>">
    <input type="hidden" class="routeMovieDetail" value="<?php echo e(route('movie-detail.index')); ?>">
</header>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('custom-js/header.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\wampp\www\cinema02\resources\views/frontend/layouts/header.blade.php ENDPATH**/ ?>