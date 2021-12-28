@extends('layouts.app')
@section('title')
New Candidate
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
                                    <select name="gender" class="form-control show-tick ms select2" data-placeholder="Select Gender">
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
                                    <label>Interested Country <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <select class="form-control select2" name="country" id="country" >
                                        <x-select-countries/>
                                    </select>
                                    <div id="country_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="col-md-12"><hr></div>

                                <div class="form-group col-md-6">
                                    <input type="hidden" value="no" id="includeCandidateFromAgent" name="includeCandidateFromAgent">                   
                                    <label>NID / Birth Certificate <span id="text-show" style="color: #ff3d00; display: none;" date-toggle="modal" data-target="#show">Candidate Exists In Agent Expense List <button type="button" data-target="#show" data-toggle="modal" class="btn btn-sm btn-info mr-1" style="padding: .16rem .3rem;"><i class="fas fa-eye"></i></button><button value="no" name="includeCandidate" id="includeCandidate" type="button" class="btn btn-sm btn-danger" style="padding: .16rem .3rem;" onclick="include_Candidate(this.value)"><i class="fa fa-ban"></i></button></span> </label>
                                    <input class="form-control" type="text" name="nid" id="nid" placeholder="Enter NID" onchange="getInfo()">
                                </div>


                                <div class="form-group col-md-6">
                                    <label>Fathers Name</label>
                                    <input style="width: inherit" type="text" class="form-control" name="father_name" id="father_name" autocomplete="off" placeholder="Fathers Name"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mothers Name</label>
                                    <input style="width: inherit" type="text" class="form-control" name="mother_name" id="mother_name" autocomplete="off" placeholder="Mothers Name"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Spouse Name</label>
                                    <input style="width: inherit" type="text" class="form-control" name="spouse_name" id="spouse_name" autocomplete="off" placeholder="Spouse Name"/>
                                </div>


                                <div class="form-group col-md-6">
                                    <label>Nationality</label>
                                    <input style="width: inherit" type="text" class="form-control" name="nationality" id="nationality" autocomplete="off" placeholder="Nationality"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Birth Place</label>
                                    <input style="width: inherit" type="text" class="form-control" name="birth_place" id="birth_place" autocomplete="off" placeholder="Birth Place"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Religion</label>
                                    <input style="width: inherit" type="text" class="form-control" name="religion" id="religion" autocomplete="off" placeholder="Religion"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Profession</label>
                                    <input style="width: inherit" type="text" class="form-control" name="profession" id="profession" autocomplete="off" placeholder="Profession"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nominee</label>
                                    <input style="width: inherit" type="text" class="form-control" name="nominee" id="nominee" autocomplete="off" placeholder="Nominee"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nominee Relation</label>
                                    <input style="width: inherit" type="text" class="form-control" name="nominee_relation" id="nominee_relation" autocomplete="off" placeholder="Nominee Relation"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Contact Name</label>
                                    <input style="width: inherit" type="text" class="form-control" name="contact_name" id="contact_name" autocomplete="off" placeholder="Contact Name"/>
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
                                    <label>Issue Date <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                                    <input type="text" class="form-control datepicker" autocomplete="off" name="issu_date" id="issu_date" placeholder="yyyy/mm/dd"/>
                                    <div id="issu_date_invalid" class="invalid-feedback"> </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Passport Place</label>
                                    <select class="form-control select2" name="passport_place" id="passport_place" data-placeholder="Select Zilla">
                                        <option value=""></option>
                                        <option>Chittagong-চট্টগ্রাম</option>
