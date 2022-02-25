@extends('layouts.app')
@section('title')
Ticket Assign
@endsection

@section('content')
<div class="app-page-title">
        <div class="row">
            <div class="col-md-8">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-wallet icon-gradient bg-plum-plate"></i>
                        </div>
                        <div>
                            {{ $candidate->fName . ' ' . $candidate->lName }}
                            <div class="page-title-subheading">Ticket. </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 align-self-center align-self-end">
                <button onclick="finish_without_ticket({{ $processing_id }})" class="btn btn-warning btn-sm">Finish without ticket!</button>
            </div>
        </div>
    </div>
<div class="row clearfix justify-content-center">
    <div class="col-lg-8">
        <div class="card mt-3 card">
            <div class="card-body"><h5 class="card-title">Ticket Information</h5>
                <form id="ticket_form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">                            
                        {{-- <div class="form-group col-md-6 col-12">
                            <label for="sel1">Select Airplane:</label>
                            <input class="form-control" type="text" name="airline" id="airline" placeholder="Enter Airplane Name" value="{{ (isset($edit)) ? $edit->airline : '' }}">
                            <div id="airline_invalid" class="invalid-feedback"> </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="sel1">Flight No:</label>
                            <input class="form-control" type="text" name="flightNo" id="flightNo" placeholder="Enter Flight No" value="{{ (isset($edit)) ? $edit->flight_number : '' }}">
                            <div id="flightNo_invalid" class="invalid-feedback"> </div>
                        </div> --}}
                        <div class="form-group col-md-6 col-12">
                            <label for="sel1">Flight Date:</label>
                            <input class="form-control datepicker" type="text" autocomplete="off" name="flightDate" id="flightDate" placeholder="Flight Date" value="{{ (isset($edit)) ? $edit->flight_number : '' }}">
                            <div id="flightDate_invalid" class="invalid-feedback"> </div>
                        </div>
                        {{-- <div class="form-group col-md-3 col-3" style="text-align: center;">
                            <label>Transit</label>
                            <div class="form-group">
                                <label class="parking_label">Yes
                                    <input type="radio" name="transit" value="yes" required value="{{ (isset($edit)) ? (!empty($edit->transit)) ? 'checked' : ''  : '' }}">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="parking_label">No
                                    <input type="radio" name="transit" value="no" required value="{{ (isset($edit)) ? (!empty($edit->transit)) ? '' : 'checked'  : '' }}">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-3" id="transitHourDiv" style="display: none;">
                            <label for="sel1">Transit:</label>
                            <input class="form-control col-md-12" type="number" name="transitHour" id="transitHour" placeholder="Transit Hours" step="any">
                        </div> --}}
                        <div class="form-group col-md-6 col-12">
                            <label for="sel1">Flight Time:</label>
                            <input class="form-control timePicker" type="text" autocomplete="off" name="flightTime" id="flightTime" placeholder="Flight Time">
                            <div id="flightTime_invalid" class="invalid-feedback"> </div>
                        </div>
                        {{-- <div class="form-group col-md-6 col-12">
                            <div class="row">
                                <div class="col-sm">
                                    <label for="sel1">From:</label>
                                    <select class="form-control select2" id="fromPlace" name="fromPlace" data-placeholder="Select Airport" required>
                                        <x-select-airport/>
                                    </select>
                                    <div id="fromPlace_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="col-sm">
                                    <label for="sel1">To:</label>
                                    <select class="form-control select2" id="toPlace" name="toPlace" data-placeholder="Select Airport" required>
                                        <x-select-airport/>
                                    </select>
                                    <div id="toPlace_invalid" class="invalid-feedback"> </div>
                                </div>
                            </div>                        
                        </div> --}}
                        <div class="form-group col-md-6 col-12">
                            <label for="sel1">Amount:</label>
                            <input class="form-control" type="number" name="amount" id="amount" placeholder="BDT" value="{{ (isset($edit)) ? $edit->ticket_price : '' }}">
                            <div id="amount_invalid" class="invalid-feedback" step="any"> </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="sel1">Ticket Copy:</label>
                            <input class="form-control-file my-pond" type="file" name="ticketCopy" id="ticketCopy">
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="sel1">Comment:</label>
                            <input class="form-control" type="text" name="comment" placeholder="Remarks" value="{{ (isset($edit)) ? $edit->comment : '' }}">
                        </div>
                        <div class="form-group col-md-12 col-12 text-center">
                            <button id="submit" type="submit" class="btn btn-success">Submit</button>                    
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
@endsection

@section('script')
@isset($edit)
<script>
    $('#fromPlace').val('{{ $edit->flight_from }}');
    $('#fromPlace').select2().trigger('change');
    $('#toPlace').val('{{ $edit->flight_to }}');
    $('#toPlace').select2().trigger('change');
</script>
@endisset
<script>
$('input[type=radio][name=transit]').change(function() {
    if (this.value == 'yes') {
        $('#transitHourDiv').show();
        $('#transitHour').prop('required', true);
    }
    else {
        $('#transitHourDiv').hide();
        $('#transitHour').prop('required', false);
    }
});

let finish_without_ticket = (id) => {
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/processing/flight_update_wo_ticket/' + '{{ $processing_id }}',
        success: function (response){
            location.href = "{{ url('processing') }}";
        }
    });
}

$('#ticket_form').on('submit', (e) => {
    $('#ticket_form').removeClass('needs-validation');
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    e.preventDefault();
    let formData = new FormData($('#ticket_form')[0]);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/ticket/' + '{{ $processing_id }}',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend:function(){
            $("#submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#submit").prop('disabled', true);
        },
        success: function (response){
            location.href = "{{ url('ticket') }}";
        },
        error: function (xhr, status, error){
            $("#submit").html('Add');
            $("#submit").prop('disabled', false);
            $('#ticket_form').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}`).focus();
                $(`#${key}_invalid`).html(value);
            }
        }
    });
});

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