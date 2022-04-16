<?php $__env->startSection('content'); ?>
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createUser"><?php echo e(__('label.createUser')); ?></a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.name')); ?></th>
                <th><?php echo e(__('label.email')); ?></th>
                <th><?php echo e(__('label.role')); ?></th>
                <th><?php echo e(__('label.created_at')); ?></th>
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
                <form id="UserForm" name="UserForm" class="form-horizontal">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo e(__('label.Name')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo e(__('label.enterName')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo e(__('label.Email')); ?></label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo e(__('label.enterEmail')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo e(__('label.Password')); ?></label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo e(__('label.enterPassword')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo e(__('label.Address')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="<?php echo e(__('label.enterAddress')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo e(__('label.Mobile')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="<?php echo e(__('label.enterMobile')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo e(__('label.Role')); ?></label>
                        <select name="role" id="role" class="form-control" style="width: 94%; margin-left: 13px;">
                            <option class="isblue" value="0">User</option>
                            <option class="isblue" value="1">Admin</option>
                        </select><br>
                        <script>
                            $('#role').selectize({
                                maxItems: 1,
                                closeAfterSelect:true,
                                highlight:true,
                                selectOnTab:true,
                            });
                        </script>
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
        ajax: "<?php echo e(route('user.index')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {
                data: 'role',
                name: 'role', 
                render: function (data) {
                    switch (data){
                        case 1:
                            return "<?php echo e(__('label.admin')); ?>";
                            break;
                        default:
                            return "<?php echo e(__('label.user')); ?>";
                            break;
                    }
                },
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createUser').click(function () {
        $('#saveBtn').val("create-user");
        $('#user_id').val('');
        $('#UserForm').trigger("reset");
        $('#modelHeading').html("<?php echo e(__('label.createUser')); ?>");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editUser', function () {
        var user_id = $(this).data('id');
        $.get("<?php echo e(route('user.index')); ?>" + '/' + user_id + '/edit', function (data) {
            $('#modelHeading').html("<?php echo e(__('label.editUser')); ?>");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#address').val(data.address);
            $('#mobile').val(data.mobile);
            $('#role').val(data.role);
        })
    });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#UserForm').serialize(),
            url: "<?php echo e(route('user.store')); ?>",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#UserForm').trigger("reset");
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
    $('body').on('click', '.deleteUser', function () {
        var user_id = $(this).data("id");
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
                url: "<?php echo e(route('user.store')); ?>" + '/' + user_id,
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/cinema/user.blade.php ENDPATH**/ ?>