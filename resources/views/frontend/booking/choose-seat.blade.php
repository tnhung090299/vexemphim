@extends('frontend.layouts.master')
@section('content')
<div class="place-form-area">
    <section class="container">
        <div class="order-container">
            <div class="order">
                <img class="order__images" alt='' src="{{ asset(config('app.image_url') . 'movieticket.png') }}">
                
                <p class="order__title">{{ __('label.book') }}<br><span class="order__descript">{{ __('label.orderDescript') }}</span></p>
            </div>
        </div>
        <div class="order-step-area">
            <div class="order-step first--step order-step--disable ">{{ __('label.firstStep') }}</div>
            <div class="order-step second--step">{{ __('label.secondStep') }}</div>
        </div>
        <div class="choose-sits">
            <div class="col-sm-12 col-lg-10 col-lg-offset-1">
                <div class="sits-area hidden-xs">
                    <div class="sits-anchor">{{ __('screen') }}</div>
                    <div class="sits">
                        <aside class="sits__line">
                            @foreach ($seatRow as $seat)
                                <span class="sits__indecator">{{ $seat->row_name }}</span>
                            @endforeach
                        </aside>
                            @foreach ($seatCol as $seatRow)
                                <div class="sits__row">
                                    @foreach ($seatRow->seatCols as $data)
                                        @if ($data->tickets_count > 0)
                                            <span class="sits__place sits-price--cheap sits-state--not" data-id="-999">Empty</span>
                                        @else
                                            @if ($seatRow->seat_type_id == 1)
                                                <span class="sits__place sits-price--cheap" data-id='{{ $data->id }}' data-place='{{ $data->seat_name }}' data-price='{{ $seatRow->seatType->seatPrices[0]->price }}'>{{ $data->seat_name }}</span>
                                            @elseif ($seatRow->seat_type_id == 2)
                                                <span class="sits__place sits-price--middle" data-id='{{ $data->id }}'  data-place='{{ $data->seat_name }}' data-price='{{ $seatRow->seatType->seatPrices[0]->price }}'>{{ $data->seat_name }}</span>
                                            @elseif ($seatRow->seat_type_id == 3)
                                                <span class="sits__place sits-price--expensive" data-id='{{ $data->id }}'  data-place='{{ $data->seat_name }}' data-price='{{ $seatRow->seatType->seatPrices[0]->price }}'>{{ $data->seat_name }}</span>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        <aside class="sits__checked">
                            <div class="checked-place">
                            </div>
                            <div class="checked-result">
                                {{ __('0 đ') }}
                            </div>
                        </aside>
                        <footer class="sits__number">
                            @for ($i = 1; $i <= $max; $i++)
                                <span class="sits__indecator">{{ $i }}</span>
                            @endfor
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="clearfix"></div>
<input type="hidden" name="seatSelected" class="seatSelected" value="{{ $seatSelected }}">
<form id='showtimeForm' method="POST" action="{{ route('payment.store') }}">
    @csrf
    <input type="hidden" name="seatId[]" id="seatId">   
    <input type="hidden" name="showtimeId" id="showtimeId" value="{{ $id }}">
    <input type="hidden" name="result" id="result">
    <div id="booking-next" class="booking-pagination">
        <a href="{{ URL::previous() }}" class="booking-pagination__prev">
            <span class="arrow__text arrow--prev">{{ __('label.prevStep') }}</span>
            <span class="arrow__info">{{ __('label.firstStep') }}</span>
        </a>
        <div class="class-hide">
            <button type="submit" class="booking-pagination__next">
                <span class="arrow__text arrow--next">{{ __('label.nextStep') }}</span>
                <span class="arrow__info">{{ __('label.checkout') }}</span>
            </button>
        </div>
    </div>
</form>
@stop
@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.sits__place').click(function () {
        //data element init
        var chooseTime = $(this).attr('data-time');
        var id = $(this).attr('data-id');
        $('.class-hide').show();
    });
    init_BookingTwo();
</script>
<script src="https://js.pusher.com/4.0/pusher.js"></script>
<script type="text/javascript">
    var a = jQuery.parseJSON($('.seatSelected').val());
    $('.sits__place').each(function () {
        var val = $(this).data('id');
        var check = a.indexOf(val.toString());
        if (check != -1) {
            $(this).addClass('somebody-choseen');
        } else {
            $(this).removeClass('somebody-choseen');
        }
    })

    $(document).ready(function (){

        var pusher = new Pusher('ce71fbaacd844a8dda04', {
            cluster: 'ap1',
            forceTLS: true
        });

        var showtimeId = $('#showtimeId').val();
        var channel = pusher.subscribe('queue');
        channel.bind('mess', function(data) {
            if (data.showtime == showtimeId) {
                if ({{ Auth::id() }} != data.user) {
                    if (data.seats != null) {
                        $('.sits__place').each(function () {
                            var val = $(this).data('id');
                            var check = data.seats.indexOf(val.toString());
                            if (check != -1) {
                                $(this).addClass('somebody-choseen');
                            } else {
                                $(this).removeClass('somebody-choseen');
                            }
                        })
                    } else $('.sits__place').removeClass('somebody-choseen');
                }
            }
        });
    })
</script>
@endpush
