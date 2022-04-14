<?php $__env->startSection('content'); ?>
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createSeatRow"><?php echo e(__('label.createSeatRow')); ?></a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.room')); ?></th>
                <th><?php echo e(__('label.seatType')); ?></th>
                <th><?php echo e(__('label.name')); ?></th>
                <th><?php echo e(__('label.seatCols')); ?></th>
                <th><?php echo e(__('label.action')); ?></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="ajaxSeat" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeadingSeat"></h4>
            </div>
            <div id="error" class="alert alert-danger print-error-msg">
                <ul></ul>
            </div>
            <div class="modal-body">
                <form id="seatColForm" name="seatColForm" class="form-horizontal">
                    <input type="hidden" name="seat_row_id" id="seat_row_id">
                    <div class="form-group">
                        <label for="seat_quantity" class="col-sm-2 control-label"><?php echo e(__('label.quantity')); ?></label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="seat_quantity" name="seat_quantity" placeholder="<?php echo e(__('label.enterQuantityAdd')); ?>" value="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="addBtn" value="addCol"><?php echo e(__('label.saveChange')); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxSeatCol" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelSeatCol"></h4>
            </div>
            <div class="modal-body">
                <form id="seatColForm" name="seatColForm" class="form-horizontal">
                    <input type="hidden" name="seat_col_id" id="seat_col_id">
                    <div class="form-group">
                        <label for="seat_col_name" class="col-sm-2 control-label"><?php echo e(__('label.seat')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="seat_col_name" name="seat_col_name" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="seat_status" class="col-sm-2 control-label"><?php echo e(__('label.status')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="seat_status" name="seat_status" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="created_at" class="col-sm-2 control-label"><?php echo e(__('label.created_at')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="created_at" name="created_at" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="updated_at" class="col-sm-2 control-label"><?php echo e(__('label.updated_at')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="updated_at" name="updated_at" readonly>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-12">
                        <button href="javascript:void(0)" data-toggle="tooltip" class="btn btn-danger btn-sm deleteSeatCol float-right"><?php echo e(__('label.delete')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                <form id="seatRowForm" name="seatRowForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
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
                            <select class="form-control" id="seat_type_id" name="seat_type_id">
                                <option value=''><?php echo e(__('label.chooseSeatType')); ?></option>
                                <?php $__currentLoopData = $seat_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="row_name" class="col-sm-2 control-label"><?php echo e(__('label.name')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="row_name" name="row_name" placeholder="<?php echo e(__('label.enterName')); ?>" value="">
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
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
        ajax: "<?php echo e(route('seat.index')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'room.name', name: 'room.name'},
            {data: 'seat_type.name', name: 'seat_type.name'},
            {data: 'row_name', name: 'row_name'},
            {data: 'seat_cols', name: 'seat_cols', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createSeatRow').click(function () {
        $('#saveBtn').val("create-room");
        $('#id').val('');
        $('#seatRowForm').trigger("reset");
        $('#modelHeading').html("<?php echo e(__('label.createSeatRow')); ?>");
        $('#room_id').hide();
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editSeatRow', function () {
        var id = $(this).data('id');
        $.get("<?php echo e(route('seat.index')); ?>" + '/' + id + '/edit', function (data) {
            $('#modelHeading').html("<?php echo e(__('label.editSeatname')); ?>");
            $('#saveBtn').val("edit-room");
            $('#id').val(id);
            $('#cinema_id').val(data.room.cinema.id)
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
            $('#seat_type_id').val(data.seat_type_id);
            $('#row_name').val(data.row_name);
            $('#seat_cols').val(data.seat_cols);
            $('#ajaxModel').modal('show');
        })
    });
    $('body').on('click', '.addSeatCol', function () {
        var seat_row_id = $(this).data('id');
        $('#modelHeadingSeat').html("<?php echo e(__('label.addSeat')); ?>");
        $('#addBtn').val("add-seat");
        $('#ajaxSeat').modal('show');
        $('#seat_row_id').val(seat_row_id);
        $('#seat_quantity').val('');
    });
    $('body').on('click', '.editSeatCol', function () {
        var seat_col_id = $(this).data('id');
        $.get("<?php echo e(route('seat_col.index')); ?>" + '/' + seat_col_id + '/edit', function (data) {
            $('#modelSeatCol').html("<?php echo e(__('label.seatInfo')); ?>");
            $('#addBtn').val("edit-seat");
            $('#ajaxSeatCol').modal('show');
            $('#seat_col_id').val(seat_col_id);
            $('.deleteSeatCol').val(seat_col_id);
            $('#seat_col_name').val(data.seat_name);
            $('#seat_status').val(data.status);
            $('#created_at').val(data.created_at);
            $('#updated_at').val(data.updated_at);
        })
    });
    $('body').on('click', '.addSeatRow', function () {
        var seat_col_id = $(this).data('id');
        $.get("<?php echo e(route('seat_col.index')); ?>" + '/' + seat_col_id, function (data) {
            swal("Saved!", data.success, "success");
            table.draw();
        });
    })
    $('#addBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#seatColForm').serialize(),
            url: "<?php echo e(route('seat_col.store')); ?>",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#seatColForm').trigger("reset");
                $('#ajaxSeat').modal('hide');
                table.draw();
                swal("Saved!", data.success, "success");
                $('#addBtn').html('<?php echo e(__('label.saveChange')); ?>');
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
    $('.deleteSeatCol').click(function (e) {
        var id = $('.deleteSeatCol').val();
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            type: "DELETE",
                url: "<?php echo e(route('seat_col.store')); ?>" + '/' + id,
                success: function (data) {
                    $('#ajaxSeatCol').modal('hide');
                    table.draw();
                    swal("Done!", data.success, "success");
                    $('.deleteSeatCol').html('<?php echo e(__('label.delete')); ?>');
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('.deleteSeatCol').html('<?php echo e(__('label.delete')); ?>');
                }
        });
    });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#seatRowForm').serialize(),
            url: "<?php echo e(route('seat.store')); ?>",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#seatRowForm').trigger("reset");
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
    $('body').on('click', '.deleteSeatRow', function () {
        var id = $(this).data("id");
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
                url: "<?php echo e(route('seat.store')); ?>" + '/' + id,
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\admin\cinema\seat.blade.php ENDPATH**/ ?>