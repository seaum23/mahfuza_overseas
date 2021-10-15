@extends('layouts.app')
@section('title')
Delegate
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Candidate</h5>
                <form action="{{ route('delegate') }}" method="post" enctype="multipart/form-data" class="@if ($errors->any()) needs-validation @endif">
                    @csrf  
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Personal Information:</legend>
                                <div class="form-group col-md-6">
                                    <label>First Name <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control" required="required" name="fName" id="fName" placeholder="Enter First Name"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Gender <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i> </label>
                                    <select class="form-control" name="gender" id="gender" required>
                                        <option value="">----- Select Gender -----</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control" required="required" name="lName" id="lName" placeholder="Enter Last Name"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mobile No. <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control" required="required" name="mobNum" id="mobNum" placeholder="Enter Mobile Number"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Birth <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input style="width: inherit" type="text" class="form-control datepicker" required="required" name="dob" id="dob" autocomplete="off" placeholder="yyyy/mm/dd" onchange="getCandidateFromAgentExpense(this.value)"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Job Type. <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i> </label>
                                    <select class="form-control select2" name="jobType" id="jobType" onchange="get_manpower_office(this.value)"  required>
                                        <option value=""> Select Job </option>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->id }}">{{ $job->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="hidden" value="no" id="includeCandidateFromAgent" name="includeCandidateFromAgent">                   
                                    <label>NID / Birth Certificate <span id="text-show" style="color: #ff3d00; display: none;" date-toggle="modal" data-target="#show">Candidate Exists In Agent Expense List <button type="button" data-target="#show" data-toggle="modal" class="btn btn-sm btn-info mr-1" style="padding: .16rem .3rem;"><i class="fas fa-eye"></i></button><button value="no" name="includeCandidate" id="includeCandidate" type="button" class="btn btn-sm btn-danger" style="padding: .16rem .3rem;" onclick="include_Candidate(this.value)"><i class="fa fa-ban"></i></button></span> </label>
                                    <input class="form-control" type="text" name="nid" id="nid" placeholder="Enter NID" onchange="getInfo()">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Passport Information:</legend>                                    
                                <div class="form-group col-md-6">
                                    <label>Passport No. <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control" required="required" name="passportNum" id="passportNum" placeholder="Enter Passport Number"/>
                                </div>            
                                <div class="form-group col-md-6">
                                    <label>Country <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <select class="form-control select2" name="country" id="country" required>
                                        <option value=""> Select Country </option>
                                        @foreach ($countries as $country)
                                            <option>{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Issue Date <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control datepicker" autocomplete="off" required="required" name="issuD" id="issuD" placeholder="yyyy/mm/dd"/>
                                </div>
                                <div class="form-group col-md-6" style="text-align: center;">
                                    <label>Validity Year <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="validityYear" id="validityYearFive" value="5" required>
                                            <label class="custom-control-label" for="validityYearFive"> 5 Years </label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="validityYear" id="validityYearTen" value="10" required>
                                            <label class="custom-control-label" for="validityYearTen"> 10 Years </label>
                                        </div>
                                    </div>
                                </div>                    
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Experience Information: </legend>                                            
                                <div class="form-row w-100">
                                    <div class="form-group col-md-12 text-center">
                                        <label for="">Experience <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                        <div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="experience" id="experienceYes" value="new" required>
                                                <label class="custom-control-label" for="experienceYes"> New </label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="experience" id="experienceNo" value="experienced" required>
                                                <label class="custom-control-label" for="experienceNo"> Experienced </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row w-100 justify-content-center" id="experience_div" >
                                        
                                </div>                              
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Agent Information:</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="manpower"> Manpower Office <i class="fa fa-asterisk fa-xs fa-xxs text-danger" ></i></label>
                                        <select class="form-control select2" id="manpower" name="manpower" required>
                                            <option value=""> Select Job Type First </option>
                                           
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="agentNotOffice">
                                        <label for="agentEmail" style="display: block"> Agent <i class="fa fa-asterisk fa-xs fa-xxs text-danger" ></i></label>
                                        <select class="form-control select2" name="agentEmail" id="agentEmail" required>
                                            <option value=""> Select Option </option>
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->full_name }}</option>                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Payment Information:</legend> 
                                <div class="form-group col-md-6" id="visaFee" style="display: none;">
                                    <label>VISA Fee</label>
                                    <div id="visaFeeLabel"></div>
                                </div>
                                <div class="form-group col-md-6" id="visaComission" style="display: none;">
                                    <label>Comission <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <div id="visaComissionLabel"></div>
                                </div>                                
                                <div class="col-md-6 text-center">
                                    <label for="">Advance <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <div class="form-group">
                                        <label class="parking_label">Yes
                                            <input type="radio" name="advance" id="advance_yes" value="yes" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="parking_label">No
                                            <input type="radio" name="advance" id="advance_no" value="no" checked required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>                
                                </div>
                                <div class="form-group col-md-6">                    
                                    <label>Advance <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input class="form-control" type="number" name="advance_amount" id="advance_amount" placeholder="Enter Amount">
                                </div>       
                                <div class="form-group col-md-6">                    
                                    <label>Pay Date <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input class="form-control datepicker" type="text" autocomplete="off" name="payDate" id="payDate" placeholder="Enter Payment Date">
                                </div> 
                                <div class="form-group col-md-6">                    
                                    <label>Payment Mode <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <select class="form-control" name="payMode" id="payMode">
                                        <option value="">Select Payment Mode</option>
                                    </select>
                                </div>                                      
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Files:</legend>
                                <div class="form-group col-md-6" id="passportScanFile">
                                    <input class="form-control" type="file" name="passportScan" required>
                                </div>  
                                <div class="form-group col-md-6" id="passportScanFile">
                                    <input class="form-control" type="file" name="policeVerification" id="policeVerification">
                                </div>
                                            <div class="form-group col-md-6" id="passportScanFile">
                                    <input class="form-control" type="file" name="photoFile" id="photoFile_input">
                                </div>
                                            <div class="form-group col-md-6" id="passportScanFile">
                                    <input class="form-control" type="file" name="fullPhotoFile" id="fullPhotoFile">
                                </div>                                
                            </fieldset>
                        </div>
                    </div> 
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
    $('input[name=experience]').on('change', () => {
        var status = $( 'input[name=experience]:checked' ).val();
        $.ajax({
            type: 'get',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' + '/candidate-experience-status/' + status,
            beforeSend:function(){
                $("#experience_div").html('<i class="fas fa-spinner fa-pulse"></i>');
            },
            success: function (response){
                $("#experience_div").html(response);
                // Generic file-pond
                $('.my-pond').filepond({
                    credits: false,
                    'allowMultiple': false
                });

                // Generic file-pond multiple
                $('.my-pond-multiple').filepond({
                    credits: false,
                    'allowMultiple': true
                });
            }
        });
    })

    let get_manpower_office = (id) => {
        $.ajax({
            type: 'get',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' + '/get-manpower-office/' + id,
            // beforeSend:function(){
            //     $("#experience_div").html('<i class="fas fa-spinner fa-pulse"></i>');
            // },
            success: function (response){
                $("#manpower").html(response);
            }
        });
    }
</script>
@endsection