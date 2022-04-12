<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('admin-home')); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?php echo e(__('label.dashboard')); ?></span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Danh Sách</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo e(route('cinema.index')); ?>">Rạp Phim</a>
            <a class="dropdown-item" href="<?php echo e(route('room.index')); ?>">Phòng</a>
            <a class="dropdown-item" href="<?php echo e(route('room_type.index')); ?>">Loại Phòng</a>
            <a class="dropdown-item" href="<?php echo e(route('seat.index')); ?>">Ghế</a>
            <a class="dropdown-item" href="<?php echo e(route('seat_type.index')); ?>">Loại Ghế</a>
            <a class="dropdown-item" href="<?php echo e(route('seat_price.index')); ?>">Giá Ghế</a>
            <a class="dropdown-item" href="<?php echo e(route('movie.index')); ?>">Phim</a>
            <a class="dropdown-item" href="<?php echo e(route('showtime.index')); ?>">Xuất Chiếu</a>
            <!--<a class="dropdown-item" href="<?php echo e(route('slide.index')); ?>">Trạng Thái phim</a>-->
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('ticket.index')); ?>">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>Vé</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('adm-bill.index')); ?>">
            <i class="fas fa-money-bill"></i>
            <span>Hóa Đơn</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('user.index')); ?>">
            <i class="fas fa-users"></i>
            <span>Người Dùng</span>
        </a>
    </li>
    
    
</ul>
<?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>