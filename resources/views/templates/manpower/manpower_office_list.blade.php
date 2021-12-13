@extends('layouts.app')
@section('title')
Delegate List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Manpower Offices</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover">
                        <thead>
                            <th>Office Name</th>
                            <th>License</th>
                            <th>Address</th>
                            <th>Jobs</th>
                            <th>Comment</th>
                            <th>Alter</th>
                        </thead>
                        <tbody>
                            @foreach ($offices as $office)
                            <tr>
                                <td>{{ $office->name; }}</td>
                                <td>{{ $office->license; }}</td>
                                <td>{{ $office->address; }}</td>
                                <td>
                                    @if ($office->manpower_job->isEmpty())
                                        <p>No Job Assigned!</p>
                                    @else
                                        @foreach ($office->manpower_job as $manpower_job)
                                            <button onclick="edit_manpower_job({{ $manpower_job->pivot->id }}, {{ $office->id }})" class="btn btn-info btn-sm">{{ $manpower_job->name }}: {{$manpower_job->pivot->processing_cost}}</button>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $office->comment; }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="add_manpower_office({{ $office->id; }})"><i class="fas fa-plus"></i> Add Job</button>
                                    <button class="btn btn-warning btn-sm" onclick="update_manpower_office({{ $office->id; }})"><i class="fas fa-edit"></i> Edit</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                
                {{ $offices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')

<!-- Edit Delete Job -->
<div class="modal fade" id="manpower_job_modal" tabindex="-1" role="dialog" aria-labelledby="change_passwordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Job Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" name="manpower_office_id" id="manpower_office_id">
                <div class="row">
                    <div class="col-sm">                        
                        <p style="display: block">Job</p>
                        <select style="width: 100%" class="form-control select2" name="jobId" id="jobId" required>
                        </select>
                    </div>
                    <div class="col-sm">
                        <label>Processing Cost</label>
                        <input class="form-control" autocomplete="off" type="number" name="processingCost" id="processingCost" placeholder="Cost" required>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <form action="" method="post" enctype="multipart/form-data" id="delete_manpower_job">
                    <button type="submit" name="delete" class="btn btn-danger" id="delete_button">Delete</button>
                </form>
                <form action="" method="post" enctype="multipart/form-data" id="update_manpower_job">
                    <button type="submit" class="btn btn-primary" id="update_button">Update</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add New Job -->
<button style="display: hidden" id="manpower_job_modal_button" data-toggle="modal" data-target="#add_manpower_job_modal"></button>
<div class="modal fade" id="add_manpower_job_modal" tabindex="-1" role="dialog" aria-labelledby="change_passwordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" id="add_manpower_job_form">
                <div class="modal-header">
                    <h5 class="modal-title">Office Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="add_to_manpower_office_id" id="add_to_manpower_office_id">
                    <p class="m-0 p-0 text-danger" id="error_message_new_job"></p>
                    <div id="job-body">

                    </div>
                    <div id="extra-job-body"></div>
                    <div class="row mt-3">
                        <div class="col-sm">                        
                            <div id="officeDiv"></div>                
                            <div class="form-row">
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary" type="button" id="add_office" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                                    <button class="btn btn-sm btn-danger" type="button" id="remove_office"><span class="fas fa-minus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="add_manpower_job"> Add </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Manpower Office -->
<div class="modal fade" id="update_manpower_office_modal" tabindex="-1" role="dialog" aria-labelledby="change_passwordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manpower Office Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="update_manpower_office_form">
                <input type="hidden" id="manpower_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Office Name</label>
                            <input class="form-control @error('officeName') is-invalid @enderror" autocomplete="off" type="text" name="officeName" id="officeName" placeholder="Enter Name" required>
                            <div class="invalid-feedback"> @error('officeName') {{ $message }} @enderror </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>License Number</label> <span class="text-danger" id=""></span>
                            <input class="form-control @error('licenseNumber') is-invalid @enderror" autocomplete="off" type="text" name="licenseNumber" id="licenseNumber" placeholder="Enter License Number" required>
                            <div id="error_message" class="invalid-feedback">  </div>
                        </div>                
                        <div class="form-group col-md-6">
                            <label>Office Address</label>
                            <input class="form-control @error('officeAddress') is-invalid @enderror" autocomplete="off" type="text" name="officeAddress" id="officeAddress" placeholder="Enter Office Address" required>
                            <div class="invalid-feedback"> @error('officeAddress') {{ $message }} @enderror </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Comment</label>
                            <input class="form-control @error('comment') is-invalid @enderror" autocomplete="off" type="text" id="comment" name="comment" placeholder="Any comment">
                            <div class="invalid-feedback"> @error('comment') {{ $message }} @enderror </div>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update_button_manpower">Update</button>
                    <button id="update_manpower_office_modal_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
let idx_of_jobs_div = 0;

let update_manpower_office = (id) => {
    $.ajax({
        type: 'get',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' +'/manpower-office/' + id + '/edit',        
		beforeSend:function(){
            $('.loader-container').show();
        },
        success: function (response){
            let info = JSON.parse(response);
            $('#officeName').val(info.name);
            $('#licenseNumber').val(info.license);
            $('#officeAddress').val(info.address);
            $('#comment').val(info.comment);
            $('#manpower_id').val(info.id);            
            $('#update_manpower_office_modal_close').click();
            $('.loader-container').hide();
        }
    });
}

$('#update_manpower_office_form').on('submit', function(){
    event.preventDefault();
    let id = $('#manpower_id').val();
    $('#update_manpower_office_form').removeClass('needs-validation');
    $('#error_message').html('');
    
    var form = $('#update_manpower_office_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'PUT',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/manpower-office/' + id,
        data: $( this ).serialize(),
		beforeSend:function(){
            $("#update_button_manpower").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button_manpower").prop('disabled', true);
        },
        success: function (response){
            location.reload();
        }
    });
});

let edit_manpower_job= (id, office_id) => {
    $.ajax({
        type: 'get',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' +'/manpower-job/' + id + '/edit',    
        data: {office_id},
		beforeSend:function(){
            $('.loader-container').show();
        },
        success: function (response){
            let info = JSON.parse(response);
            $('#manpower_office_id').val(id);
            $('#jobId').html(info.jobs_option);
            $('#processingCost').val(info.processing_cost);
            $('#manpower_job_modal_button').click();
            $('.loader-container').hide();
        }
    });
}

$('#update_manpower_job').on('submit', () => {
    event.preventDefault();
    let id = $('#manpower_office_id').val();
    let jobId = $('#jobId').val();
    let processingCost = $('#processingCost').val();
    $.ajax({
        type: 'PUT',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/manpower-job/' + id,
        data: {jobId, processingCost},
		beforeSend:function(){
            $("#update_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button").prop('disabled', true);
            $("#delete_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#delete_button").prop('disabled', true);
        },
        success: function (response){
            let info = JSON.parse(response);
            if(info.error){
                $("#update_button").html('Update');
                $("#update_button").prop('disabled', false);
                $("#delete_button").html('Delete');
                $("#delete_button").prop('disabled', false);
                danger_alert('Error', 'Something went worng! Please try again!');
            }else{
                location.reload();
            }
        }
    });
})

$('#delete_manpower_job').on('submit', () => {
    event.preventDefault();
    let id = $('#manpower_office_id').val();
    $.ajax({
        type: 'DELETE',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/manpower-job/' + id,
		beforeSend:function(){
            $("#update_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button").prop('disabled', true);
            $("#delete_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#delete_button").prop('disabled', true);
        },
        success: function (response){
            let info = JSON.parse(response);
            if(info.error){
                $("#update_button").html('Update');
                $("#update_button").prop('disabled', false);
                $("#delete_button").html('Delete');
                $("#delete_button").prop('disabled', false);
                danger_alert('Error', 'Something went worng! Please try again!');
            }else{
                location.reload();
            }
        }
    });
})

let add_manpower_office = (id) => {
    $('.loader').show();
    $('#add_to_manpower_office_id').val(id);
    let promise = fetch_data();
    promise.then((response) => {
        idx_of_jobs_div++;
        let info = JSON.parse(response);
        console.log(info.html);
        $('#job-body').html(info.html);
        $('.select2').select2({
            width: '100%'
        });
    });
    $('#manpower_job_modal_button').click();
    $('.jod-extra-body').attr('id', 'form_body_number_' + 0);
    console.log('form_body_number_' + 0);
    $('.loader').show();
}

$('#add_office').on('click',() => {
    let promise = fetch_data();
    promise.then((response) => {
        idx_of_jobs_div++;
        let info = JSON.parse(response);
        $('#extra-job-body').append( info.html );
        $('.select2').select2({
            width: '100%'
        });
    });
});
$('#remove_office').on('click',() => {
    $('.jod-extra-body').last().remove();
    idx_of_jobs_div--;
});

let fetch_data = () => {
    return $.ajax({
        type: 'get',
        enctype: 'multipart/form-data',
        data: {number_of_jobs : idx_of_jobs_div},
        url: '{{ url('/') }}' +'/manpower-office.fetch.form-element',
    });
}

$('#add_manpower_job_form').on('submit', function(){
    event.preventDefault();
    
    var form = $('#add_manpower_job_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/manpower-job',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#add_manpower_job").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#add_manpower_job").prop('disabled', true);
        },
        success: function (response){
            let info = JSON.parse(response);
            if(info.error){
                $('#add_manpower_job_form').addClass('needs-validation');
                $('#jobId_div_' + info.error_number).addClass('is-invalid');
                $('#error_message_new_job').html('Job already assigned!');
                $("#add_manpower_job").html(' Add ');
                $("#add_manpower_job").prop('disabled', false);
            }else{
                location.reload();
            }
        }
    });
});

</script>
@endsection