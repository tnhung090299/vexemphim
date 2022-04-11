@extends('admin.layouts.master')
@section('content')
<div class="container">
    <a class="btn btn-success" href="javascript:void(0)" id="createShowtime">{{ __('label.createShowtime') }}</a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>{{ __('label.id') }}</th>
                <th>{{ __('label.movie') }}</th>
                <th>{{ __('label.room') }}</th>
                <th>{{ __('label.timestart') }}</th>
                <th>{{ __('label.created_at') }}</th>
                <th>{{ __('label.updated_at') }}</th>
                <th>{{ __('label.action') }}</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div id="error" class="alert alert-danger print-error-msg">
                <ul></ul>
            </div>
            <div class="modal-body">
                <form id="showtimeForm" name="showtimeForm" class="form-horizontal">
                    <input type="hidden" name="showtime_id" id="showtime_id">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select id="movie_id" name="movie_id">
                                <option value=''>{{ __('label.chooseMovie') }}</option>
                                @foreach ($movies as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select id="cinema_id" name="cinema_id">
                                <option value=''>{{ __('label.chooseCinema') }}</option>
                                @foreach ($cinemas as $cinema)
                                    <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select id="room_id" class="hideClass" name="room_id">
                                <option value=''>{{ __('label.chooseRoom') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <ul class="list-group hideClass"></ul>
                        </div>
                    </div>  
                    <div class="form-group takeTime">
                        <label for="timestart" class="col-sm-4 control-label">{{ __('label.timestart') }}</label>
                        <div class="row col-sm-12">
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="timestart_day" name="timestart_day" value="">
                            </div>
                            <div class="col-sm-6">
                                <input type="time" class="form-control" id="timestart_time" name="timestart_time" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">{{ __('label.saveChange') }}
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewShowtime" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="choose-sits">   
                <div class="col-sm-12 col-lg-offset-1">
                <div class="sits-area hidden-xs">
                    <div class="sits-anchor">screen</div>
                    <div class="sits"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script type="text/javascript">
    $('#movie_id').on('change', function() {
        var a = this.value;
        $('#room_id').on('change', function() {
            var b = this.value;
            if (a > 0 && b > 0) {
                var string = a + '-' + b;
                $.get("{{ route('room.index') }}" + '/' + string, function (data) {
                    $('.list-group').show();
                    var html = `<li class="list-group-item active">Empty time for three days with ` + data.time + ` min</li>`;
                    delete data.time;
                    if (jQuery.isEmptyObject(data)) {
                        html += `<li class="list-group-item">Not empty</li>`
                        $('.takeTime').hide();
                    } else {
                        $.each(data, function (key, value) {
                            html += `<li class="list-group-item">` + value + `</li>`
                        })
                        $('.takeTime').show();
                    }

                    $('.list-group').html(html);
                })
            }
        });
    });
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
            }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        order: [0, "desc"],
        ajax: "{{ route('showtime.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'movie.name', name: 'movie.name'},
            {data: 'room.name', name: 'room.name'},
            {data: 'timestart', name: 'timestart'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createShowtime').click(function () {
        $('#saveBtn').val("create-room");
        $('#showtime_id').val('');
        $('#showtimeForm').trigger("reset");
        $('#modelHeading').html("{{ __('label.createShowtime') }}");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editShowtime', function () {
        var showtime_id = $(this).data('id');
        $.get("{{ route('showtime.index') }}" + '/' + showtime_id + '/edit', function (data) {
            $('#modelHeading').html("{{ __('label.editShowtime') }}");
            $('.list-group').hide();
            $('.takeTime').show();
            $('#cinema').val(data.room.cinema.id);
            var room_id = data.room.id;
            $.get("{{ route('seat.index') }}" + '/' + data.room.cinema.id, function (data) {
                var html = `<option value=''>{{ __('label.chooseRoom') }}</option>`;
                $.each(data, function (key, value) {
                    html += `<option value="` + value.id + `">` + value.name + `</option>`;
                });
                $('#room_id').html(html);
                $('#room_id').val(room_id);
            })
            $('#room_id').show();
            $('#saveBtn').val("edit-showtime");
            $('#showtime_id').val(data.id);
            $('#movie_id').val(data.movie_id);
            $('#room_id').val(data.room_id);
            $('#timestart_day').val(data.timestart.split(" ")[0]);
            $('#timestart_time').val(data.timestart.split(" ")[1]);
            $('#ajaxModel').modal('show');
        })
    });
    $('body').on('click', '.viewShowtime', function () {
        var showtime_id = $(this).data('id');
        $.get("{{ route('showtime.index') }}" + '/' + showtime_id, function (data) {
            $('#viewShowtime').modal('show');
            var html = '';
            var arr = [];
            $.each(data[0].tickets, function (k, v) {
                arr.push(v.seat_col_id);
            });
            $.each(data[0].room.seat_rows, function (key, value) {
                html = html + `<div class="sits__row">`;
                $.each(value.seat_cols, function (key2, value2) {
                    if (arr.indexOf(value2.id) != -1) {
                        html = html + `<span class="sits__place sits-price--cheap sits-state--not">` + value2.seat_name + `</span>`;
                    } else if (value.seat_type_id == 1) {
                        html = html + `<span class="sits__place sits-price--cheap">` + value2.seat_name + `</span>`;
                    } else if (value.seat_type_id == 2) {
                        html = html + `<span class="sits__place sits-price--middle">` + value2.seat_name + `</span>`;
                    } else if (value.seat_type_id == 3) {
                        html = html + `<span class="sits__place sits-price--expensive">` + value2.seat_name + `</span>`;
                    }
                })
                html = html + `</div>`;
            })
            $('.sits').html(html);
        })
    });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('{{ __('label.sending') }}');
        $.ajax({
            data: $('#showtimeForm').serialize(),
            url: "{{ route('showtime.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#roomTypeForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                swal("Saved!", data.success, "success");
                $('#saveBtn').html('{{ __('label.saveChange') }}');
            },
            error: function(data) {
                var x = JSON.parse(data.responseText);
                printErrorMsg(x.errors);
                setTimeout(function(){
                        $('#error').hide();
                    }, 3000);
                $('#saveBtn').html('{{ __('label.saveChange') }}');
            }
        });
    });
    $('body').on('click', '.deleteShowtime', function () {
        var showtime_id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                type: "DELETE",
                url: "{{ route('showtime.store') }}" + '/' + showtime_id,
                success: function (data) {
                    table.draw();
                    swal(data.success, {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                    swal("Error!", "Something went wrong!", "error");
                }
            });
                
            } else {
                swal("Cancelled!");
            }
        });
    });    
});
$('#cinema_id').on('change', function() {
    $('#room_id').show();
    var cinema_id = this.value;
    if (cinema_id > 0) {
        $.get("{{ route('seat.index') }}" + '/' + cinema_id, function (data) {
            var html = `<option value=''>{{ __('label.chooseRoom') }}</option>`;
            $.each(data, function (key, value) {
                html += `<option value="` + value.id + `">` + value.name + `</option>`;
            });
            $('#room_id').html(html);
        })
    } else $('#room_id').hide();
});
function printErrorMsg (msg) {
    $('.print-error-msg').find('ul').html('');
    $('.print-error-msg').css('display', 'block');
    $.each( msg, function( key, value ) {
        $('.print-error-msg').find('ul').append('<li>' + value + '</li>');
    });
}
</script>
@endpush
