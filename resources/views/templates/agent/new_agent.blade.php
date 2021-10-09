@extends('layouts.app')
@section('title')
Delegate
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Delegate</h5>
                <form id="agent_form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6" >
                                <label>Agent Name</label>
                                <input class="form-control" type="text" name="agentName" id="agentName" placeholder="Enter Name" >
                                <div id="agentName_invalid" class="invalid-feedback"> </div>
                            </div>
                            <div class="form-group col-md-6" >  
                                <label for="sel1">Agent Email: </label>
                                <input class="form-control" type="email" name="agentEmail" id="agentEmail" placeholder="example@abc.com" >
                                <div id="agentEmail_invalid" class="invalid-feedback"> </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sel1">Phone:</label>
                                <input class="form-control" type="text" name="agentPhone" id="agentPhone" placeholder="Phone Number" >
                                <div id="agentPhone_invalid" class="invalid-feedback"> </div>
                            </div>                
                            <div class="form-group col-md-6">
                                <label for="sel1">Any Remarks:</label>
                                <input class="form-control" type="text" name="comment" id="comment" placeholder="Comment / Note">
                            </div>                            
                            <div class="form-group col-md-6">
                                <label for="sel1">Password:</label>
                                <input class="form-control" type="text" name="password" id="password" placeholder="Password" >
                                <div id="password_invalid" class="invalid-feedback"> </div>
                            </div>
                            <div class="form-group col-md-6"></div>
                            <div class="form-group col-md-4">
                                <label for="sel1">Photo:</label>
                                <input class="my-pond form-control-file" type="file" name="agentImage" id="agentImage" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sel1">Passport Scan Copy:</label>
                                <input class="my-pond form-control-file" type="file" name="agentPassport" id="agentPassport" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sel1">Police Clearance:</label>
                                <input class="my-pond form-control-file" type="file" name="agentPolice" id="agentPolice" >
                            </div>
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

@section('script-file-pond')
<script>
    $('#agent_form').on('submit', (e) => {
        $('#agent_form').removeClass('needs-validation');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        e.preventDefault();
        let formData = new FormData($('#agent_form')[0]);
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' +'/agent',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("#add_office").html('<i class="fas fa-spinner fa-pulse"></i>');
                $("#add_office").prop('disabled', true);
            },
            success: function (response){
                $("#add_office").html('Add');
                $("#add_office").prop('disabled', false);
                let info = JSON.parse(response);
                $('#extra-job-body').append( info.html );                
                $('.select2').select2({
                    width: '100%'
                });
            },
            error: function (xhr, status, error){
                $('#agent_form').addClass('needs-validation');
                let errors = $.parseJSON(xhr.responseText);
                console.log(errors);
                for (const [key, value] of Object.entries(errors.errors)) {
                    $(`#${key}`).addClass('is-invalid');
                    $(`#${key}_invalid`).html(value);
                }
            }
        });
    });   
    
    $(function(){

        // FilePond.registerPlugin(
        //     FilePondPluginImagePreview,
        // );
        
        // FilePond.setOptions({
        //     server: {
        //         url: "{{ url('/') }}",
        //         process: '/upload/agent-photo',
        //         revert: '/revert',
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         }
        //     },
        // });
        // const inputElement = document.querySelector('input[type="file"]');
        
        // const pond = FilePond.create( inputElement );

        
        // First register any plugins
        $.fn.filepond.registerPlugin(FilePondPluginImagePreview);        
    
        // Turn input element into a pond
        $('#agentImage').filepond({
            credits: false,
            'allowMultiple': false
        });
        // Turn input element into a pond
        $('#agentPassport').filepond({
            credits: false,
            'allowMultiple': false
        });
        // Turn input element into a pond
        $('#agentPolice').filepond({
            credits: false,
            'allowMultiple': false
        });

        FilePond.setOptions({
            server: {
                url: "{{ url('/') }}",
                process: '/upload/agent-photo',
                revert: '/revert',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });
    
        // Listen for addfile event
        // $('.my-pond').on('FilePond:addfile', function(e) {
        //     console.log('file added event', e);
        // });
    
    });
</script>
@endsection