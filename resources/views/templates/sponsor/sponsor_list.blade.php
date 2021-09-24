@extends('layouts.app')
@section('title')
Sponsors List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Sponsors</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover" id="sponsor_list_datatable">
                        <thead>
                            <tr>
                                <th>
                                    <span data-toggle="tooltip" data-placement="top" data-original-title="(Delegate - Delegate Office)" >Delegate Information</span>
                                </th>
                                <th>Sponsor Name</th>
                                <th>Sponsor NID</th>
                                <th>VISA No.</th>
                                <th>Sponsor Phone</th>
                                <th>Comment</th>
                                <th>Alter</th>
                            </tr>
                        </thead>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Update Sponsor -->
<div class="modal fade" id="update_sponsor_modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Sponsor Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="update_sponsor">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="sponsor_id_update">
                        <div class="form-group col-md-6" >
                            <label>Delegate</label>
                            <select class="form-control select2 @error('delegateId') is-invalid @enderror" name="delegateId" id="delegateId" onchange="selectDelegateOffice(this.value)" value="3" required></select>
                            <div class="invalid-feedback"> @error('delegateId') {{ $message }} @enderror </div>
                        </div>
                        <div class="form-group col-md-6" >
                            <label>Delegate Office</label>
                            <select data-selected_office="{{ old('delegateOfficeId') }}" class="form-control select2 @error('delegateOfficeId') is-invalid @enderror" name="delegateOfficeId" id="delegateOfficeId" required></select>
                            <div class="invalid-feedback"> @error('delegateOfficeId') {{ $message }} @enderror </div>
                        </div>
                        <div class="form-group col-md-6" >
                            <label>Sponsor Name</label>
                            <input class="form-control @error('sponsorName') is-invalid @enderror" type="text" id="sponsorName" name="sponsorName" placeholder="Enter Name" value="{{ old('sponsorName') }}"  required>
                            <div class="invalid-feedback"> @error('sponsorName') {{ $message }} @enderror </div>
                        </div>
                        <div class="form-group col-md-6" >
                            <label>Sponsor NID</label>
                            <input class="form-control" type="text" id="sponsorNid" name="sponsorNid" placeholder="Enter NID" value="{{ old('sponsorNid') }}"  required>
                            <div id="sponsorNid_message" class="invalid-feedback">  </div>
                        </div>
                        <div class="form-group col-md-6" >                    
                            <label>Sponsor Phone Number</label>
                            <input class="form-control @error('sponsorPhone') is-invalid @enderror" type="text" id="sponsorPhone" name="sponsorPhone" placeholder="Enter Number" value="{{ old('sponsorPhone') }}" required>
                            <div class="invalid-feedback"> @error('sponsorPhone') {{ $message }} @enderror </div>
                        </div>            
                        <div class="form-group col-md-6" >                    
                            <label>Comment</label>
                            <input class="form-control" type="text" id="comment" name="comment" placeholder="Any Remark..." value="{{ old('comment') }}">
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update_button_sponsor">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection