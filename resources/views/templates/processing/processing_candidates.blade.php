@extends('layouts.app')
@section('title')
Processing Candidate List
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card mt-3 card">
            <div class="card-body"><h5 class="card-title">Processing Candidates</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable w-100" id="datatable">
                        <thead>
                            <tr>
                                <th>Candidate Info</th>
                                <th>VISA Info</th>
                                <th>Employee Request</th>
                                <th>Foreign Mole</th>
                                <th>Okala</th>
                                <th>Mufa</th>
                                <th>Update Medical</th>
                                <th>Visa Stamping</th>
                                <th>Finger</th>
                                <th>Training Card</th>
                                <th>Manpower Card</th>
                                <th>Ticket</th>
                                <th>Option</th>
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
{{-- OKALA MODAL --}}
<div class="modal fade" id="okala_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="okala_update_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Okala Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_okala_id" id="update_okala_id">
                    <h4 id="update_okala_name"></h4>
                    <input type="file" class="my-pond" name="okala_file" id="okala_file">
                </div>
                <div class="modal-footer">
                    <button id="update_okala_button_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="update_okala_button" type="submit" class="btn btn-primary file-pond-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- MUFA MODAL --}}
<div class="modal fade" id="mufa_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="mufa_update_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mufa Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_mufa_id" id="update_mufa_id">
                    <h4 id="update_mufa_name"></h4>
                    <input type="file" class="my-pond" name="mufa_file" id="mufa_file">
                </div>
                <div class="modal-footer">
                    <button id="update_mufa_button_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="update_mufa_button" type="submit" class="btn btn-primary file-pond-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- VISA Stamping MODAL --}}
<div class="modal fade" id="visa_stamping_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="visa_stamping_update_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">VISA Stamping Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_visa_stamping_id" id="update_visa_stamping_id">
                    <h4 id="update_visa_stamping_name"></h4>
                    <input type="text" class="form-control datepicker mb-1" autocomplete="off" name="stamping_date" id="stamping_date" placeholder="Stamping Date (Year-month-day)"/>
                    <input type="file" class="my-pond-multiple" name="visa_stamping_file[]" id="visa_stamping_file">
                </div>
                <div class="modal-footer">
                    <button id="update_visa_stamping_button_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="update_visa_stamping_button" type="submit" class="btn btn-primary file-pond-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Training card modal --}}
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
                <div class="modal-footer">
                    <button id="traning_card_modal_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="update_training_button" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Manpower modal --}}
<div class="modal fade" id="manpower_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="manpower_update_form" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manpower Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_manpower_id" id="update_manpower_id">
                    <h4 id="update_manpower_name"></h4>
                    <input type="file" class="my-pond" name="manpower_card_file" id="manpower_card_file">
                </div>
                <div class="modal-footer">
                    <button id="manpower_modal_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="update_manpower_button" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Transaction MODAL --}}
<div class="modal fade" id="transaction_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <x-transaction-form/>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
// Processings
let employee_request = (id) => {
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/processing/employee_request/' + id,
        success: function (response){
            datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
        }
    });
}
let foreign_mole = (id) => {
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/processing/foreign_mole/' + id,
        success: function (response){
            datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
        }
    });
}
let medical_update = (id) => {
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/processing/medical_update/' + id,
        success: function (response){
            datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
        }
    });
}
let finger_update = (id) => {
    swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: '{{ url('/') }}' + '/processing/finger_update/' + id,
                success: function (response){
                    swal("Done!", {
                        icon: "success",
                    });
                    datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
                }
            });           
        }
    });
}

// Okala
$('#okala_update_form').on('submit', (e) => {
    e.preventDefault();
    
    var form = $('#okala_update_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/processing/okala_update',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_okala_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_okala_button").prop('disabled', true);
        },
        success: function (response){
            $('#update_okala_button_close').click();
            $("#update_okala_button").html('Update');
            $("#update_okala_button").prop('disabled', true);
            datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
        },
    });
})
let update_okala_modal = (id, name) => {
    $('#update_okala_id').val(id);
    $('#update_okala_name').html(name);
}

// MUFA
$('#mufa_update_form').on('submit', (e) => {
    e.preventDefault();
    
    var form = $('#mufa_update_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/processing/mufa_update',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_mufa_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_mufa_button").prop('disabled', true);
        },
        success: function (response){
            $('.my-pond').filepond.removeFile()
            document.getElementById("mufa_file").value = null;
            $('#mufa_file').val(null);
            $('#update_mufa_button_close').click();
            $("#update_mufa_button").html('Update');
            $("#update_mufa_button").prop('disabled', true);
            datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
        },
    });
})
let update_mufa_modal = (id, name) => {
    $('#update_mufa_id').val(id);
    $('#update_mufa_name').html(name);
}

// VISA Stamping
$('#visa_stamping_update_form').on('submit', (e) => {
    e.preventDefault();
    
    var form = $('#visa_stamping_update_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/processing/visa_stamping_update',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_visa_stamping_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_visa_stamping_button").prop('disabled', true);
        },
        success: function (response){
            $('#update_visa_stamping_button_close').click();
            $("#update_visa_stamping_button").html('Save');
            $("#update_visa_stamping_button").prop('disabled', true);
            datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
        },
    });
})
let update_visa_stamping = (id, name) => {
    $('#update_visa_stamping_id').val(id);
    $('#update_visa_stamping_name').html(name);
}

// Training card
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
            $('#traning_card_modal_close').click();
            datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
        },
    });
});
let update_training_card = (id, name) => {
    $('#update_id_training').val(id);
    $('#update_training_candidate_name').html(name);
}

// Manpower
$('#manpower_update_form').on('submit', (e) => {
    e.preventDefault();
    
    var form = $('#manpower_update_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/processing/manpower_update',
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_manpower_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_manpower_button").prop('disabled', true);
        },
        success: function (response){
            $('#manpower_modal_close').click();
            $("#update_manpower_button").html('Save');
            $("#update_manpower_button").prop('disabled', true);
            datatable.ajax.url( '{{ url('/') }}/processing.list' ).load();
        },
    });
})
let update_manpower_modal = (id, name) => {
    $('#update_manpower_id').val(id);
    $('#update_manpower_name').html(name);
}


// Datatable init
let datatable;
$(function() {
    datatable = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('processing.datatable') }}",
        columns: [
            { data: 'candidate.fName' },
            { data: 'sponsor_visa.sponsor_visa' },
            { data: 'employee_request' },
            { data: 'foreign_mole' },
            { data: 'okala' },
            { data: 'mufa' },
            { data: 'medical_update' },
            { data: 'visa_stamping' },
            { data: 'finger' },
            { data: 'candidate.training_card_file' },
            { data: 'manpower' },
            { data: 'ticket' },            
            { data: 'action' },            
        ],
    });
});


// File - Pond
$(function(){
    FilePond.setOptions({
        server: {
            url: "{{ url('/') }}",
            process: '/upload/processing-photo',
            revert: '/revert',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
    });
});

</script>    
@endsection