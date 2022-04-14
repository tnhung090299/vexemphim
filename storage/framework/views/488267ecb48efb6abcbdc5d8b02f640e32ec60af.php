<?php $__env->startSection('content'); ?>
<div class="container">
    <table class="display data-table">
        <thead>
            <tr>
                <th></th>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.name')); ?></th>
                <th><?php echo e(__('label.email')); ?></th>
                <th><?php echo e(__('label.role')); ?></th>
                <th><?php echo e(__('label.created_at')); ?></th>
                <th><?php echo e(__('label.updated_at')); ?></th>
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
        order: [1, "desc"],
        ajax: "<?php echo e(route('user.index')); ?>",
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
            {data: 'email', name: 'email'},
            {
                data: 'role',
                name: 'role', 
                render: function (data) {
                    switch (data){
                        case '1':
                            return "<?php echo e(__('label.admin')); ?>";
                            break;
                        default:
                            return "<?php echo e(__('label.user')); ?>";
                            break;
                    }
                },
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
        ]
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

function format ( d ) {
    // `d` is the original data object for the row
    return `<table>
        <tr>
            <td><?php echo e(__('label.address')); ?></td>
            <td>` + d.address + `</td>
        </tr>
        <tr>
            <td><?php echo e(__('label.mobile')); ?></td>
            <td>` + d.mobile + `</td>
        </tr>
        <tr>
            <td><?php echo e(__('label.ticketPur')); ?></td>
            <td>` + d.count + `</td>
        </tr>
    </table>`;
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views\admin\cinema\user.blade.php ENDPATH**/ ?>