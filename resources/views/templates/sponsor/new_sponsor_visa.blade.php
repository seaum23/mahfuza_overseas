@extends('layouts.app')
@section('title') Sponsor VISA @endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Sponsor VISA</h5>
                <form action="{{ url('/sponsor-visa') }}" id="sponsor_visa_form" method="post" class="@if ($errors->any()) needs-validation @endif">
                    @csrf
                    <div class="form-group">
                        <div class="form-row justify-content-between">
                            <div class="form-group col-md-6" >
                                <label>Select Sponsor Name </label>
                                <select class="form-control select2 @error('sponsorNid') is-invalid @enderror" name="sponsorNid" id="sponsorNid" required>
                                    <option value=""> Select Sponsor </option>
                                    @foreach ($sponsors as $sponsor)
                                        <option value="{{ $sponsor->id }}" {{ (old("sponsorNid") == $sponsor->id ? "selected":"") }} > {{ $sponsor->sponsor_name }} </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"> @error('sponsorNid') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>Job</label>
                                <select class="form-control select2 @error('job_name') is-invalid @enderror" name="job_name" id="job_name" required>
                                    <option value=""> Select Job </option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}" {{ (old("job_name") == $job->id ? "selected":"") }} > {{ $job->name }} </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"> @error('job_name') {{ $message }} @enderror </div>
                            </div>
                        </div>
                        <div id="existing_form">
                            <div class="form-row justify-content-between form-body">
                                <div class="form-group col-md-6" >
                                    <label>VISA No.</label>
                                    <input class="form-control @error('visaNo.0') is-invalid @enderror" type="text" name="visaNo[]" placeholder="Enter VISA No." required>
                                </div>
                                <div class="form-group col-md-6" >
                                    <label>Issue Date</label>
                                    <input class="form-control hijri-date-input" autocomplete="off" type="text" name="issueDate[]" placeholder="Enter Issue Date" required>
                                </div>
                                <div class="form-group col-md-6" >
                                    <label>VISA Amount</label>
                                    <input class="form-control @error('visaAmount.0') is-invalid @enderror" type="number" name="visaAmount[]" placeholder="Enter Amount" required>
                                </div>
                                <div class="form-group col-md-6" >                    
                                    <label>Visa Gender Type</label>
                                    <select class="form-control  @error('gender.0') is-invalid @enderror" name="gender[]" required>
                                        <option value=""> Select Gender </option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="additional_form"></div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="button" id="add_visa" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                            <button class="btn btn-sm btn-danger" type="button" id="remove_visa"><span class="fas fa-minus" aria-hidden="true"></span></button>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" id="comment" cols="30" rows="3" placeholder="Any Remark"></textarea>
                        </div>
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
    $('#add_visa').on('click',() => {    
        $('#additional_form').append('<div class="divider"> </div>' + $('#existing_form').html());
        $(".hijri-date-input").hijriDatePicker({
            locale: "en-us",
            hijri: true
        });
    })

    $('#remove_visa').on('click',() => {
        if($('.form-body').length > 1){
            $('.form-body').last().remove()
            $('.divider').last().remove()
        }
    })
    $(document).ready(() => {
        $(".hijri-date-input").hijriDatePicker({
            locale: "en-us",
            hijri: true
        });
    });
    $(function () {
        initHijrDatePicker();
    });

    function initHijrDatePicker() {
        $(".hijri-date-input").hijriDatePicker({
            locale: "en-us",
            hijri: true
        });
    }
    
</script>
@endsection