<option>Dhaka – ঢাকা</option>
<option>Rajshahi – রাজশাহী</option>
<option>Sylhet – সিলেট</option>
<option>Jessore – যশোর</option>
<option>Dinajpur - দিনাজপুর</option>
<option>Mymensingh - ময়মনসিংহ</option>
<option>Comilla – কুমিল্লা</option>
<option>Barisal – বরিশাল</option>
<option>Bogra – বগুড়া</option>
<option>Pabna – পাবনা
<option>Rangamati - রাঙ্গামাটি</option>
<option>Kushtia – কুষ্টিয়া</option>
<option>Rangpur – রংপুর</option>
<option>Noakhali - নোয়াখালী</option>
<option>Khulna – খুলনা</option>
<option>Tangail – টাঙ্গাইল</option>
<option>Panchagarh - পঞ্চগড়</option>
<option>Bhola - ভোলা</option>
<option>Habiganj – হবিগঞ্জ</option>
<option>Lakshmipur - লক্ষীপুর</option>
<option>Barguna – বরগুনা</option>
<option>Jhalokati – ঝালকাঠি</option>
<option>Pirojpur - পিরোজপুর</option>
<option>Patuakhali - পটুয়াখালী</option>
<option>Jhenaidah - ঝিনাইদহ</option>
<option>Narail – নড়াইল</option>
<option>Magura – মাগুরা</option>
<option>Lalmonirhat - লালমনিরহাট</option>
<option>Kurigram - কুড়িগ্রাম</option>
<option>Nilphamari - নীলফামারী</option>
<option>Gaibandha – গাইবান্ধা</option>
<option>Thakurgaon - ঠাকুরগাঁ</option>
<option>Satkhira – সাতক্ষিরা</option>
<option>Bagerhat - বাগেরহাট</option>
<option>Chuadanga - চুয়াডাঙ্গা</option>
<option>Meherpur - মেহেরপুর</option>
<option>Sirajganj - সিরাজগঞ্জ</option>
<option>Joypurhat - জয়পুরহাট</option>
<option>Natore – নাটোর</option>
<option>Naogaon – নওগাঁ</option>
<option>Nawabganj - নওয়াবগঞ্জ</option>
<option>Khagrachhari - খাগড়াছড়ি</option>
<option>Feni – ফেনী</option>
<option>Brahmanbaria - ব্রাহ্মণবাড়ীয়া</option>
<option>Sunamganj - সুনামগঞ্জ</option>
<option>Cox's Bazar - কক্সবাজার</option>
<option>Moulvibazar -মৌলভীবাজার</option>
<option>Gopalganj - গোপালগঞ্জ</option>
<option>Shariatpur - শরীয়তপুর</option>
<option>Madaripur - মাদারীপুর</option>
<option>Rajbari – রাজবাড়ী</option>
<option>Gazipur – গাজীপুর</option>
<option>Kishoreganj - কিশোরগঞ্জ</option>
<option>Jamalpur - জামালপুর</option>
<option>Sherpur – শেরপুর</option>
<option>Netrakona - নেত্রকোনা</option>
<option>Munshiganj - মুন্সীগঞ্জ</option>
<option>Narsingdi – নরসিংদী</option>
<option>Narayanganj -নারায়ণগঞ্জ</option>
<option>Manikganj - মানিকগঞ্জ</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 text-center">
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
                            <fieldset class="form-row form-group p-2" style="border: 1px solid gray; border-radius: 5px">
                                <legend>Address:</legend>
                                <div class="row w-100">
                                    <div class="form-group col-md-4">
                                        <label>Division</label>
                                        <input style="width: inherit" type="text" class="form-control" name="division" id="division" autocomplete="off" placeholder="Division"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>District</label>
                                        <input style="width: inherit" type="text" class="form-control" name="district" id="district" autocomplete="off" placeholder="District"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Upzilla</label>
                                        <input style="width: inherit" type="text" class="form-control" name="upzilla" id="upzilla" autocomplete="off" placeholder="Upzilla"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Union</label>
                                        <input style="width: inherit" type="text" class="form-control" name="union" id="union" autocomplete="off" placeholder="Union"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>House No.</label>
                                        <input style="width: inherit" type="text" class="form-control" name="house" id="house" autocomplete="off" placeholder="House No."/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Road No.</label>
                                        <input style="width: inherit" type="text" class="form-control" name="road" id="road" autocomplete="off" placeholder="Road No."/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Post Office</label>
                                        <input style="width: inherit" type="text" class="form-control" name="post_office" id="post_office" autocomplete="off" placeholder="Post Office"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Post Code</label>
                                        <input style="width: inherit" type="text" class="form-control" name="post_code" id="post_code" autocomplete="off" placeholder="Post Code"/>
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

     
    // Generic file-pond
    // $('.my-pond').filepond({
    //     credits: false,
    //     'allowMultiple': false
    // });

    // // Generic file-pond multiple
    // $('.my-pond-multiple').filepond({
    //     credits: false,
    //     'allowMultiple': true
    // }); 
    
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