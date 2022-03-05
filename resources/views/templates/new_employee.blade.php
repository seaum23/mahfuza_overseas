@extends('layouts.app')
@section('title')
Employee
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Employee</h5>
                <form action="{{ route('employee') }}" method="post" enctype="multipart/form-data" class="@error('phoneNumber') needs-validation @enderror">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Employee Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Employee Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Employee Office ID</label>
                            <input class="form-control" type="text" name="officeId" placeholder="Enter Employee Office ID" value="{{ old('officeId') }}" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="name">Employee Mobile Number</label>
                            <input class="form-control @error('phoneNumber') is-invalid @enderror" type="text" name="phoneNumber" placeholder="Enter Employee Mobile Number" value="{{ old('phoneNumber') }}" required>
                            <div class="invalid-feedback"> @error('phoneNumber') {{ $message }} @enderror </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Employee Address</label>
                            <input class="form-control" type="text" name="address" placeholder="Enter Employee Address" value="{{ old('address') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Employee Roles</label>
                            <select class="form-control select2" name="designation" id="designation" value="{{ old('designation') }}" required>
                                <option value="">Select Roles</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Password</label>
                            <input class="form-control" type="text" name="password_text" id="password_text" value="random_password()" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-md-center">
                        <input type="submit" class="btn btn-primary" value="Submit" style="font-size: 15px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection