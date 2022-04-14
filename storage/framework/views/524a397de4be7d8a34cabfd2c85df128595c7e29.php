<?php $__env->startSection('content'); ?>
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createShowtime"><?php echo e(__('label.createShowtime')); ?></a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.movie')); ?></th>
                <th><?php echo e(__('label.room')); ?></th>
                <th><?php echo e(__('label.timestart')); ?></th>
                <th><?php echo e(__('label.action')); ?></th>
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
                            <select class="form-control" id="movie_id" name="movie_id">
                                <option value=''><?php echo e(__('label.chooseMovie')); ?></option>
                                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control" id="cinema_id" name="cinema_id">
                                <option value=''><?php echo e(__('label.chooseCinema')); ?></option>
                                <?php $__currentLoopData = $cinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cinema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cinema->id); ?>"><?php echo e($cinema->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control" id="room_id" class="hideClass" name="room_id">
                                <option value=''><?php echo e(__('label.chooseRoom')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <ul class="list-group hideClass"></ul>
                        </div>
                    </div>  
                    <div class="form-group takeTime">
                        <label for="timestart" class="col-sm-4 control-label"><?php echo e(__('label.timestart')); ?></label>
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
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create"><?php echo e(__('label.saveChange')); ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    $('#movie_id').on('change', function() {
        var a = this.value;
        $('#room_id').on('change', function() {
            var b = this.value;
            if (a > 0 && b > 0) {
                var string = a + '-' + b;
                $.get("<?php echo e(route('room.index')); ?>" + '/' + string, function (data) {
                    $('.list-group').show();
                    var html = `<li class="list-group-item active">Khoản Thời Gian Trống  ` + data.time + ` min</li>`;
                    delete data.time;
                    if (jQuery.isEmptyObject(data)) {
                        html += `<li class="list-group-item">Trống</li>`
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
        ajax: "<?php echo e(route('showtime.index')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'movie.name', name: 'movie.name'},
            {data: 'room.name', name: 'room.name'},
            {data: 'timestart', name: 'timestart'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createShowtime').click(function () {
        $('#saveBtn').val("create-room");
        $('#showtime_id').val('');
        $('#showtimeForm').trigger("reset");
        $('#modelHeading').html("<?php echo e(__('label.createShowtime')); ?>");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editShowtime', function () {
        var showtime_id = $(this).data('id');
        $.get("<?php echo e(route('showtime.index')); ?>" + '/' + showtime_id + '/edit', function (data) {
            $('#modelHeading').html("<?php echo e(__('label.editShowtime')); ?>");
            $('.list-group').hide();
            $('.takeTime').show();
            $('#cinema').val(data.room.cinema.id);
            var room_id = data.room.id;
            $.get("<?php echo e(route('seat.index')); ?>" + '/' + data.room.cinema.id, function (data) {
                var html = `<option value=''><?php echo e(__('label.chooseRoom')); ?></option>`;
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
        $.get("<?php echo e(route('showtime.index')); ?>" + '/' + showtime_id, function (data) {
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
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#showtimeForm').serialize(),
            url: "<?php echo e(route('showtime.store')); ?>",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#roomTypeForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                swal("Saved!", data.success, "success");
                $('#saveBtn').html('<?php echo e(__('label.saveChange')); ?>');
            },
            error: function(data) {
                var x = JSON.parse(data.responseText);
                printErrorMsg(x.errors);
                setTimeout(function(){
                        $('#error').hide();
                    }, 3000);
                $('#saveBtn').html('<?php echo e(__('label.saveChange')); ?>');
            }
        });
    });
    $('body').on('click', '.deleteShowtime', function () {
        var showtime_id = $(this).data("id");
        swal({
            title: "Bạn chắc chắn xóa chứ!",
            text: "Một Khi bạn ấn xóa, dử liệu này của bạn sẽ không thể khôi phục được!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                type: "DELETE",
                url: "<?php echo e(route('showtime.store')); ?>" + '/' + showtime_id,
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
        $.get("<?php echo e(route('seat.index')); ?>" + '/' + cinema_id, function (data) {
            var html = `<option value=''><?php echo e(__('label.chooseRoom')); ?></option>`;
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\admin\cinema\showtime.blade.php ENDPATH**/ ?>