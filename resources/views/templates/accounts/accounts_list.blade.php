@extends('layouts.app')
@section('title')
Accounts List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Asset</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Liability</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                    <span>Revenue</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-3">
                    <span>Expense</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-4">
                    <span>Equity</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">            
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="/" id="asset_account_form">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input name="account_name" type="text" class="form-control" placeholder="Account Name">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="payment_account" value="yes" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Payable
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mt-3 card">
                            <div class="card-body">
                                <div class="table-responsive w-100">
                                    <table class="mb-0 table table-hover" id="assets_datatable">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Account Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($assets as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->account }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $assets->links() }}
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="/" id="liablility_account_form">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input name="account_name" type="text" class="form-control" placeholder="Account Name">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="payment_account" value="yes" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Payable
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mt-3 card">
                            <div class="card-body">
                                <div class="table-responsive w-100">
                                    <table class="mb-0 table table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Account Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($liabilities as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->account }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $liabilities->links() }}
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="/" id="revenue_account_form">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input name="account_name" type="text" class="form-control" placeholder="Account Name">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="payment_account" value="yes" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Payable
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mt-3 card">
                            <div class="card-body">
                                <div class="table-responsive w-100">
                                    <table class="mb-0 table table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Account Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($revenues as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->account }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $revenues->links() }}
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="/" id="expense_account_form">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input name="account_name" type="text" class="form-control" placeholder="Account Name">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="payment_account" value="yes" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Payable
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mt-3 card">
                            <div class="card-body">
                                <div class="table-responsive w-100">
                                    <table class="mb-0 table table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Account Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($expenseces as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->account }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $expenseces->links() }}
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="/" id="equity_account_form">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input name="account_name" type="text" class="form-control" placeholder="Account Name">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="payment_account" value="yes" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Payable
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mt-3 card">
                            <div class="card-body">
                                <div class="table-responsive w-100">
                                    <table class="mb-0 table table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Account Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($equities as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->account }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $equities->links() }}
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
@endsection

@section('script')

<script>
$('#asset_account_form').on('submit', (e) => {
    e.preventDefault();
    let formData = new FormData($('#asset_account_form')[0]);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' +'/accounts/asset',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend:function(){
            $("#submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#submit").prop('disabled', true);
        },
        success: function (response){
            // $("#add_office").html('Add');
            // $("#add_office").prop('disabled', false);
            // let info = JSON.parse(response);
            // $('#extra-job-body').append( info.html );                
            // $('.select2').select2({
            //     width: '100%'
            // });
            // location.reload();
        },
        error: function (xhr, status, error){
            $("#submit").html('Add');
            $("#submit").prop('disabled', false);
            $('#agent_form').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}_invalid`).html(value);
            }
        }
    });
})
$('#liability_account_form').on('submit', (e) => {
    e.preventDefault();
    let formData = new FormData($('#liability_account_form')[0]);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' +'/accounts/liability',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend:function(){
            $("#submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#submit").prop('disabled', true);
        },
        success: function (response){
            // $("#add_office").html('Add');
            // $("#add_office").prop('disabled', false);
            // let info = JSON.parse(response);
            // $('#extra-job-body').append( info.html );                
            // $('.select2').select2({
            //     width: '100%'
            // });
            // location.reload();
        },
        error: function (xhr, status, error){
            $("#submit").html('Add');
            $("#submit").prop('disabled', false);
            $('#agent_form').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}_invalid`).html(value);
            }
        }
    });
})
$('#revenue_account_form').on('submit', (e) => {
    e.preventDefault();
    let formData = new FormData($('#revenue_account_form')[0]);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' +'/accounts/revenue',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend:function(){
            $("#submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#submit").prop('disabled', true);
        },
        success: function (response){
            // $("#add_office").html('Add');
            // $("#add_office").prop('disabled', false);
            // let info = JSON.parse(response);
            // $('#extra-job-body').append( info.html );                
            // $('.select2').select2({
            //     width: '100%'
            // });
            // location.reload();
        },
        error: function (xhr, status, error){
            $("#submit").html('Add');
            $("#submit").prop('disabled', false);
            $('#agent_form').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}_invalid`).html(value);
            }
        }
    });
})
$('#expense_account_form').on('submit', (e) => {
    e.preventDefault();
    let formData = new FormData($('#expense_account_form')[0]);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' +'/accounts/expense',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend:function(){
            $("#submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#submit").prop('disabled', true);
        },
        success: function (response){
            // $("#add_office").html('Add');
            // $("#add_office").prop('disabled', false);
            // let info = JSON.parse(response);
            // $('#extra-job-body').append( info.html );                
            // $('.select2').select2({
            //     width: '100%'
            // });
            // location.reload();
        },
        error: function (xhr, status, error){
            $("#submit").html('Add');
            $("#submit").prop('disabled', false);
            $('#agent_form').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}_invalid`).html(value);
            }
        }
    });
})
$('#equity_account_form').on('submit', (e) => {
    e.preventDefault();
    let formData = new FormData($('#equity_account_form')[0]);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' +'/accounts/equity',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend:function(){
            $("#submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#submit").prop('disabled', true);
        },
        success: function (response){
            // $("#add_office").html('Add');
            // $("#add_office").prop('disabled', false);
            // let info = JSON.parse(response);
            // $('#extra-job-body').append( info.html );                
            // $('.select2').select2({
            //     width: '100%'
            // });
            // location.reload();
        },
        error: function (xhr, status, error){
            $("#submit").html('Add');
            $("#submit").prop('disabled', false);
            $('#agent_form').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}_invalid`).html(value);
            }
        }
    });
})
</script>

@endsection
