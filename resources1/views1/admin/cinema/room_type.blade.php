@extends('admin.layouts.master')
@section('content')
<div class="container">
    <a class="btn btn-success" href="javascript:void(0)" id="createRoomType">{{ __('label.createRoomType') }}</a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>{{ __('label.id') }}</th>
                <th>{{ __('label.name') }}</th>
                <th>{{ __('label.note') }}</th>
                <th>{{ __('label.created_at') }}</th>
                <th>{{ __('label.updated_at') }}</th>
                <th>{{ __('label.action') }}</th>
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
                <form id="roomTypeForm" name="roomTypeForm" class="form-horizontal">
                   <input type="hidden" name="room_type_id" id="room_type_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ __('label.name') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('label.enterName') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ __('label.note') }}</label>
                        <div class="col-sm-12">
                            <textarea id="note" name="note" placeholder="{{ __('label.enterNote') }}" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">{{ __('label.saveChange') }}
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        ajax: "{{ route('room_type.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'note', name: 'note'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createRoomType').click(function () {
        $('#saveBtn').val("create-room_type");
        $('#room_type_id').val('');
        $('#roomTypeForm').trigger("reset");
        $('#modelHeading').html("{{ __('label.createRoomType') }}");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editRoomType', function () {
        var room_type_id = $(this).data('id');
        $.get("{{ route('room_type.index') }}" + '/' + room_type_id + '/edit', function (data) {
            $('#modelHeading').html("{{ __('label.editRoomType') }}");
            $('#saveBtn').val("edit-room_type");
            $('#ajaxModel').modal('show');
            $('#room_type_id').val(data.id);
            $('#name').val(data.name);
            $('#note').val(data.note);
        })
    });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('{{ __('label.sending') }}');
        $.ajax({
            data: $('#roomTypeForm').serialize(),
            url: "{{ route('room_type.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#roomTypeForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                swal("Saved!", data.success, "success");
                $('#saveBtn').html('{{ __('label.saveChange') }}');
            },
            error: function(data) {
                var x = JSON.parse(data.responseText);
                printErrorMsg(x.errors);
                setTimeout(function(){
                        $('#error').hide();
                    }, 3000);
                $('#saveBtn').html('{{ __('label.saveChange') }}');
            }
        });
    });
    $('body').on('click', '.deleteRoomType', function () {
        var room_type_id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                type: "DELETE",
                url: "{{ route('room_type.store') }}" + '/' + room_type_id,
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
@endpush
