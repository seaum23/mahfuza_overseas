@extends('layouts.app')
@section('title') New Sponsor @endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Delegate</h5>
                <form action="{{ route('sponsor') }}" method="post" class="@if ($errors->any()) needs-validation @endif">
                    @csrf
                    <div class="form-group">
                        <div class="form-row justify-content-between">
                            <div class="form-group col-md-6" >
                                <label>Delegate</label>
                                <select class="form-control select2 @error('delegateId') is-invalid @enderror" name="delegateId" id="delegateId" onchange="selectDelegateOffice(this.value)" value="3">
                                    <option value=""> Select Delegate </option>
                                    @foreach ($delegates as $delegate)
                                        <option value="{{ $delegate->id }}" {{ (old("delegateId") == $delegate->id ? "selected":"") }} >{{ $delegate->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"> @error('delegateId') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>Delegate Office</label>
                                <select data-selected_office="{{ old('delegateOfficeId') }}" class="form-control select2 @error('delegateOfficeId') is-invalid @enderror" name="delegateOfficeId" id="delegateOfficeId" >
                                    <option value=""> Select Delegate First </option>                    
                                </select>
                                <div class="invalid-feedback"> @error('delegateOfficeId') {{ $message }} @enderror </div>
                            </div>
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