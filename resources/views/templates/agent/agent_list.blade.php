@extends('layouts.app')
@section('title')
Agents List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Agents</h5>
                <div class="table-responsive w-100">
                    <table class="mb-0 table table-hover" id="agent_list_datatable">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Agent Email</th>
                                <th>Agent Name</th>
                                <th>Agent Phone</th>
                                <th>Document</th>
                                <th>Balance</th>
                                <th>Alter</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Update Agent -->
<div class="modal fade" id="update_agent_modal"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Agent Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="update_agent">
                <input type="hidden" id="agent_id">
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6" >
                            <label>Agent Name</label>
                            <input class="form-control" type="text" name="agentName" id="agentName" placeholder="Enter Name" >
                            <div id="agentName_invalid" class="invalid-feedback"> </div>
                        </div>
                        <div class="form-group col-md-6" >  
                            <label for="sel1">Agent Email: </label>
                            <input class="form-control" type="email" name="agentEmail" id="agentEmail" placeholder="example@abc.com" >
                            <div id="agentEmail_invalid" class="invalid-feedback"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sel1">Phone:</label>
                            <input class="form-control" type="text" name="agentPhone" id="agentPhone" placeholder="Phone Number" >
                            <div id="agentPhone_invalid" class="invalid-feedback"> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sel1">Any Remarks:</label>
                            <input class="form-control" type="text" name="comment" id="comment" placeholder="Comment / Note">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sel1">Photo:</label>
                            <input class="my-pond form-control-file" type="file" name="agentImage" id="agentImage" >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sel1">Passport Scan Copy:</label>
                            <input class="my-pond form-control-file" type="file" name="agentPassport" id="agentPassport" >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sel1">Opening Balance Sheet:</label>
                            <input class="my-pond form-control-file" type="file" name="balanceSheet" id="balanceSheet" >
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update_button_agent">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="update_close">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Transaction MODAL --}}
<div class="modal fade" id="transaction_modal_specific"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="transaction_form_body"></div>
        </div>
    </div>
</div>

{{-- Transaction MODAL --}}
<div class="modal fade" id="ledger_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ledger</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ledger_modal_body">

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

let balance_sheet = (name, email, phone, comment, id) => {
    $.ajax({
        type: 'get',
        // enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/agent/balance-sheet/' + id,
        data: {name},
        success: function (response){
            $('#ledger_modal_body').html(response);
        }
    });
}


document.addEventListener('FilePond:processfilestart', (e) => {
    $(".file-pond-submit").html('<i class="fas fa-spinner fa-pulse"></i>');
    $(".file-pond-submit").prop('disabled', true);        
});
document.addEventListener('FilePond:processfile', (e) => {
    $(".file-pond-submit").html('Add');
    $(".file-pond-submit").prop('disabled', false);
});

/**
 * Start Sponsor & Sponsor VISA CRUD
 */

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
    $('#agent_list_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('/') }}' + '/agent.list',
        columns: [
            { data: 'photo', name: 'photo' },
            { data: 'email', name: 'email' },
            { data: 'full_name', name: 'full_name' },
            { data: 'phone', name: 'phone' },
            { data: 'document', name: 'document' },
            { data: 'balance', name: 'balance' },
            { data: 'action', name: 'action' },
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
            $("#update_button_agent").html('Update');
            $("#update_button_agent").prop('disabled', false);
            $('#update_agent').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}_invalid`).html(value);
            }
        }
    });
});

/**
 * End Sponsor & Sponsor VISA CRUD
 */




document.addEventListener('FilePond:processfilestart', (e) => {
    $("#submit").html('<i class="fas fa-spinner fa-pulse"></i>');
    $("#submit").prop('disabled', true);        
});
document.addEventListener('FilePond:processfile', (e) => {
    $("#submit").html('Add');
    $("#submit").prop('disabled', false);
});    
$(function(){
    FilePond.setOptions({
        server: {
            url: "{{ url('/') }}",
            process: '/upload/agent-photo',
            revert: '/revert',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
    });
});
</script>
@endsection