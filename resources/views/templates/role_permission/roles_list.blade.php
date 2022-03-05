@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col-md-6 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">Add New Role</h5>
                <form action="{{ route('role.store') }}" method="post" class=" @if ($errors->any()) needs-validation @endif ">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <p class="text-danger mb-1 mt-0 mr-0 ml-0 p-0">@error('error') {{ $message }} @enderror</p>
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control @error('role_name') is-invalid @enderror " type="text" name="role_name" id="role_name" placeholder="Role Name" value="{{ old('role_name') }}">
                            <div class="invalid-feedback"> @error('role_name') {{ $message }} @enderror </div>
                        </div>
                        <div class="col-sm-2 align-self-middle" id="button_div">
                            @if($errors->get('update'))
                                <input type="hidden" name="_method" value="PUT">
                                <button class="btn btn-warning">Update</button>
                            @else
                                <button class="btn btn-primary">Add</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-6 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Roles</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover text-center" id="jobs_datatable">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Created At</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td><button onclick="get_permissions({{ $item->id }})" class="btn btn-info btn-xs">Permissions</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $permissions->links() }}
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
{{-- Transaction MODAL --}}
<button id="toggle_permission_modal" style="display: none" data-target="#permission_modal" data-toggle="modal"></button>
<div class="modal fade" id="permission_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="permissions_body"></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let get_permissions = (id) => {

        $.ajax({
            type: 'get',
            url: '{{ url('/') }}' + '/role/permission-of-role/' + id,
            success: function (response){
                $('#toggle_permission_modal').click();
                $('#permissions_body').html(response);
            },
        });
        
    }

    let permission_to_role = (role, permission) => {
        $.ajax({
            type: 'get',
            url: '{{ url('/') }}' + '/role/permission-to-role/' + role + '/' + permission,
            success: function (response){
                location.reload();
            },
        });
    }

    $('#update_sponsor').on('submit', function(){
        event.preventDefault();
        let id = $('#sponsor_id_update').val();
        $('#update_sponsor').removeClass('needs-validation');
        
        var form = $('#update_sponsor')[0];
        var data = new FormData(form);
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' + '/sponsor/' + id + '/update',
            data: data,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("#update_button_sponsor").html('<i class="fas fa-spinner fa-pulse"></i>');
                $("#update_button_sponsor").prop('disabled', true);
            },
            success: function (response){
                let info = JSON.parse(response);
                if(info.error){
                    $('#update_sponsor').addClass('needs-validation');
                    $("#update_button_sponsor").html('Update');
                    $("#update_button_sponsor").prop('disabled', false);
                    $('#sponsorNid').addClass('is-invalid');
                    $("#sponsorNid_message").html('Sponsor NID already exists!');
                }else{
                    $('#update_close').click();
                    $('#sponsor_list_datatable').DataTable().ajax.reload();
                }
            }
        });
    });

    let edit_job = (name, type, id) => {
        $('#job_name').val(name);
        $('#job_type').val(type);
        $('.select2').trigger('change');
        $('#job_form').prop('action', "{{ url('/jobs') }}" + '/' + id);
        $('#job_form').append('<input type="hidden" name="_method" value="PUT">');
        
        $('#button_div').html('<button class="btn btn-warning">Update</button>');
    }
    $(document).ready(function(){
        if($('#job_type').data('selected') !== ''){
            $('#job_type').val($('#job_type').data('selected'));
        }
    })
</script>
@endsection