@extends('layouts.app')
@section('title')
Manpower Office
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Manpower Office</h5>
                <form action="{{ url('manpower-office') }}" id="manpower_office" method="post" enctype="multipart/form-data" class="@if ($errors->any()) needs-validation @endif">
                    @csrf                    
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Office Name</label>
                                <input class="form-control @error('officeName') is-invalid @enderror" autocomplete="off" type="text" name="officeName" placeholder="Enter Name" value="{{ old('officeName') }}" required>
                                <div class="invalid-feedback"> @error('officeName') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>License Number</label>
                                <input class="form-control @error('licenseNumber') is-invalid @enderror" autocomplete="off" type="text" name="licenseNumber" placeholder="Enter License Number" value="{{ old('licenseNumber') }}" required>
                                <div class="invalid-feedback"> @error('licenseNumber') {{ $message }} @enderror </div>
                            </div>                
                            <div class="form-group col-md-6">
                                <label>Office Address</label>
                                <input class="form-control @error('officeAddress') is-invalid @enderror" autocomplete="off" type="text" name="officeAddress" placeholder="Enter Office Address" value="{{ old('officeAddress') }}" required>
                                <div class="invalid-feedback"> @error('officeAddress') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Comment</label>
                                <input class="form-control @error('comment') is-invalid @enderror" autocomplete="off" type="text" id="comment" name="comment" placeholder="Any comment" value="{{ old('comment') }}" >
                                <div class="invalid-feedback"> @error('comment') {{ $message }} @enderror </div>
                            </div>
                        </div>
                        <div id="job-body">
                            <div class="row">
                                <div class="col-sm">                        
                                    <label>Job</label>
                                    <select class="form-control select2" name="jobId[]" required>
                                    <option value="">Select Job</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}">{{ $job->name . ' - ' . $job->credit_type }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label>Processing Cost</label>
                                    <input class="form-control" autocomplete="off" type="number" name="processingCost[]" placeholder="Cost" value="{{ old('processingCost.0') }}" required>
                                </div>
                            </div>              
                        </div>
                        <div id="extra-job-body"></div>
                        <div class="row">
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
                        <div class="row">
                            <div class="col-md-6">
                                <label for="opening_balance">Opening Balance: </label>
                                <input class="form-control" type="number" name="opening_balance" id="opening_balance" placeholder="Opening Balance" value="{{ old('opening_balance') }}" >
                            </div>
                        </div>
                    </div>
                    <div id="test"></div>
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-2">  
                            <button class="btn btn-primary" id="submit" name="submit" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#add_office').on('click',() => {
        $.ajax({
            type: 'get',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' +'/manpower-office.fetch.form-element',
            beforeSend:function(){
                $("#add_office").html('<i class="fas fa-spinner fa-pulse"></i>');
                $("#add_office").prop('disabled', true);
            },
            success: function (response){
                let info = JSON.parse(response);
                $('#extra-job-body').append( info.html );
                $("#add_office").html('<span class="fa fa-plus" aria-hidden="true"></span>');
                $("#add_office").prop('disabled', false);
                $('.select2').select2({
                    width: '100%'
                });
            }
        });
    });
    $('#remove_office').on('click',() => {
        $('.jod-extra-body').last().remove();
    });    
</script>
@endsection