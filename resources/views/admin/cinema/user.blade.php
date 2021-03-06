@extends('admin.layouts.master')
@section('content')
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createUser">{{ __('label.createUser') }}</a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>{{ __('label.id') }}</th>
                <th>{{ __('label.name') }}</th>
                <th>{{ __('label.email') }}</th>
                <th>{{ __('label.role') }}</th>
                <th>{{ __('label.created_at') }}</th>
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
                <form id="UserForm" name="UserForm" class="form-horizontal">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ __('label.Name') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('label.enterName') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{ __('label.Email') }}</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('label.enterEmail') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{ __('label.Password') }}</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('label.enterPassword') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{ __('label.Address') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="{{ __('label.enterAddress') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">{{ __('label.Mobile') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="{{ __('label.enterMobile') }}">
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label">{{ __('label.Role') }}</label>
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
        ajax: "{{ route('user.index') }}",
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
                            return "{{ __('label.admin') }}";
                            break;
                        default:
                            return "{{ __('label.user') }}";
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
        $('#modelHeading').html("{{ __('label.createUser') }}");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editUser', function () {
        var user_id = $(this).data('id');
        $.get("{{ route('user.index') }}" + '/' + user_id + '/edit', function (data) {
            $('#modelHeading').html("{{ __('label.editUser') }}");
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
        $(this).html('{{ __('label.sending') }}');
        $.ajax({
            data: $('#UserForm').serialize(),
            url: "{{ route('user.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#UserForm').trigger("reset");
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
    $('body').on('click', '.deleteUser', function () {
        var user_id = $(this).data("id");
        swal({
            title: "B???n ch???c ch???n x??a ch???!",
            text: "M???t Khi b???n ???n x??a, d??? li???u n??y c???a b???n s??? kh??ng th??? kh??i ph???c ???????c!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                type: "DELETE",
                url: "{{ route('user.store') }}" + '/' + user_id,
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
