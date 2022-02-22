@extends('layouts.app')
@section('title') New Sponsor @endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5 col-10">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Sponsor</h5>
                <form action="{{ route('sponsor') }}" method="post" class="@if ($errors->any()) needs-validation @endif">
                    @csrf
                    <div class="form-group">
                        <div class="form-row justify-content-between">
                            <div class="form-group col-md-4" >
                                <label>Type</label>
                                <select class="form-control select2 @error('type') is-invalid @enderror" name="type" id="type" onchange="get_type(this.value)">
                                    <option value=""> Select Type </option>
                                    <option>Delegate</option>
                                    <option>Agent</option>
                                </select>
                                <div class="invalid-feedback"> @error('type') {{ $message }} @enderror </div>
                            </div>
                            <div class="col-md-8" id="sponsor_parent_type"></div>
                            <div class="form-group col-md-6" >
                                <label>Sponsor Name</label>
                                <input class="form-control @error('sponsorName') is-invalid @enderror" type="text" id="sponsorName" name="sponsorName" placeholder="Enter Name" value="{{ old('sponsorName') }}" >
                                <div class="invalid-feedback"> @error('sponsorName') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>Sponsor NID</label>
                                <input class="form-control @error('sponsorNid') is-invalid @enderror" type="text" id="sponsorNid" name="sponsorNid" placeholder="Enter NID" value="{{ old('sponsorNid') }}" >
                                <div class="invalid-feedback"> @error('sponsorNid') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6" >                    
                                <label>Sponsor Phone Number</label>
                                <input class="form-control @error('sponsorPhone') is-invalid @enderror" type="text" id="sponsorPhone" name="sponsorPhone" placeholder="Enter Number" value="{{ old('sponsorPhone') }}">
                                <div class="invalid-feedback"> @error('sponsorPhone') {{ $message }} @enderror </div>
                            </div>            
                            <div class="form-group col-md-6" >                    
                                <label>Comment</label>
                                <input class="form-control" type="text" id="comment" name="comment" placeholder="Any Remark..." value="{{ old('comment') }}">
                            </div>
                        </div>
                        <div class="row ">
                            <div>
                                <div class="custom-radio custom-control custom-control-inline">
                                    <input onclick="add_visa_to_sponsor(this.value)" class="custom-control-input" type="radio" name="addVisa" id="addVisaNew" value="yes" >
                                    <label class="custom-control-label" for="addVisaNew"> Add Visa </label>
                                </div>
                                <div class="custom-radio custom-control custom-control-inline">
                                    <input onclick="add_visa_to_sponsor(this.value)" class="custom-control-input" type="radio" name="addVisa" id="addVisaDefault" value="no" checked>
                                    <label class="custom-control-label" for="addVisaDefault"> Default </label>
                                </div>
                            </div>
                        </div>
                        <div id="visa_to_sponsor"></div>
                        <div id="candidate_to_visa"></div>
                        <div class="row justify-content-center">                            
                            <div class="col-md-1">
                                <button class="btn btn-primary">Add</button>
                            </div>
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

    let add_candidate = (val) => {
        console.log(val);
        if(val != 1){
            $('#candidate_to_visa').html('');
            return;
        }

        let job_type = $('#job_name').val();
        let gender = $('#gender').val();

        if(job_type !== '' && gender !== ''){
            $.ajax({
                type: 'get',
                enctype: 'multipart/form-data',
                url: '{{ url('/') }}' + '/candidate-to-sponsor-visa',
                data: {job_type, gender},
                success: function (response){
                    $('#candidate_to_visa').html(response);
                    $('.select2-ajax').select2({
                        width: '100%'
                    });
                }
            });
        }
    }

    let add_visa_to_sponsor = (type) => {
        if(type == 'no'){
            $('#visa_to_sponsor').html('');
            return;
        }
        $.ajax({
            type: 'get',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' + '/visa-to-sponsor',
            // data: {type},
            success: function (response){
                $('#visa_to_sponsor').html(response);
                $('.select2-ajax').select2({
                    width: '100%'
                });
                $(".hijri-date-input").hijriDatePicker({
                    locale: "en-us",
                    hijri: true
                });
            }
        });
    }

    let get_type = (type) => {
        $.ajax({
            type: 'get',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' + '/get-sponsor-parent-type',
            data: {type},
            success: function (response){
                $('#sponsor_parent_type').html(response);
                $('.select2-ajax').select2({
                    width: '100%'
                });
            }
        });
    }

    function selectDelegateOffice(delegate_id){
        let selected_office = $('#delegateOfficeId').data('selected_office');
        $.ajax({
            type: 'post',
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
</script>
@endsection