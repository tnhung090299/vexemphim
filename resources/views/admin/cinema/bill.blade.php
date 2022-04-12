@extends('admin.layouts.master')
@section('content')
<div class="container">
    <table class="display data-table">
        <thead>
            <tr>
                <th></th>
                <th>{{ __('label.id') }}</th>
                <th>{{ __('label.user') }}</th>
                <th>{{ __('label.total') }}</th>
                <th>{{ __('label.created_at') }}</th>
                <th>{{ __('label.updated_at') }}</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop
@push('scripts')
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
        ajax: "{{ route('adm-bill.index') }}",
        columns: [
            {
                data: null,
                className: 'details-control',
                orderable: false,
                searchable: false,
                defaultContent: '',
            },
            {data: 'id', name: 'id'},
            {data: 'user.name', name: 'user.name'},
            {data: 'total', name: 'total'},
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
            <td>{{ __('label.ticketPur') }}</td>
            <td>` + d.tickets_count + `</td>
        </tr>
    </table>`;
}
</script>
@endpush
