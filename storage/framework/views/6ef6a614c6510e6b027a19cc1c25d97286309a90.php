<?php $__env->startSection('content'); ?>
<div class="container">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.code')); ?></th>
                <th><?php echo e(__('label.total')); ?></th>
                <th><?php echo e(__('label.status')); ?></th>
                <th><?php echo e(__('label.created_at')); ?></th>
                <th><?php echo e(__('label.updated_at')); ?></th>
                <th><?php echo e(__('label.action')); ?></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
        ajax: "<?php echo e(route('ticket.index')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'total', name: 'total'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('body').on('click', '.viewDetail', function () {
        var bill_id = $(this).data('id');
        $.get("<?php echo e(route('pdf.index')); ?>" + '/' + bill_id, function (data) {
            table.draw();
            if (data.success) {
                swal("Printed!", data.success, "success");
            } else {
                swal("Error!", data.error, "error");
            }
        })
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\admin\cinema\ticket.blade.php ENDPATH**/ ?>