@extends('layouts.app')
@section('title')
Employee
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Employee List</h5>
                <div class="table-responsive">
                    <table id="dataTableSeaum" class="mb-0 table table-hover table-bordered" wid>
                    {{-- <table  class="table table-bordered table-hover"  style="width:100%"> --}}
                        <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Employee ID</th>
                            <th>Mobile Number</th>
                            <th>Address</th>
                            <th>Designation</th> 
                            <th>Edit</th>
                        </tr>
                        </thead>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->employee_id }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ $employee->designation->designation }}</td>
                            <!-- Edit Section -->
                            <td>
                                <div class="row">
                                    <div class="col-md-5">
                                        <button type="button" onclick="change_pass_modal({{ $employee->id }})" data-target="#change_password" data-toggle="modal" class="btn btn-info">Change Password</button>
                                    </div>
                                    <div class="col-md-2"> 
                                        <button data-target="#edit_employee" data-toggle="modal" onclick="edit_employee({{ $employee->id }})" type="button" class="btn btn-primary btn-sm">Edit</button>
                                        {{-- <form action="" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $employee->employee_id }}" name="id">
                                        </form>                                        --}}
                                    </div>
                                    <div class="col-md-2">
                                        <form action="template/newEmployeeQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="{{ $employee->employee_id }}" name="employeeId">
                                            <button type="submit" class="btn btn-danger btn-sm" name="sectionDate">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modals')
<div class="modal fade" id="change_password" role="dialog" aria-labelledby="change_passwordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="change_passwordLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="restPassForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="employeeId" id="employeeId" value="">
                    <div class="form-group">
                        <label for="old_password">Enter Old Password <span id="noMatch" style="color: red; display: none;">No Match</span> </label>
                        <input class="form-control" type="password" name="old_password" id="old_password" placeholder="Enter old password" required>
                        <div class="invalid-feedback" id="password_mismatch_message">  </div>
                    </div>
                    <div class="form-group">
                        <label for="old_password">Enter New Password </label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter new password" required>
                        <div class="invalid-feedback" id="password_confirmation_message">  </div>
                    </div>
                    <div class="form-group">
                        <label for="old_password">Confirm New Password </label>
                        <p id="notEqual" style="color: red; display: none;">Confirm Same Password</p>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="change_password_modal_close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_employee" role="dialog" aria-labelledby="edit_employeeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_employeeLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="edit_employee_form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Employee Name</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Enter Employee Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Employee Office ID</label>
                            <input class="form-control" type="text" name="officeId" id="officeId" placeholder="Enter Employee Office ID" value="{{ old('officeId') }}" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="name">Employee Mobile Number</label>
                            <input class="form-control @error('phoneNumber') is-invalid @enderror" type="text" name="phoneNumber" id="phoneNumber" placeholder="Enter Employee Mobile Number" value="{{ old('phoneNumber') }}" min="11" max="11" required>
                            <div class="invalid-feedback"> @error('phoneNumber') {{ $message }} @enderror </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Employee Address</label>
                            <input class="form-control" type="text" name="address" id="address" placeholder="Enter Employee Address" value="{{ old('address') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Employee Designation</label>
                            <select class="form-control select2" name="designation" id="designation" value="{{ old('designation') }}" required>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="edit_employee_modal_close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection