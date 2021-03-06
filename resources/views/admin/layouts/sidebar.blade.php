<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin-home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('label.dashboard') }}</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản Lý Phòng</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown"> 
            <a class="dropdown-item" href="{{ route('room_type.index') }}">Loại Phòng</a>
            <a class="dropdown-item" href="{{ route('room.index') }}">Phòng</a>
          
            
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản Lý Phim</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('cinema.index') }}">Rạp Phim</a>
            <a class="dropdown-item" href="{{ route('movie.index') }}">Phim</a>
            <a class="dropdown-item" href="{{ route('showtime.index') }}">Xuất Chiếu</a>
            <a class="dropdown-item" href="{{ route('slide.index') }}">Trạng Thái phim</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản Lý Ghế</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            
            <a class="dropdown-item" href="{{ route('seat.index') }}">Ghế</a>
            <a class="dropdown-item" href="{{ route('seat_type.index') }}">Loại Ghế</a>
            <a class="dropdown-item" href="{{ route('seat_price.index') }}">Giá Ghế</a>
       
            
        </div>
    </li>

    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ticket.index') }}">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>Vé</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adm-bill.index') }}">
            <i class="fas fa-money-bill"></i>
            <span>Hóa Đơn</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-users"></i>
            <span>Người Dùng</span>
        </a>
    </li>
    {{-- Map --}}
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('map.index') }}">
            <i class="fas fa-map-marked-alt"></i>
            <span>Maps</span>
        </a>
    </li> --}}
</ul>
