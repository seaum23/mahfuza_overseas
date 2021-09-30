@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col-md-6 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">Add New Jobs</h5>
                <form id="job_form" action="@if($errors->get('update')) {{ url('/jobs') . '/' . $errors->get('job_id')[0] }} @else {{ url('/jobs') }} @endif" method="post" class=" @if ($errors->any()) needs-validation @endif ">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-danger mb-1 mt-0 mr-0 ml-0 p-0">@error('error') {{ $message }} @enderror</p>
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control @error('job_name') is-invalid @enderror " type="text" name="job_name" id="job_name" placeholder="Job Name" value="{{ old('job_name') }}">
                            <div class="invalid-feedback"> @error('job_name') {{ $message }} @enderror </div>
                        </div>
                        <div class="col-sm-5">        
                            <select data-selected="{{ old('job_type') }}" name="job_type" id="job_type" class="form-control @error('job_type') is-invalid @enderror">
                                <option value="">Select Job Type</option>
                                <option>Comission</option>
                                <option>Paid</option>
                            </select>
                            <div class="invalid-feedback"> @error('job_type') {{ $message }} @enderror </div>
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
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Sponsors</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover" id="jobs_datatable">
                        <thead>
                            <tr>
                                <th>Job Name</th>
                                <th>Job Credit Type</th>
                                <th>Creation Date</th> 
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $job->name }}</td>
                                <td>{{ $job->credit_type }}</td>
                                <td>{{ $job->created_at->format('d-m-Y') }}</td>
                                <td><button data-toggle="modal" data-target="#" class="btn btn-sm btn-info" onclick="edit_job('{{ $job->name }}', '{{ $job->credit_type }}', '{{ $job->id }}')"><i class="fas fa-edit"></i> Edit</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $jobs->links() }}
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
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