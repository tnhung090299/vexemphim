<?php $__env->startSection('content'); ?>
<div class="container"> 
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createMovie"><?php echo e(__('label.createMovie')); ?></a><a id="mess"></a>
    <table class="display data-table">
        <thead>
            <tr>
                <th></th>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.name')); ?></th>
                <th><?php echo e(__('label.duration')); ?></th>
                <th><?php echo e(__('label.status')); ?></th>
                <th><?php echo e(__('label.action')); ?></th>
            </tr>
        </thead>
        <tbody>
           
               
		
		</tbody>
    </table>
    
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div id="error" class="alert alert-danger print-error-msg">
                <ul></ul>
            </div>
            <div class="modal-body">
                <form id="movieForm" name="movieForm" enctype="multipart/form-data" class="form-horizontal">
                   <input type="hidden" name="movie_id" id="movie_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label"><?php echo e(__('label.name')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo e(__('label.enterName')); ?>" value="">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <div class="form-group col-sm">
                            <label class=" control-label"><?php echo e(__('label.status')); ?></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="status" name="status">
                                    <option value=""><?php echo e(__('label.chooseStatus')); ?></option>
                                    <option value="1"><?php echo e(__('Đang chiếu')); ?></option>
                                    <option value="2"><?php echo e(__('Sắp chiếu')); ?></option>
                                    <option value="3"><?php echo e(__('Đã đóng')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label class="  control-label"><?php echo e(__('label.duration')); ?></label>
                            <div class="col-sm-12">
                                <input type="number" id="duration" name="duration" placeholder="<?php echo e(__('label.enterDuration')); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label for="country" class="  control-label"><?php echo e(__('label.country')); ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="country" name="country" placeholder="<?php echo e(__('label.enterCountry')); ?>" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <div class="form-group col-sm">
                            <label for="director" class="  control-label"><?php echo e(__('label.director')); ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="director" name="director" placeholder="<?php echo e(__('label.enterDirector')); ?>" value="">
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label for="type" class="  control-label"><?php echo e(__('label.type')); ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="type" name="type" placeholder="<?php echo e(__('label.enterType')); ?>" value="">
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label for="producer" class="  control-label"><?php echo e(__('label.product')); ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="producer" name="producer" placeholder="<?php echo e(__('label.enterProduct')); ?>" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="actor" class=" control-label"><?php echo e(__('label.actor')); ?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="actor" name="actor" placeholder="<?php echo e(__('label.enterActor')); ?>" value="">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <div class="form-group col-sm">
                            <label for="day_start" class="control-label"><?php echo e(__('label.dayStart')); ?></label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="day_start" name="day_start" placeholder="<?php echo e(__('label.enterName')); ?>" value="">
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label for="image" class="control-label"><?php echo e(__('label.coverImage')); ?></label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <label for="trailer" class="control-label"><?php echo e(__('label.trailer')); ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="trailer" name="trailer" placeholder="<?php echo e(__('label.enterTrailer')); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo e(__('label.content')); ?></label>
                        <div class="col-sm-12">
                            <textarea id="content" name="content" placeholder="<?php echo e(__('label.enterContent')); ?>" class="form-control"></textarea>
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
        order: [1, "desc"],
        ajax: "<?php echo e(route('movie.index')); ?>",
        columns: [
            {
                data: null,
                className: 'details-control',
                orderable: false,
                searchable: false,
                defaultContent: '',
            },
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'time', name: 'duration'},
            {
                data: 'status',
                name: 'status', 
                render: function (data) {
                    switch (data){
                        case '1':
                            return "<?php echo e(__('label.showing')); ?>";
                            break;
                        case '2':
                            return "<?php echo e(__('label.soon')); ?>";
                            break;
                        case '3':
                            return "<?php echo e(__('label.closed')); ?>";
                            break;
                        default:
                            return "<?php echo e(__('label.fail')); ?>";
                            break;
                    }
                },
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createMovie').click(function () {
        $('#saveBtn').val("create-cinema");
        $('#movie_id').val('');
        $('#movieForm').trigger("reset");
        $('#modelHeading').html("<?php echo e(__('label.createMovie')); ?>");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editMovie', function () {
        var movie_id = $(this).data('id');
        $.get("<?php echo e(route('movie.index')); ?>" + '/' + movie_id + '/edit', function (data) {
            $('#modelHeading').html("<?php echo e(__('label.editMovie')); ?>");
            $('#saveBtn').val("edit-user");
            $('#movieForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#movie_id').val(data.id);
            $('#status').val(data.status);
            $('#name').val(data.name);
            $('#duration').val(data.time);
            $('#country').val(data.country);
            $('#director').val(data.directors);
            $('#type').val(data.type);
            $('#producer').val(data.producer);
            $('#actor').val(data.cast);
            $('#day_start').val(data.day_start);
            $('#content').val(data.content);
            $('#trailer').val(data.trailer);
        })
    });
    $('#saveBtn').click(function (e) {
        var mydata = new FormData($('#movieForm')[0]);
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: mydata,
            url: "<?php echo e(route('movie.store')); ?>",
            cache: false,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
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
    $('body').on('click', '.deleteMovie', function () {
        var movie_id = $(this).data('id');
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
                url: "<?php echo e(route('movie.store')); ?>" + '/' + movie_id,
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
    $('.data-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
});
function printErrorMsg (msg) {
    $('.print-error-msg').find('ul').html('');
    $('.print-error-msg').css('display', 'block');
    $.each( msg, function( key, value ) {
        $('.print-error-msg').find('ul').append('<li>' + value + '</li>');
    });
}
function format ( d ) {
    // `d` is the original data object for the row
    return `<table>
        <tr>
            <td><?php echo e(__('label.country')); ?></td>
            <td>` + d.country + `</td>
        </tr>
        <tr>
            <td><?php echo e(__('label.producer')); ?></td>
            <td>` + d.producer + `</td>
        </tr>
        <tr>
            <td><?php echo e(__('label.type')); ?></td>
            <td>` + d.type + `</td>
        </tr>
        <tr>
            <td><?php echo e(__('label.director')); ?></td>
            <td>` + d.directors + `</td>
        </tr>
        <tr>
            <td><?php echo e(__('label.actor')); ?></td>
            <td>` + d.cast + `</td>
        </tr>
        <tr>
            <td><?php echo e(__('label.date')); ?></td>
            <td>` + d.day_start + `</td>
        </tr>
        <tr>
            <td><?php echo e(__('label.content')); ?></td>
            <td>` + d.content + `</td>
        </tr>
    </table>`;
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/cinema/movie.blade.php ENDPATH**/ ?>