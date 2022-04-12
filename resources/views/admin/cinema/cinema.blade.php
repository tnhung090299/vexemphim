@extends('admin.layouts.master')
@section('content')
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createNewCinema">{{ __('label.createNewCinema') }}</a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>{{ __('label.id') }}</th>
                <th>{{ __('label.name') }}</th>
                <th>{{ __('label.address') }}</th>
                <th>{{ __('label.note') }}</th>
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

            <div class="modal-body">
                <form id="cinemaForm" name="cinemaForm" class="form-horizontal">
                   <input type="hidden" name="cinema_id" id="cinema_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">{{ __('label.name') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('label.enterName') }}" value="">
                        </div>
                        <div id="error" class="alert alert-danger print-error-msg">
                            <ul></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{ __('label.address') }}</label>
                        <div class="col-sm-12">
                            <textarea id="address" name="address" placeholder="{{ __('label.enterAddress') }}" class="form-control"></textarea>
                        </div>
                        <div id="error" class="alert alert-danger print-error-msg">
                            <ul></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{ __('label.note') }}</label>
                        <div class="col-sm-12">
                            <textarea id="note" name="note" placeholder="{{ __('label.enterNote') }}" class="form-control"></textarea>
                        </div>
                        <div id="error" class="alert alert-danger print-error-msg">
                            <ul></ul>
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
        order: [0, "desc"],
        ajax: "{{ route('cinema.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'note', name: 'note'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewCinema').click(function () {
        $('#saveBtn').val("create-cinema");
        $('#cinema_id').val('');
        $('#cinemaForm').trigger("reset");
        $('#modelHeading').html("{{ __('label.createNewCinema') }}");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editCinema', function () {
        var cinema_id = $(this).data('id');
        $.get("{{ route('cinema.index') }}" + '/' + cinema_id + '/edit', function (data) {
            $('#modelHeading').html("{{ __('label.editCinema') }}");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#cinema_id').val(data.id);
            $('#name').val(data.name);
            $('#address').val(data.address);
            $('#note').val(data.note);
        })
    });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('{{ __('label.sending') }}');
        $.ajax({
            data: $('#cinemaForm').serialize(),
            url: "{{ route('cinema.store') }}",
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
    $('body').on('click', '.deleteCinema', function () {
        var cinema_id = $(this).data("id");
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
                url: "{{ route('cinema.store') }}" + '/' + cinema_id,
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
