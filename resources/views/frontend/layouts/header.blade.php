<!-- Header section -->
<header class="header-wrapper">
    <div class="container">
        <!-- Logo link-->
        <a href="{{ route('home') }}" class="logo">
            <img alt='logo' src="{{ asset(config('app.image_url') . 'logo.png') }}">
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
                    <a href="#">{{ __('label.movie') }}</a>
                    <ul class="mega-menu container">
                        <li class="col-md-6 mega-menu__coloum">
                            <a href="{{ route('now-showing') }}"><h4 href='' class="mega-menu__heading">{{ __('label.now') }}</h4></a>
                            @foreach ($new as $data)
                                <div class="gallery-item col-md-6">
                                    <a href='{{ route('movie-detail.show', ['id' => $data->id]) }}' class="gallery-item__image">
                                        <img class="resize-menu-movie" alt='' src="{{ asset(config('app.upload_cover') . $data->image) }}">
                                    </a>
                                    <a class="text-overflow">{{ $data->name }}</a>
                                </div>
                            @endforeach
                        </li>
                        <li class="col-md-6 mega-menu__coloum">
                            <a href="{{ route('comming-soon') }}"><h4 class="mega-menu__heading">{{ __('label.soon') }}</h4></a>
                            @foreach ($soon as $data)
                                <div class="gallery-item col-md-6">
                                    <a href='{{ route('movie-detail.show', ['id' => $data->id]) }}' class="gallery-item__image">
                                        <img class="resize-menu-movie" alt='' src="{{ asset(config('app.upload_cover') . $data->image) }}">
                                    </a>
                                    <a class="text-overflow">{{ $data->name }}</a>
                                </div>
                            @endforeach
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">{{ __('label.support') }}</a>
                </li>
            </ul>
        </nav>
        <div class="control-panel right40">
            <input type="search" name="search" id="searchNav" title="Search" class="typeahead" placeholder="Search">
        </div>
        <!-- Additional header buttons / Auth and direct link to booking-->
        <div class="control-panel right5">
            <div class="col-md-9">
                @guest
                    <!-- <div class="control-panel"> -->
                    <a href="{{ route('login') }}" class="btn btn--sign">{{ __('label.login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn--sign">{{ __('label.reg') }}</a>
                @endif
                @else
                    <!-- <div class="control-panel"> -->
                    <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"> 
                            {{ Auth::user()->name }}
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile.index') }}">{{ __('label.profile') }}</a></li>
                            <li>
                                <a href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    Đăng Xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div> 
                @endguest
            </div>
            <div class="col-md-3">
                <a href="{{ route('booking.index') }}" class="btn btn-md btn--warning btn--book btn-control--home">{{ __('label.book') }}</a>
            </div>
        </div>
        <div class="control-panel lang-right">
            <a href="{{ route('lang', ['lang' => 'vi']) }}"><span class="flag-icon flag-icon-vn"></span></a>
            <a href="{{ route('lang', ['lang' => 'en' ]) }}"><span class="flag-icon flag-icon-gb"></span></a>
        </div>
    </div>
    <input type="hidden" class="notFound" value="{{ __('label.notFound') }}">
    <input type="hidden" class="linkUploadCover" value="{{ asset(config('app.upload_cover')) }}">
    <input type="hidden" class="routeMovieDetail" value="{{ route('movie-detail.index') }}">
</header>
@push('scripts')
    <script type="text/javascript" src="{{ asset('custom-js/header.js') }}"></script>
@endpush
