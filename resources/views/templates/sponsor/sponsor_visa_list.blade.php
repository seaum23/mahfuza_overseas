{{-- @dd($sponsor_visas) --}}
@extends('layouts.app')
@section('title')
Sponsor VISA List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Sponsor VISAs</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover">
                        <thead>
                            <th>Sponsor Name</th>
                            <th>Sponsor NID</th>
                            <th>VISA No.</th>
                            <th>Country</th>
                            <th>Issue Date</th>
                            <th>VISA Amount</th>
                            <th>Gender</th> 
                            <th>Job Type</th>               
                            <th>Comment</th>
                            <th>Edit</th>
                        </thead>
                        <tbody>
                            @foreach ($sponsor_visas as $sponsor_visa)
                            <tr>
                                <td>{{ $sponsor_visa->sponsor->sponsor_name; }}</td>
                                <td>{{ $sponsor_visa->sponsor->sponsor_NID; }}</td>
                                <td>{{ $sponsor_visa->sponsor_visa; }}</td>
                                <td>{{ $sponsor_visa->country; }}</td>
                                <td>{{ $sponsor_visa->issue_date; }}</td>
                                <td>{{ $sponsor_visa->visa_amount; }}</td>
                                <td>{{ $sponsor_visa->visa_gender_type; }}</td>
                                <td>{{ $sponsor_visa->job->name; }}</td>
                                <td>{{ $sponsor_visa->comment; }}</td>
                                <td> 
                                    {{-- <button class="btn btn-primary btn-sm" data-target="#add_office_modal" data-toggle="modal" onclick="add_office_delegatge({{ $delegate->id }})">Add Office</button> --}}
                                    <button class="btn btn-warning btn-sm" onclick="update_sponsor_visa({{ $sponsor_visa->id; }})">Update</button>
                                </td>                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                
                {{ $sponsor_visas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Edit Sponsor VISA -->
<button class="hidden" id="edit_sponsor_modal_button" data-toggle="modal" data-target="#edit_sponsor_modal"></button>
<div class="modal fade" id="edit_sponsor_modal" role="dialog" aria-labelledby="change_passwordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post" enctype="multipart/form-data" id="edit_sponsor_form">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sponsor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delegate_id" id="delegate_id_modal">
                    <div class="form-row">
                        <div class="form-group row">
                            <div class="form-group col-md-6" >
                                <label>Select Sponsor Name </label>
                                <select class="form-control select2 @error('sponsorNid') is-invalid @enderror" name="sponsorNid" id="sponsorNid" required>
                                    <option value=""> Select Sponsor </option>
                                </select>
                                <div class="invalid-feedback"> @error('sponsorNid') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>Job</label>
                                <select class="form-control select2 @error('job_name') is-invalid @enderror" name="job_name" id="job_name" required>
                                    <option value=""> Select Job </option>
                                </select>
                                <div class="invalid-feedback"> @error('job_name') {{ $message }} @enderror </div>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>VISA No.</label>
                                <input class="form-control @error('visaNo.0') is-invalid @enderror" type="text" name="visaNo" id="visaNo" placeholder="Enter VISA No." required>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>Issue Date</label>
                                <input class="form-control hijri-date-input" autocomplete="off" type="text" name="issueDate" id="issueDate" placeholder="Enter Issue Date" required>
                            </div>
                            <div class="form-group col-md-6" >
                                <label>VISA Amount</label>
                                <input class="form-control @error('visaAmount.0') is-invalid @enderror" type="number" id="visaAmount" name="visaAmount" placeholder="Enter Amount" required>
                            </div>
                            <div class="form-group col-md-6" >                    
                                <label>Visa Gender Type</label>
                                <select class="form-control  @error('gender.0') is-invalid @enderror" name="gender" id="gender" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" >                    
                                <label>Country</label>
                                <select class="form-control select2 @error('country.0') is-invalid @enderror" name="country" id="country" data-placeholder="Select Country" required>
                                    <x-select-countries/>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control" name="comment" id="comment" cols="30" rows="2" placeholder="Any Remark"></textarea>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="edit_sponsor_button">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#edit_sponsor_form').on('submit',() => {
        $("#edit_sponsor_button").html('<i class="fas fa-spinner fa-pulse"></i>');
        $("#edit_sponsor_button").prop('disabled', true);
    });
    let update_sponsor_visa = (id) => {
        $.ajax({
            type: 'get',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' + '/sponsor-visa/' + id + '/edit',
            beforeSend:function(){
                $('.loader-container').show();
                // $("#edit_sponsor_button").html('<i class="fas fa-spinner fa-pulse"></i>');
                // $("#edit_sponsor_button").prop('disabled', true);
            },
            success: function (response){
                let info = JSON.parse(response);
                $('#sponsorNid').html(info.sponsor_html);
                $('#job_name').html(info.job_html);
                $('#visaNo').val(info.sponsor_visa.sponsor_visa);
                $('#issueDate').val(info.sponsor_visa.issue_date);
                $('#visaAmount').val(info.sponsor_visa.visa_amount);
                $('#gender').val(info.sponsor_visa.visa_gender_type);
                $('#comment').val(info.sponsor_visa.comment);
                $('#edit_sponsor_form').prop('action', '{{ url('/') }}' + '/sponsor-visa/' + info.sponsor_visa.id);
                $('.loader-container').hide();
                $('#country').val(info.country); // Select the option with a value of '1'
                $('#country').trigger('change');
                $('#edit_sponsor_modal_button').click();
            }
        });
    }
</script>
@endsection