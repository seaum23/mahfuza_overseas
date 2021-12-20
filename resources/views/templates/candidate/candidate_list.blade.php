@extends('layouts.app')
@section('title')
Candidate List
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Candidates</h5>
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
<div class="modal fade" id="sponsor_visa_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="assign_sponsor_visa">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Visa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="candidate_id" id="candidate_id">
                    <h4 id="assign_visa_name"></h4>
                    <select class="form-control select2" name="sponsor_visa_id" id="sponsor_visa" data-placeholder="Select Sponsor">
                        <option value=""></option>
                    </select>
                    <span id="sponsor_data"></span>
                </div>
                <div class="modal-footer">
                    <button id="assign_candidate_close_button" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="assign_candidate_button" type="submit" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
                <x-transaction-form-specified name="test_medical_amount"/>
                <div class="modal-footer">
                    <button id="test_medical_insert_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                <x-transaction-form-specified name="final_medical_amount"/>
                <div class="modal-footer">
                    <button id="insert_medical_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                <x-transaction-form-specified name="police_clearance_amount"/>
                <div class="modal-footer">
                    <button id="police_file_insert_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="traning_card_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="training_card_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Training Card Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_id_training" id="update_id_training">
                    <h4 id="update_training_candidate_name"></h4>
                    <input type="file" class="my-pond" name="training_file" id="training_file">
                </div>
                <x-transaction-form-specified name="training_card_amount"/>
                <div class="modal-footer">
                    <button id="training_card_insert_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="update_training_button" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="assign_job_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="assign_job_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_job_candidate_id" id="update_job_candidate_id">
                    <h4 id="assign_job_candidate_name"></h4>
                    <x-assign-job-to-candidate/>
                </div>
                <div class="modal-footer">
                    <button id="assign_job_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="assign_job_submit" type="submit" class="btn btn-primary">Submit</button>
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

                <button id="test_medical_update_close" type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
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

                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="final_medical_close">Close</button>
                {{-- <button id="final_medical_close" type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="police_clearance_file_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="police_clearance_update_id">
            <div class="modal-body" >
                <embed id="police_file_modal" src="" style="width: 40vw;min-height: 80vh;border: none;overflow-y: hidden;">
                <span class="hidden" id="update_police_clearance_file_div"><input type="file" class="my-pond" name="update_police_clearance_file" id="update_police_clearance_file"></span>
            </div>
            <div class="modal-footer">
                <button onclick="update_police_clearance_submit()" type="button" class="close hidden file-pond-submit" id="update_police_clearance_file_button">
                    <span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>
                </button>

                <button onclick="reupload('update_police_clearance_file')" type="button" class="close reupload" aria-label="Close">
                    <span style="color: Tomato;"><i class="fas fa-redo fa-xs"></i></span>
                </button>

                <button id="police_clearance_update_close" type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="training_card_file_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="training_card_update_id">
            <div class="modal-body" >
                <embed id="training_card_file" src="" style="width: 40vw;min-height: 80vh;border: none;overflow-y: hidden;">
                <span class="hidden" id="update_training_card_file_div"><input type="file" class="my-pond" name="update_training_card_file" id="update_training_card_file"></span>
            </div>
            <div class="modal-footer">
                <button onclick="update_training_card_submit()" type="button" class="close hidden file-pond-submit" id="update_training_card_file_button">
                    <span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>
                </button>

                <button onclick="reupload('update_training_card_file')" type="button" class="close reupload" aria-label="Close">
                    <span style="color: Tomato;"><i class="fas fa-redo fa-xs"></i></span>
                </button>

                <button id="training_card_close" type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<button id="change_country_toggle" style="display: none" data-target="#change_country" data-toggle="modal"></button>
<div class="modal fade" id="change_country" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="assign_country_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_country_id" id="update_country_id">
                    <h4 id="update_country_candidate_name"></h4>
                    <select class="form-control select2" name="update_country" id="update_country" data-placeholder="Select Country">
                        <option value=""></option>
                        @foreach ($countries as $country)
                            <option>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button id="assign_country_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="assign_country_submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
let datatable;

$('#assign_country_form').on('submit', (e) => {
    e.preventDefault();

    var form = $('#assign_country_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/assign.country',
        data: data,        
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#assign_country_submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#assign_country_submit").prop('disabled', true);
        },
        success: function (response){
            $("#assign_country_submit").html('Submit');
            $("#assign_country_submit").prop('disabled', false);
            $('#assign_job_close').click();
            $('#change_country_toggle').click();
            $('#assign_country_form')[0].reset();
            datatable.ajax.url( '{{ url('/') }}/candidate.list' ).load();
        }
    });
})

let assign_country = (id, name) => {
    $('#update_country_candidate_name').html(name);
    $('#update_country_id').val(id);
    $('#change_country_toggle').click();
    console.log('test');
}

const reset_form = (file, close_button, form = '') => {
    $(`#${close_button}`).click();
    datatable.ajax.url( '{{ url('/') }}/candidate.list' ).load();
    if(form){
        $(`#${form}`)[0].reset();
    }
    $(`#${file}`).filepond('removeFile');
}

let assign_job = (id, name) => {
    $('#assign_job_candidate_name').html(name);
    $('#update_job_candidate_id').val(id);
}

let get_manpower_office = (id) => {
    $.ajax({
        type: 'get',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/get-manpower-office/' + id,
        // beforeSend:function(){
        //     $("#experience_div").html('<i class="fas fa-spinner fa-pulse"></i>');
        // },
        success: function (response){
            $("#manpower").html(response);
        }
    });
}

$('#assign_job_form').on('submit', (e) => {
    e.preventDefault();

    var form = $('#assign_job_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/assign.job',
        data: data,        
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#assign_job_submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#assign_job_submit").prop('disabled', true);
        },
        success: function (response){
            $("#assign_job_submit").html('Submit');
            $("#assign_job_submit").prop('disabled', false);
            $('#assign_job_close').click();
            $('#assign_job_form')[0].reset();
            datatable.ajax.url( '{{ url('/') }}/candidate.list' ).load();
        }
    });
})

/**
 * Start Sponsor & Sponsor VISA CRUD
 */
// $('#booking_data_table').DataTable().ajax.reload( null , false);

let assign_visa = (id, name) => {
    $('#assign_visa_name').html(name);
    $('#candidate_id').val(id);
    $.ajax({
        type: 'GET',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/sponsor.visa/' + id,
		beforeSend:function(){
            $("#update_test_candidate_file_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_test_candidate_file_button").prop('disabled', true);
        },
        success: function (response){
            $('#sponsor_visa').append(response);
            $('.select2').select2({ width: '100%' });
        }
    });
}

$('#assign_sponsor_visa').on('submit', (e) => {
    e.preventDefault();

    var form = $('#assign_sponsor_visa')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/sponsor.visa',
        data: data,        
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#assign_candidate_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#assign_candidate_button").prop('disabled', true);
        },
        success: function (response){
            $('#assign_candidate_close_button').click();
            datatable.ajax.url( '{{ url('/') }}/candidate.list' ).load();
        }
    });
});

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

let training_card_file = (path, id) => {
    $('#training_card_update_id').val(id);
    $('#training_card_file').attr('src', path);
}

let police_clearance_file = (path, id) => {
    $('#police_clearance_update_id').val(id);
    $('#police_file_modal').attr('src', path);
}

let update_test_medical = (id, name) => {
    $('#update_id').val(id);
    $('#update_test_candidate_name').html(name);
}

let update_final_medical = (id, name) => {
    $('#update_id_final').val(id);
    $('#update_final_candidate_name').html(name);
    $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        todayHighlight:'TRUE',
        autoclose: true,
    });
}

let update_police_clearance = (id, name) => {
    $('#update_id_police').val(id);
    $('#update_police_candidate_name').html(name);
}

let update_training_card = (id, name) => {
    $('#update_id_training').val(id);
    $('#update_training_candidate_name').html(name);
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
            reset_form('update_test_candidate_file', 'test_medical_update_close');
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
            $('#final_medical_close').click();
            $("#update_final_candidate_file_button").html('<span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>');
            $("#update_final_candidate_file_button").prop('disabled', false);
            reset_form('update_final_candidate_file', 'final_medical_close');
        }
    });
}

let update_police_clearance_submit = () => {
    let police_file = $('input[name=update_police_clearance_file]').val();
    let update_id_police = $('#police_clearance_update_id').val();
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/police.clearance',
        data: {police_file, update_id_police},
		beforeSend:function(){
            $("#update_police_clearance_file_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_police_clearance_file_button").prop('disabled', true);
        },
        success: function (response){
            datatable.ajax.url( '{{ url('/') }}/candidate.list' ).load();
            $("#update_police_clearance_file_button").html('<span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>');
            $("#update_police_clearance_file_button").prop('disabled', false);
            reset_form('update_police_clearance_file', 'police_clearance_update_close');
        }
    });
}

let update_training_card_submit = () => {
    let training_file = $('input[name=update_training_card_file]').val();
    let update_id_training = $('#training_card_update_id').val();
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/training.card',
        data: {training_file, update_id_training},
		beforeSend:function(){
            $("#update_training_card_file_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_training_card_file_button").prop('disabled', true);
        },
        success: function (response){
            $("#update_training_card_file_button").html('<span style="color: Dodgerblue;"><i class="fas fa-save"></i></span>');
            $("#update_training_card_file_button").prop('disabled', false);
            reset_form('update_training_card_file', 'training_card_close');
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
    datatable = $('#datatable').DataTable({
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
            reset_form('test_candidate_file', 'test_medical_insert_close','test_medical_form');
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
            reset_form('final_candidate_file', 'insert_medical_close', 'final_medical_form');
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
            reset_form('police_file', 'police_file_insert_close', 'police_clearance_form');
        },
    });
});


$('#training_card_form').on('submit', function(e){
    e.preventDefault();
    
    var form = $('#training_card_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/candidate/training.card',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_training_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_training_button").prop('disabled', true);
        },
        success: function (response){
            reset_form('training_file', 'training_card_insert_close', 'training_card_form');
        },
    });
});

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

</script>
@endsection