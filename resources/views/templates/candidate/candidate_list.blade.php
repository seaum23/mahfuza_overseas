@extends('layouts.app')
@section('title')
Sponsors List
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card mt-3 card">
            <div class="header">All Sponsors</div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable w-100" id="datatable">
                        <thead>
                            <tr>
                                <th>Candidate Info</th>
                                <th>Passport No</th>
                                <th>Mobile No</th>
                                <th>Age</th>
                                <th>Issue Date</th>
                                <th style="width: 70px !important;">Passport expire date</th>
                                <th style="width: 70px !important;">Candidate previouse status</th>
                                <th>Applying for Country</th>
                                <th>Test Medical</th>
                                <th>Final Medical</th>
                                <th>Police Clearance</th>
                                <th>Training Card</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Update Modal -->
<div class="modal fade" id="test_medical_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="test_medical_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Test Medical Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <h4 id="update_test_candidate_name"></h4>
                    <input type="file" class="my-pond" name="test_candidate_file" id="test_candidate_file">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="final_medical_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="final_medical_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Final Medical Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_id_final" id="update_id_final">
                    <h4 id="update_final_candidate_name"></h4>
                    <input type="text" class="form-control datepicker mb-2" name="final_date" id="final_date" autocomplete="off" placeholder="Final Medical Report Date"/>
                    <input type="file" class="my-pond" name="final_candidate_file" id="final_candidate_file">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="police_clearance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="police_clearance_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Police Clearance Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_id_police" id="update_id_police">
                    <h4 id="update_police_candidate_name"></h4>
                    <input type="file" class="my-pond" name="police_file" id="police_file">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Show Document -->
<div class="modal fade" id="test_medical_file_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="test_medical_update_id">
            <div class="modal-body" >
                <embed id="test_medical_file" src="" style="width: 40vw;min-height: 80vh;border: none;overflow-y: hidden;">
                <span class="hidden" id="update_test_candidate_file_div"><input type="file" class="my-pond" name="update_test_candidate_file" id="update_test_candidate_file"></span>
            </div>
            <div class="modal-footer">
                <button onclick="update_test_medical_submit()" type="button" class="close hidden file-pond-submit" id="update_test_candidate_file_button">
                    <span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>
                </button>

                <button onclick="reupload('update_test_candidate_file')" type="button" class="close" aria-label="Close">
                    <span style="color: Tomato;"><i class="fas fa-redo fa-xs"></i></span>
                </button>

                <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="final_medical_file_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="final_medical_update_id">
            <div class="modal-body" >
                <embed id="final_medical_file" src="" style="width: 40vw;min-height: 80vh;border: none;overflow-y: hidden;">
                <span class="hidden" id="update_final_candidate_file_div"><input type="file" class="my-pond" name="update_final_candidate_file" id="update_final_candidate_file"></span>
            </div>
            <div class="modal-footer">
                <button onclick="update_final_medical_submit()" type="button" class="close hidden file-pond-submit" id="update_final_candidate_file_button">
                    <span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>
                </button>

                <button onclick="reupload('update_final_candidate_file')" type="button" class="close" aria-label="Close">
                    <span style="color: Tomato;"><i class="fas fa-redo fa-xs"></i></span>
                </button>

                <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="police_clearance_file_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="police_clearance_update_id">
            <div class="modal-body" >
                <embed id="police_file" src="" style="width: 40vw;min-height: 80vh;border: none;overflow-y: hidden;">
                <span class="hidden" id="update_final_candidate_file_div"><input type="file" class="my-pond" name="update_final_candidate_file" id="update_final_candidate_file"></span>
            </div>
            <div class="modal-footer">
                <button onclick="update_final_medical_submit()" type="button" class="close hidden file-pond-submit" id="update_final_candidate_file_button">
                    <span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>
                </button>

                <button onclick="reupload('update_final_candidate_file')" type="button" class="close" aria-label="Close">
                    <span style="color: Tomato;"><i class="fas fa-redo fa-xs"></i></span>
                </button>

                <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    
document.addEventListener('FilePond:processfilestart', (e) => {
    $(".file-pond-submit").html('<i class="fas fa-spinner fa-pulse"></i>');
    $(".file-pond-submit").prop('disabled', true);        
});
document.addEventListener('FilePond:processfile', (e) => {
    $(".file-pond-submit").html('<span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>');
    $(".file-pond-submit").prop('disabled', false);
});

/**
 * Start Sponsor & Sponsor VISA CRUD
 */
// $('#booking_data_table').DataTable().ajax.reload( null , false);

let reupload = (id) => {
    $('#' + id + '_div').show();
    $('#' + id + '_button').show();
}

let test_medical_file = (path, id) => {
    $('#test_medical_update_id').val(id);
    $('#test_medical_file').attr('src', path);
}

let final_medical_file = (path, id) => {
    $('#final_medical_update_id').val(id);
    $('#final_medical_file').attr('src', path);
}

let police_clearance_file = (path, id) => {
    $('#police_clearance_update_id').val(id);
    $('#police_file').attr('src', path);
}

