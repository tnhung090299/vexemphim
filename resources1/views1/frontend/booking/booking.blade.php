@extends('frontend.layouts.master')
@section('content')
<input type="hidden" class="getIdMovie" value="1">
<input type="hidden" class="getRouteMovie" value="{{ route('movie-detail.store') }}">
<input type="hidden" class="getNow" value="{{ \Carbon\Carbon::now() }}">
<section class="container">
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="{{ asset(config('app.image_url') . 'tickets.png') }}">
            <p class="order__title">{{ __('label.book') }}<br><span class="order__descript">{{ __('label.orderDescript') }}</span></p>
        </div>
    </div>
    {{-- <div class="order-step-area">
        <div class="order-step first--step">{{ __('label.firstStep') }}</div>
    </div> --}}
{{--     <h2 class="page-heading heading--outcontainer">{{ __('label.chooseMovie') }}</h2> --}}
</section>
<div class="col-sm-12">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#movie">{{ __('label.byMovie') }}</a></li>
        <li><a data-toggle="tab" href="#cinema">{{ __('label.byCinema') }}</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane  active" id="movie">
            <div class="choose-film">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($movies as $movie)
                            <div class="swiper-slide" data-film="{{ $movie->name }}" data-id="{{ $movie->id }}">
                                <img class="styleBgImage" src="{{ asset(config('app.upload_cover') . $movie->image) }}">
                                <p class="choose-film__title">{{ $movie->name }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>  
            <section class="container">
                <div class="col-sm-12">
                    <div class="choose-indector choose-indector--film">
                        <strong>{{ __('label.choosen') }}</strong><span class="choosen-area"></span>
                    </div>
                    <h2 class="page-heading">{{ __('label.cityDate') }}</h2>
                    <div class="choose-container choose-container--short ">
                        <div id="datepicker" class="input-group date col-md-3" data-date-format="yyyy-mm-dd">
                            <input class="form-control inputDate" readonly="" type="text">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span> 
                        </div>
                    </div>
                    <h2 class="page-heading">{{ __('label.pickTime') }}</h2>
                    <div class="choose-container">
                        <div class="clearfix"></div>
                        <div class="time-select"></div>
                    </div>
                </div>
            </section>
        </div>
        <div class="tab-pane" id="cinema">
            <section class="container">
                <div class="list-group col-md-4">
                    <a class="list-group-item active"><b>{{ __('label.selectCinema') }}</b></a>
                    @foreach ($cinemas as $cinema)
                        <a href="javascript:void(0)" class="list-group-item cinemaId" data-id="{{ $cinema->id }}">{{ $cinema->name }}</a>
                    @endforeach
                </div>
                <div class="list-group col-md-4">
                    <a class="list-group-item active"><b>{{ __('label.selectMovie') }}</b></a>
                    <div class="chooseMoive">
                        <a class="list-group-item">Vui lòng chọn phim</a>
                    </div>
                </div>
                <div class="list-group col-md-4">
                    <a class="list-group-item active"><b>{{ __('label.selectSession') }}</b></a>
                    <ul class="list-group chooseTime">
                        <li class="list-group-item">Vui lòng chọn suất</li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <form id='showtimeForm' class='booking-form' method="POST" action="{{ route('choose-seat.store') }}">
        @csrf
        <input type="hidden" name="showtime_id" id="showtime_id">
        <div id="booking-next" class="booking-pagination class-hide">
            <a href="#" class="booking-pagination__prev hide--arrow">
                <span class="arrow__text arrow--prev"></span>
                <span class="arrow__info"></span>
            </a>
            <button class="booking-pagination__next">
                <span class="arrow__text arrow--next">{{ __('label.nextStep') }}</span>
                <span class="arrow__info">{{ __('label.chooseSit') }}</span>
            </button>
        </div>
    </form>
    <input type="hidden" class="uploadCover" value="{{ asset(config('app.upload_cover')) }}">
    <form id="dateAndId">
        @csrf
        <input type="hidden" name="idFilter" class="idFilter">
        <input type="hidden" name="dateFilter" class="dateFilter">
    </form>
</div>
<input type="hidden" class="getIdCinema" value="">
@stop
@push('scripts')
<script type="text/javascript" src="{{ asset('custom-js/booking.js') }}"></script>
<script type="text/javascript">
    today = new Date()
    dayIndex = today.getDay()
    console.log(dayIndex)
    $('.cinemaId').click(function () {
        $('.chooseMoive').html(`<a class="list-group-item">Vui lòng chọn phim</a>`);
        $('.chooseTime').html(`<a class="list-group-item">Vui lòng chọn suất</a>`);
        $('.cinemaId').removeClass('text-right');
        $(this).addClass('text-right');
        var uploadCover = $('.uploadCover').val();
        var id = $(this).data('id');
        $('.getIdCinema').val(id);
        $.get( 'booking/' + id, function (data ) {
            var html = '';
            $.each(data, function(key, value) {
                html += `<a href="javascript:void(0)" class="list-group-item movieId" data-id="` + value.id + `"><img src="` + uploadCover + `/` + value.image + `">` + value.name + `</a>`;
            });
            $('.chooseMoive').html(html);
        });
    });
    $('body').on('click', '.movieId', function () {
        $('.movieId').removeClass('text-right');
        $(this).addClass('text-right');
        var id = $(this).data('id');
        var cinemaId = $('.getIdCinema').val();
        var arr = [cinemaId, id];

        $.get('booking/' + arr + '/edit', function (data) {
            var html = '';
            var check = 0;
            $.each(data, function (key, value) {
                html += `<li class="list-group-item">` + key;
                $.each(value, function(key1, value1) {

                    html += `<ul class="list-inline">` + key1 + ` -- `;
                    $.each(value1, function (key2, value2) {
                        html += `<li class="list-inline-item"><button type="button" data-id="` + value2.id + `" class="btn btn-default btn-sm showtimeId">` + value2.time + `</button></li>`;
                    })
                    html += `</ul>`;
                });
                html +=`</li>`;
            });
            $('.chooseTime').html(html);
        });
    });
    $('body').on('click', '.showtimeId', function () {
        var id = $(this).data('id');
        $('.showtimeId').removeClass('btn-info');
        $(this).addClass('btn-info');
        $('.class-hide').show();
        //gán showtime_id form
        $('#showtime_id').val(id);
    })
</script>
@endpush
