<?php $__env->startSection('content'); ?>
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createSeatPrice"><?php echo e(__('label.createSeatPrice')); ?></a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.roomType')); ?></th>
                <th><?php echo e(__('label.seatType')); ?></th>
                <th><?php echo e(__('label.price')); ?></th>
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
                <form id="seatPriceForm" name="seatPriceForm" class="form-horizontal">
                    <input type="hidden" name="seat_price_id" id="seat_price_id">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control" id="room_type_id" name="room_type_id">
                                <option value=''><?php echo e(__('label.chooseRoomType')); ?></option>
                                <?php $__currentLoopData = $room_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <label for="name" class="col-sm-2 control-label"><?php echo e(__('label.price')); ?></label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="price" name="price" placeholder="<?php echo e(__('label.enterPrice')); ?>" value="">
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
        ajax: "<?php echo e(route('seat_price.index')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'room_type.name', name: 'room_type.name'},
            {data: 'seat_type.name', name: 'seat_type.name'},
            {data: 'price', name: 'price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createSeatPrice').click(function () {
        $('#saveBtn').val("create-room");
        $('#seat_price_id').val('');
        $('#seatPriceForm').trigger("reset");
        $('#modelHeading').html("<?php echo e(__('label.createSeatPrice')); ?>");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editSeatPrice', function () {
        var seat_price_id = $(this).data('id');
        $.get("<?php echo e(route('seat_price.index')); ?>" + '/' + seat_price_id + '/edit', function (data) {
            $('#modelHeading').html("<?php echo e(__('label.editSeatPrice')); ?>");
            $('#saveBtn').val("edit-room");
            $('#ajaxModel').modal('show');
            $('#seat_price_id').val(data.id);
            $('#room_type_id').val(data.room_type_id);
            $('#seat_type_id').val(data.seat_type_id);
            $('#price').val(data.price);
        })
    });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#seatPriceForm').serialize(),
            url: "<?php echo e(route('seat_price.store')); ?>",
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
    $('body').on('click', '.deleteSeatPrice', function () {
        var seat_price_id = $(this).data("id");
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
                url: "<?php echo e(route('seat_price.store')); ?>" + '/' + seat_price_id,
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
function printErrorMsg (msg) {
    $('.print-error-msg').find('ul').html('');
    $('.print-error-msg').css('display', 'block');
    $.each( msg, function( key, value ) {
        $('.print-error-msg').find('ul').append('<li>' + value + '</li>');
    });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/cinema/seat_price.blade.php ENDPATH**/ ?>