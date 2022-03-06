@extends('layouts.app')
@section('title')
Maheer Account
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">Maheer Account</h5>
                <form action="" id="maheer_add_money_form">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input onkeyup="get_amount_bdt()" type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
                                        <div id="amount_invalid" class="invalid-feedback"> </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rate">Rate</label>
                                        <input  onkeyup="get_amount_bdt()" type="number" name="rate" id="rate" class="form-control" placeholder="Rate">
                                        <div id="rate_invalid" class="invalid-feedback"> </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <select name="currency" id="currency" class="form-control select2">
                                            <option value="dollar">Dollar</option>
                                            <option value="riyal">Saudi Riyal</option>
                                        </select>
                                        <div id="currency_invalid" class="invalid-feedback"> </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bdt_amount">Amount in BDT</label>
                                        <input type="number" name="bdt_amount" id="bdt_amount" class="form-control" placeholder="Amount in BDT" disabled>
                                        <div id="bdt_amount_invalid" class="invalid-feedback"> </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="text" name="date" id="date" class="form-control datepicker w-75" placeholder="date" autocomplete="off">
                                        <div id="date_invalid" class="invalid-feedback"> </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input class="my-pond form-control-file" type="file" name="maheer_account_file" id="maheer_account_file" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 align-self-center">                
                            <div class="row justify-content-center">
                                <div class="col-md-6 align-self-end">
                                    <div class="form-group">
                                        <button id="add_money_button" class="btn btn-info">Add Money</button>
                                    </div>
                                </div>
                                <div class="col-md-6 align-self-end">
                                    <div class="form-group">
                                        <button data-target="#expense_modal" data-toggle="modal" type="button" id="add_expense" class="btn btn-warning">Add Expense</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-12">
                            <div class="table-responsive w-100">
                                <table class="mb-0 table table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Particular</th>
                                            <th>Purpose</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Adjust Money</th>
                                            <th>Receipt</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')

{{-- Expense Modal --}}
<button id="expense_modal_button" data-target="#expense_modal" data-toggle="modal" style="display: none"></button>
<div class="modal fade" id="expense_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="maheer_add_expense_update_form">
            <input type="hidden" name="maheer_add_expense_update_id" id="maheer_add_expense_update_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="">
                    <div class="form-group">
                        <label for="particular_type">Select Type of Recepient</label>
                        <select onchange="get_recepient_type(this.value)" name="particular_type" id="particular_type" class="form-control select2" data-placeholder="Select Recepient Type">
                            <option value=""></option>
                            <option>Manpower Office</option>
                            <option>Outside Office</option>
                            {{-- <option>Other</option> --}}
                        </select>
                    </div>
                    <div class="form-group" id="recepient_type">

                    </div>
                    <div class="form-group">
                        <label for="expense_amount">Amount</label>
                        <input type="number" name="expense_amount" id="expense_amount" class="form-control" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <label for="expense_receipt">Receipt</label>
                        <input class="my-pond form-control-file" type="file" name="expense_receipt" id="expense_receipt" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="flight_modal_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="expense_button" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>

    let get_recepient_type = (type) => {
        $.ajax({
            type: 'get',
            enctype: 'multipart/form-data',
            url: '{{ url('maheer/maheer-expense-account-type') }}' + '/' + type,
            // data: {type},
            success: function (response){
                $('#recepient_type').html(response);
                $('.select2-ajax').select2({
                    width: '100%'
                });
            }
        });
    }

    let get_amount_bdt = () => {
        let amount = $('#amount').val();
        let rate = $('#rate').val();

        if(amount != '' && rate != ''){
            $('#bdt_amount').val(amount * rate);
        }
    }

    $('#maheer_add_expense_update_form').on('submit', (e) => {
        e.preventDefault();
        
        var form = $('#maheer_add_expense_update_form')[0];
        var data = new FormData(form);
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '{{ route('maheer.expense') }}',
            data: data,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("#expense_button").html('<i class="fas fa-spinner fa-pulse"></i>');
                $("#expense_button").prop('disabled', true);
            },
            success: function (response){
                // location.reload();
                $('#expense_modal_button').click();
                $('#maheer_add_expense_update_form')[0].reset();
                $("#expense_button").html('Submit');
                $("#expense_button").prop('disabled', false);
                datatable.ajax.url( '{{ route('maheer.datatable') }}' ).load();
                $('#expense_receipt').filepond('removeFile');
            },
            error: function (xhr, status, error){
                $("#expense_button").html('Submit');
                $("#expense_button").prop('disabled', false);
                $('#maheer_add_money_form').addClass('needs-validation');
                let errors = $.parseJSON(xhr.responseText);
                for (const [key, value] of Object.entries(errors.errors)) {
                    $(`#${key}`).addClass('is-invalid');
                    $(`#${key}_invalid`).html(value);
                }
            }
        });
    });
    
    $('#maheer_add_money_form').on('submit', (e) => {
        e.preventDefault();
        
        var form = $('#maheer_add_money_form')[0];
        var data = new FormData(form);
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' + '/maheer',
            data: data,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("#add_money_button").html('<i class="fas fa-spinner fa-pulse"></i>');
                $("#add_money_button").prop('disabled', true);
            },
            success: function (response){
                // location.reload();
                $('#maheer_add_money_form').trigger("reset");
                $("#add_money_button").html('Add Expense');
                $("#add_money_button").prop('disabled', false);
                datatable.ajax.url( '{{ route('maheer.datatable') }}' ).load();
                $('#maheer_account_file').filepond('removeFile');
            },
            error: function (xhr, status, error){
                $("#add_money_button").html('Add Expense');
                $("#add_money_button").prop('disabled', false);
                $('#maheer_add_money_form').addClass('needs-validation');
                let errors = $.parseJSON(xhr.responseText);
                for (const [key, value] of Object.entries(errors.errors)) {
                    $(`#${key}`).addClass('is-invalid');
                    $(`#${key}_invalid`).html(value);
                }
            }
        });
    });

    // Datatable init
    let datatable;
    $(function() {
        datatable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('maheer.datatable') }}",
            columns: [
                { data: 'input_date' },
                { data: 'particular' },
                { data: 'purpose' },
                { data: 'debit' },
                { data: 'credit' },
                { data: 'adjusted_value' },
                { data: 'receipt' },
            ],
            order: false
        });
    });


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
                process: '/upload/maheer',
                revert: '/revert',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });
    });
</script>
@endsection
