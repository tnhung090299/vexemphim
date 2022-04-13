@extends('admin.layouts.master')
@section('content')
<div class="container">
    
    <table class="display data-table">
        
        <thead>
            <tr>
                <th></th>
                <th>{{ __('label.id') }}</th>
                <th>{{ __('label.name') }}</th> 
                <th>{{ __('label.email') }}</th>
                <th>{{ __('label.role') }}</th>
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
        order: [1, "desc"],
        ajax: "{{ route('user.index') }}",
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
                            return "{{ __('label.admin') }}";
                            break;
                        default:
                            return "{{ __('label.user') }}";
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
            <td>{{ __('label.address') }}</td>
            <td>` + d.address + `</td>
        </tr>
        <tr>
            <td>{{ __('label.mobile') }}</td>
            <td>` + d.mobile + `</td>
        </tr>
        <tr>
            <td>{{ __('label.ticketPur') }}</td>
            <td>` + d.count + `</td>
        </tr>
    </table>`;
}
</script>
@endpush