let update_test_medical = (id, name) => {
    $('#update_id').val(id);
    $('#update_test_candidate_name').html(name);
}

let update_final_medical = (id, name) => {
    $('#update_id_final').val(id);
    $('#update_final_candidate_name').html(name);
}

let update_police_clearance = (id, name) => {
    $('#update_id_police').val(id);
    $('#update_police_candidate_name').html(name);
}

let update_test_medical_submit = () => {
    let test_candidate_file = $('input[name=update_test_candidate_file]').val();
    let update_id = $('#test_medical_update_id').val();
    console.log(test_candidate_file);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/test.medical',
        data: {test_candidate_file, update_id},
		beforeSend:function(){
            $("#update_test_candidate_file_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_test_candidate_file_button").prop('disabled', true);
        },
        success: function (response){            
            $("#update_test_candidate_file_button").html('<span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>');
            $("#update_test_candidate_file_button").prop('disabled', false);
            $('#test_medical_file_show').modal('hide');
            $('#datatable').ajax.url( '{{ url('/') }}' + '/candidate.list' ).load();
        }
    });
}



let update_final_medical_submit = () => {
    let final_candidate_file = $('input[name=update_final_candidate_file]').val();
    let update_id_final = $('#final_medical_update_id').val();
    console.log(final_candidate_file);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/final.medical',
        data: {final_candidate_file, update_id_final},
		beforeSend:function(){
            $("#update_final_candidate_file_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_final_candidate_file_button").prop('disabled', true);
        },
        success: function (response){
            $('#final_medical_file_show').modal('hide');
            $("#update_final_candidate_file_button").html('<span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>');
            $("#update_final_candidate_file_button").prop('disabled', false);
            $('#datatable').ajax.url( '{{ url('/') }}' + '/candidate.list' ).load();
            $('#final_medical_file').attr('src', '');
            $('#update_final_candidate_file').filepond('removeFile');
            let filePond = FilePond.find(document.getElementById('update_final_candidate_file'));
            filePond.removeFiles();
        }
    });
}

function selectDelegateOffice(delegate_id){
    let selected_office = $('#delegateOfficeId').data('selected_office');
    $.ajax({
        type: 'PUT',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/sponsor/' + delegate_id + '/fetch_delegate_office',
        data: {delegate_id},
        success: function (response){
            $('#delegateOfficeId').find('option').remove();
            let info = JSON.parse(response);
            $('#delegateOfficeId').append(`<option value="">Select Delegate Office</option>`);
            info.forEach(element => {
                if(selected_office == element.id){
                    $('#delegateOfficeId').append(`<option value="${element.id}" selected>${element.name}</option>`);
                }else{
                    $('#delegateOfficeId').append(`<option value="${element.id}">${element.name}</option>`);
                }
            });
        }
    });
}

$(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('/') }}' + '/candidate.list',
        columns: [
            { data: 'fName' },
            { data: 'passportNum' },
            { data: 'phone' },
            { data: 'data_of_birth' },
            { data: 'issue_date' },
            { data: 'passport_expiry' },
            { data: 'experience_status' },
            { data: 'country' },
            { data: 'test_medical_status' },
            { data: 'final_medical_status' },
            { data: 'police_clearance_file' },
            { data: 'training_card_file' },            
            { data: 'action' },            
        ],
    });
});

let edit_agent = ( name, email, phone, comment, id) => {
    $('#agentName').val(name);
    $('#agentEmail').val(email);
    $('#agentPhone').val(phone);
    $('#comment').val(phone);
    $('#agent_id').val(id);
}

$('#update_agent').on('submit', function(e){
    e.preventDefault();
    let id = $('#agent_id').val();
    $('#update_agent').removeClass('needs-validation');
    $('.invalid-feedback').removeClass('is-invalid');
    
    var form = $('#update_agent')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/agent/' + id ,
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_button_agent").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button_agent").prop('disabled', true);
        },
        success: function (response){
            location.reload();
        },
        error: function (xhr, status, error){
            $('#update_agent').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}_invalid`).html(value);
            }
        }
    });
});

$('#test_medical_form').on('submit', function(e){
    e.preventDefault();
    
    var form = $('#test_medical_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/test.medical',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_button_agent").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button_agent").prop('disabled', true);
        },
        success: function (response){
            location.reload();
        },
    });
});

$('#final_medical_form').on('submit', function(e){
    e.preventDefault();
    
    var form = $('#final_medical_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/final.medical',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_button_agent").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button_agent").prop('disabled', true);
        },
        success: function (response){
            location.reload();
        },
    });
});

$('#police_clearance_form').on('submit', function(e){
    e.preventDefault();
    
    var form = $('#police_clearance_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/police.clearance',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_button_agent").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button_agent").prop('disabled', true);
        },
        success: function (response){
            location.reload();
        },
    });
});

$(function(){
    FilePond.setOptions({
        server: {
            url: "{{ url('/') }}",
            process: '/upload/candidate-photo',
            revert: '/revert',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
    });
});

/**
 * End Sponsor & Sponsor VISA CRUD
 */
</script>
@endsection