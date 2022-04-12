@extends('admin.layouts.master')
@section('content')
<div class="container">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>{{ __('label.id') }}</th>
                <th>{{ __('label.code') }}</th>
                <th>{{ __('label.total') }}</th>
                <th>{{ __('label.status') }}</th>
                <th>{{ __('label.created_at') }}</th>
                <th>{{ __('label.updated_at') }}</th>
                <th>{{ __('label.action') }}</th>
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
        order: [0, "desc"],
        ajax: "{{ route('ticket.index') }}",
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
        $.get("{{ route('pdf.index') }}" + '/' + bill_id, function (data) {
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
@endpush
