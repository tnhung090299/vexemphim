<?php $__env->startSection('content'); ?>
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createSeatType"><?php echo e(__('label.createSeatType')); ?></a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.name')); ?></th>
                <th><?php echo e(__('label.note')); ?></th>
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
                <form id="seatTypeForm" name="seatTypeForm" class="form-horizontal">
                   <input type="hidden" name="seat_type_id" id="seat_type_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label"><?php echo e(__('label.name')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo e(__('label.enterName')); ?>" value="" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo e(__('label.note')); ?></label>
                        <div class="col-sm-12">
                            <textarea id="note" name="note" placeholder="<?php echo e(__('label.enterNote')); ?>" class="form-control"></textarea>
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
        ajax: "<?php echo e(route('seat_type.index')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'note', name: 'note'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createSeatType').click(function () {
        $('#saveBtn').val("create-seat_type");
        $('#seat_type_id').val('');
        $('#seatTypeForm').trigger("reset");
        $('#modelHeading').html("<?php echo e(__('label.createSeatType')); ?>");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editSeatType', function () {
        var seat_type_id = $(this).data('id');
        $.get("<?php echo e(route('seat_type.index')); ?>" + '/' + seat_type_id + '/edit', function (data) {
            $('#modelHeading').html("<?php echo e(__('label.editCinema')); ?>");
            $('#saveBtn').val("edit-seat_type");
            $('#ajaxModel').modal('show');
            $('#seat_type_id').val(data.id);
            $('#name').val(data.name);
            $('#address').val(data.address);
            $('#note').val(data.note);
        })
    });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#seatTypeForm').serialize(),
            url: "<?php echo e(route('seat_type.store')); ?>",
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
    $('body').on('click', '.deleteSeatType', function () {
        var seat_type_id = $(this).data("id");
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
                url: "<?php echo e(route('seat_type.store')); ?>" + '/' + seat_type_id,
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/cinema/seat_type.blade.php ENDPATH**/ ?>