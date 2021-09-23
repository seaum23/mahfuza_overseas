@extends('layouts.app')
@section('title')
Delegate List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Delegates</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>Offices</th>
                            <th>Notes</th>
                            <th>Expense</th>
                            <th>Alter</th>
                        </thead>
                        <tbody>
                            @foreach ($delegates as $delegate)
                            <tr>
                                <td>{{ $delegate->name; }}</td>
                                <td>{{ $delegate->country; }}</td>
                                <td>{{ $delegate->state; }}</td>
                                <td>
                                    @foreach ($delegate->delegate_offices as $office)
                                        <button class="btn btn-sm btn-info" onclick="change_delegate_office({{ $office->id }}, '{{ $office->name }}', '{{ $office->license_number }}')" data-target="#changeDelegateOffice" data-toggle="modal">
                                            <p class="m-0 p-0">{{ $office->name }}: <span class="m-0 p-0">{{ $office->license_number }}</span></p>
                                            
                                        </button>
                                    @endforeach
                                </td>
                                <td>{{ $delegate->comment; }}</td>                            
                                <td>  --  </td>                            
                                <td> 
                                    <button class="btn btn-primary btn-sm" data-target="#add_office_modal" data-toggle="modal" onclick="add_office_delegatge({{ $delegate->id }})">Add Office</button>
                                    <button class="btn btn-warning btn-sm" data-target="#update_delegate_modal" data-toggle="modal" onclick="update_delegate({{ $delegate->id }}, '{{ $delegate->name }}', '{{ $delegate->country }}', '{{ $delegate->state }}', '{{ $delegate->comment }}')">Update</button>
                                </td>                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                
                {{ $delegates->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Add Office -->
<div class="modal fade" id="add_office_modal" tabindex="-1" role="dialog" aria-labelledby="change_passwordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post" enctype="multipart/form-data" id="add_delegate_office_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Office</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delegate_id" id="delegate_id_modal">
                    <div class="form-row">
                        <div class="form-group row">
                            <div class="col-md-12 mb-3">  
                                <p class="m-0 p-0" style="font-size: 18px; display: flex; align-items: center"><span class="pe-7s-help1 icon-gradient bg-ripe-malin"></span><span style="font-size: 15px" class="ml-2 page-title-subheading text-secondary">Separte each Office and License with `Comma`.</span></p>
                            </div>
                            <div class="col-md-6 mb-2">  
                                <label for="sel1">Office: </label>
                                <input class="form-control" type="text" name="delegateOffice" placeholder="Office name" required>
                            </div>
                            <div class="col-md-6">  
                                <label for="sel1">License Number: </label>
                                <input class="form-control" type="text" name="licenseNumber" placeholder="License Number" required>
                            </div>
                            <div class="col-md-12 mt-1">
                                <p class="text-danger m-0 p-0" style="display: none" id="error_message"></p>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="add_office_button">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Delete Office -->
<div class="modal fade" id="changeDelegateOffice" tabindex="-1" role="dialog" aria-labelledby="change_passwordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Office Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" name="delegateOfficeId" id="delegateOfficeIdModal">
                <label for="">Office Name</label>
                <input class="form-control" type="text" name="officeName" id="officeNameModal">
                <label for="">License Number</label>
                <input class="form-control" type="text" name="licenseNum" id="licenseNumModal">
                
            </div>
            <div class="modal-footer">
                <form action="" method="post" enctype="multipart/form-data" id="delete_delegate_office">
                    <button type="submit" name="delete" class="btn btn-danger" id="delete_button">Delete</button>
                </form>
                <form action="" method="post" enctype="multipart/form-data" id="update_delegate_office">
                    <button type="submit" class="btn btn-primary" id="update_button">Update</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Delegate -->
<div class="modal fade" id="update_delegate_modal" tabindex="-1" role="dialog" aria-labelledby="change_passwordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delegate Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="update_delegate">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="delegate_id_update">
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update_button_delegate">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection