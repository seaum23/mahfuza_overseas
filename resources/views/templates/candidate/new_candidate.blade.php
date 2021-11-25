@extends('layouts.app')
@section('title')
Delegate
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header"><h5>New Candidate</h5></div>
            <div class="card-body">
                <form id="candidate_form" action="" method="post" enctype="multipart/form-data">
                    @csrf  
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Personal Information:</legend>
                                <div class="form-group col-md-6">
                                    <label>First Name <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name"/>
                                    <div id="first_name_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name"/>
                                    <div id="last_name_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Gender <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i> </label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select Gender">
                                        <option></option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    <div id="gender_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mobile No. <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Mobile Number"/>
                                    <div id="phone_number_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Birth <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input style="width: inherit" type="text" class="form-control datepicker" name="date_of_birth" id="date_of_birth" autocomplete="off" placeholder="yyyy/mm/dd" {{-- onchange="getCandidateFromAgentExpense(this.value)" --}}/>
                                    <div id="date_of_birth_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Job Type. <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i> </label>
                                    <select class="form-control ms select2" name="job_type" id="job_type" onchange="get_manpower_office(this.value)"  data-placeholder="Select Job" >
                                        <option value=""></option>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->id }}">{{ $job->name . ' - ' . $job->credit_type }}</option>
                                        @endforeach
                                    </select>
                                    <div id="job_type_invalid" class="invalid-feedback"> </div>
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
                                    <input type="text" class="form-control" name="passport_number" id="passport_number" placeholder="Enter Passport Number"/>
                                    <div id="passport_number_invalid" class="invalid-feedback"> </div>
                                </div>            
                                <div class="form-group col-md-6">
                                    <label>Country <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <select class="form-control select2" name="country" id="country" >
                                        <option value=""> Select Country </option>
                                        @foreach ($countries as $country)
                                            <option>{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                    <div id="country_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Issue Date <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control datepicker" autocomplete="off" name="issu_date" id="issu_date" placeholder="yyyy/mm/dd"/>
                                    <div id="issu_date_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="form-group col-md-6" style="text-align: center;">
                                    <label>Validity Year <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="validityYear" id="validityYearFive" value="5" >
                                            <label class="custom-control-label" for="validityYearFive"> 5 Years </label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="validityYear" id="validityYearTen" value="10" >
                                            <label class="custom-control-label" for="validityYearTen"> 10 Years </label>
                                        </div>
                                    </div>
                                </div>                    
                            </fieldset>                            
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Agent Information:</legend>
                                <div class="row w-100">
                                    <div class="col-md-6">
                                        <label for="manpower"> Manpower Office <i class="fa fa-asterisk fa-xs fa-xxs text-danger" ></i></label>
                                        <select class="form-control select2" id="manpower" name="manpower" style="width: 100%" >
                                            <option value=""> Select Job Type First </option>                                            
                                        </select>
                                        <div id="manpower_invalid" class="invalid-feedback"> </div>
                                    </div>
                                    <div class="col-md-6" id="agentNotOffice">
                                        <label for="agent" style="display: block"> Agent <i class="fa fa-asterisk fa-xs fa-xxs text-danger" ></i></label>
                                        <select class="form-control select2" name="agent" id="agent" >
                                            <option value=""> Select Option </option>
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->full_name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="agent_invalid" class="invalid-feedback"> </div>
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
                                                <input class="custom-control-input" type="radio" name="experience" id="experienceYes" value="1" >
                                                <label class="custom-control-label" for="experienceYes"> New </label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="experience" id="experienceNo" value="2" >
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
                                <legend>Files:</legend>
                                <div class="form-group col-md-4" id="passportScanFile">
                                    <label for="passport_scan" style="display: block"> Passport Copy <i class="fa fa-asterisk fa-xs fa-xxs text-danger" ></i></label>
                                    <input class="my-pond form-control-file" type="file" name="passport_scan" id="passport_scan" >
                                    <div id="passport_scan_invalid" class="invalid-feedback"> </div>
                                </div>  
                                <div class="form-group col-md-4">
                                    <label for="policeVerification" style="display: block"> Police Verification </label>
                                    <input class="my-pond form-control-file" type="file" name="policeVerification" id="policeVerification" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="photoFile" style="display: block"> Candidate Photo </label>
                                    <input class="my-pond form-control-file" type="file" name="photoFile" id="photoFile" >
                                </div>                                
                                <div class="form-group col-md-4">
                                    <label>Optional File/Files</label>
                                    <input class="my-pond-multiple form-control-file" type="file" name="optionalFile[]" id="optionalFile" multiple>
                                </div>                           
                            </fieldset>
                        </div>
                    </div> 
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-2">  
                            <button class="btn btn-primary file-pond-submit" id="submit" name="submit" type="submit">Add</button>
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
    $('#candidate_form').on('submit', (e) => {
        $('#candidate_form').removeClass('needs-validation');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        e.preventDefault();
        let formData = new FormData($('#candidate_form')[0]);
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' +'/candidate',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("#submit").html('<i class="fas fa-spinner fa-pulse"></i>');
                $("#submit").prop('disabled', true);
            },
            success: function (response){
                location.reload();
            },
            error: function (xhr, status, error){
                $("#submit").html('Add');
                $("#submit").prop('disabled', false);
                $('#candidate_form').addClass('needs-validation');
                let errors = $.parseJSON(xhr.responseText);
                for (const [key, value] of Object.entries(errors.errors)) {
                    $(`#${key}`).addClass('is-invalid');
                    $(`#${key}`).focus();
                    $(`#${key}_invalid`).html(value);
                }
            }
        });
    });

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
                $('.my-pond-ajax').filepond({
                    credits: false,
                    'allowMultiple': false
                });

                // Generic file-pond multiple
                $('.my-pond-multiple-ajax').filepond({
                    credits: false,
                    'allowMultiple': true
                });

                $('.select2-ajax').select2({
                    placeholder: 'Select Countries'
                });

                $('.datepicker').datepicker({
                    format: 'yyyy/mm/dd',
                    todayHighlight:'TRUE',
                    autoclose: true,
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
    
    document.addEventListener('FilePond:processfilestart', (e) => {
        $(".file-pond-submit").html('<i class="fas fa-spinner fa-pulse"></i>');
        $(".file-pond-submit").prop('disabled', true);        
    });
    document.addEventListener('FilePond:processfile', (e) => {
        $(".file-pond-submit").html('Add');
        $(".file-pond-submit").prop('disabled', false);
    });

    $(function(){
        FilePond.setOptions({
            server: {
                url: "{{ url('/') }}",
                process: '/upload/candidate-photo',
                revert: '/revert',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });
    });
</script>
@endsection