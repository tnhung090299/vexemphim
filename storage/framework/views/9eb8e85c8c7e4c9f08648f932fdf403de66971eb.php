<?php $__env->startSection('content'); ?>
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createNewRoom"><?php echo e(__('label.createNewRoom')); ?></a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.cinemaName')); ?></th>
                <th><?php echo e(__('label.roomType')); ?></th>
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
                <form id="roomForm" name="roomForm" class="form-horizontal">
                    <input type="hidden" name="room_id" id="room_id">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control" id="cinema_id" name="cinema_id">
                                <option value=''><?php echo e(__('label.chooseCinema')); ?></option>
                                <?php $__currentLoopData = $cinemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
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
                        <label for="name" class="col-sm-4 control-label"><?php echo e(__('label.name')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo e(__('label.enterName')); ?>" value="">
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
        order: [0, "desc"],
        ajax: "<?php echo e(route('room.index')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'cinema.name', name: 'cinema.name'},
            {data: 'room_type.name', name: 'room_type.name'},
            {data: 'name', name: 'name'},
            {data: 'note', name: 'note'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewRoom').click(function () {
        $('#saveBtn').val("create-room");
        $('#room_id').val('');
        $('#roomForm').trigger("reset");
        $('#modelHeading').html("<?php echo e(__('label.createNewRoom')); ?>");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editRoom', function () {
        var room_id = $(this).data('id');
        $.get("<?php echo e(route('room.index')); ?>" + '/' + room_id + '/edit', function (data) {
            $('#modelHeading').html("<?php echo e(__('label.editRoom')); ?>");
            $('#saveBtn').val("edit-room");
            $('#ajaxModel').modal('show');
            $('#room_id').val(data.id);
            $('#cinema_id').val(data.cinema_id);
            $('#room_type_id').val(data.room_type_id);
            $('#name').val(data.name);
            $('#note').val(data.note);
        })
    });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#roomForm').serialize(),
            url: "<?php echo e(route('room.store')); ?>",
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
    $('body').on('click', '.deleteRoom', function () {
        var room_id = $(this).data("id");
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
                url: "<?php echo e(route('room.store')); ?>" + '/' + room_id,
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/cinema/room.blade.php ENDPATH**/ ?>