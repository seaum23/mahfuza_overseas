@extends('layouts.app')
@section('title')
Website
@endsection

@section('content')
@if(session()->has('success'))
<div class="alert alert-success">
    <p style="text-align: center;font-size:17pt;font-weight:800;">{{ session()->get('success') }}</p>
</div>
@endif
@if(session()->has('warning'))
<div class="alert alert-warning">
    <p style="text-align: center;font-size:17pt;font-weight:800;">{{ session()->get('warning') }}</p>
</div>
@endif

{{--tourist package start--}}
<div class="row">
<div class="col-md-12" style="border: 10px solid #96d6d0;padding:20px;">
    <center style="font-size: 18pt;font-weight:900;color:#38bfe0;">Tourist Package</center>
    <hr>

    @foreach ($package_image_headline as $item)
    <div style="padding: 20px;border:10px solid #96d6d0;margin-top:20px;width:450px;margin-right:auto;margin-left:auto;">
        <p style="padding-right: 10px;font-size:12pt;font-weight:800;">{{$item->section}} Image : </p>
        <img src="{{url('public/'.$item->image)}}" alt="" style="width:300px;margin-bottom:20px;margin-left:auto;margin-right:auto;">
        <form action="{{url('PackageUpdate',$item->id)}}" method="POST" enctype="multipart/form-data" id="PackageUpdate_form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="file" name="package_update_image" id="package_update_image" >
                </div>
            </div>
            <p style="padding-right: 10px;font-size:12pt;font-weight:800;">{{$item->section}} Headline : </p>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" name="package_update_heading" id="package_update_heading" value="{{$item->text}}" style="width:400px;" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <button class="btn btn-primary" type="submit" onclick="PackageUpdateFormSubmit()">update</button>
                </div>
                <div class="form-group col-md-6">
                        <button style="float: right;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">delete</button>
                </div>
            </div>
        </form>

        <!-- Package adelete confirmation Modal start -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;color:red;font-weight:900;">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        Do you really want to delete <span style="color:green;font-weight:900;">{{$item->section}}</span> Package Section? It will also delete all of its packages.
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="{{url('package_section_and_all_its_packages_delete',$item->id)}}">
                        <button type="button" class="btn btn-danger">Sure Delete</button>
                    </a>
                    </div>
                </div>
                </div>
            </div>
        <!-- Package adelete confirmation Modal end -->

    @endforeach
</div>
{{--tourist package end--}}
</div>
</div>
@endsection

@section('script')
<script>

function PackageUpdateFormSubmit(){
    var package_update_heading = document.getElementById('package_update_heading').value;

 if(package_update_heading.length < 1 ){
        alert('Headline cant be empty.');
        return false;
    }else{
        document.getElementById("PackageUpdate_form").submit();
}
}

</script>
@endsection