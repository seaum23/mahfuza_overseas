@extends('layouts.app')
@section('title')
Delegate
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Delegate</h5>
                <form action="{{ route('delegate') }}" method="post" enctype="multipart/form-data" class="@if ($errors->any()) needs-validation @endif">
                    @csrf                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6" >
                                <label>Delegate Name</label>
                                <input class="form-control @error('delegateName') is-invalid @enderror" type="text" name="delegateName" id="delegateName" placeholder="Enter Name" value="{{ old('delegateName') }}">
                                <div class="invalid-feedback"> @error('delegateName') {{ $message }} @enderror </div>
                            </div>                
                            <div class="form-group col-md-6">
                                <label for="sel1">Country:</label>
                                <input class="form-control @error('delegateCountry') is-invalid @enderror" type="text" name="delegateCountry" id="delegateCountry" placeholder="Country" value="{{ old('delegateCountry') }}" >
                                <div class="invalid-feedback"> @error('delegateCountry') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sel1">State:</label>
                                <input class="form-control @error('delegateState') is-invalid @enderror" type="text" name="delegateState" id="delegateState" placeholder="State" value="{{ old('delegateState') }}" >
                                <div class="invalid-feedback"> @error('delegateState') {{ $message }} @enderror </div>
                            </div>               
                            <div class="form-group col-md-6">
                                <label for="sel1">Any Remarks:</label>
                                <input class="form-control @error('comment') is-invalid @enderror" type="text" name="comment" id="comment" placeholder="comment" value="{{ old('comment') }}" >
                                <div class="invalid-feedback"> @error('comment') {{ $message }} @enderror </div>
                            </div>                
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <p class="m-0 p-0" style="font-size: 18px; display: flex; align-items: center"><span class="pe-7s-help1 icon-gradient bg-ripe-malin"></span><span style="font-size: 15px" class="ml-2 page-title-subheading text-secondary">Separte each Office and License with `Comma`.</span></p>
                                <p class="text-danger m-0 p-0"> @error('numbers') {{ $message }} @enderror </p>
                            </div>
                            <div class="col-md-6">  
                                <label for="sel1">Office: </label>
                                <input class="form-control @error('numbers') is-invalid @enderror @error('delegateOffice') is-invalid @enderror" type="text" name="delegateOffice" placeholder="Office name" value="{{ old('delegateOffice') }}" >
                                <div class="invalid-feedback"> @error('delegateOffice') {{ $message }} @enderror </div>
                            </div>
                            <div class="col-md-6">  
                                <label for="sel1">License Number: </label>
                                <input class="form-control @error('numbers') is-invalid @enderror @error('licenseNumber') is-invalid @enderror" type="text" name="licenseNumber" placeholder="License Number" value="{{ old('licenseNumber') }}" >
                                <div class="invalid-feedback"> @error('licenseNumber') {{ $message }} @enderror </div>
                            </div>
                        </div>
                        <div id="officeDiv">
                        </div>                
                        {{-- <div class="form-row">
                            <div class="form-group">
                                <button class="btn btn-sm" type="button" id="add_office" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                                <button class="btn btn-sm btn-danger" type="button" id="remove_office"><span class="fas fa-minus" aria-hidden="true"></span></button>
                            </div>
                        </div> --}}
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