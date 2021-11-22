@extends('layouts.app')
<link rel="stylesheet" href="{{url('public/widgEditor/css/widgEditor.css')}}" />

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
    <center style="font-size: 18pt;font-weight:900;color:#38bfe0;">{{$package_name}} Section</center>
    <hr>
    <div class="col-md-12" style="border: 5px solid #96d6d0;padding:20px;">
        <div class="row">
            @foreach ($package_image_headline as $item)
            <div class="col-md-4" style="padding: 20px;margin-top:20px;width:450px;margin-right:auto;margin-left:auto;border-right:3px solid rgb(71, 187, 181);">
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
                            <input type="text" name="package_update_heading" id="package_update_heading" value="{{$item->headline}}" style="width:400px;" required>
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

                <!-- Package add/delete confirmation Modal start -->
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
            <div class="col-md-8">
                <center style="font-size: 16pt;font-weight:900;color:red;">{{$package_name}} Packages</center>
                <hr>
                <center>
                    <button class="btn btn-info" style="font-weight: bold;font-size:11pt;" type="button" data-toggle="modal" data-target="#addNewPackage">
                        Add New {{$package_name}} Package
                    </button>
                </center>
                
                <div style="height: 80vh;overflow-y:scroll;overflow-x:hidden;">
                @foreach ($all_packages as $package)    
                <div class="row" style="border:2px solid rgb(122, 219, 93);;margin-top:10px;margin-bottom:10px;">
                    <div class="col-md-12">
                        <center style="font-size:16pt;color:green;font-weight:900;">
                            {{$package->package_headline}}
                        </center>
                    </div>
                    <div class="col-md-12">
                        <form action="{{url('sectionPackageUpdate',$package->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Package Name : </label>
                                <input class="form-control" name="sectionPackageName" id="sectionPackageName" type="text" value="{{$package->package_headline}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Package Image : </label>
                                <img src="{{url('public/'.$package->package_image)}}" alt="" style="width:300px;margin-bottom:20px;margin-left:auto;margin-right:auto;">
                                <input class="form-control" name="sectionPackageImage_{{$package->id}}" id="sectionPackageImage" type="file">
                            </div>
                            <div class="form-group">
                                <label for="">Package Detail : </label>
                                <textarea class="form-control editor2" name="sectionPackageDetail" id="gh" style="min-height:100px;" required><?php  echo htmlspecialchars_decode($package->package_detail); ?></textarea>
                            </div>
                            <div class="form-class">
                                <button type="submit" class="btn btn-success" style="float: left">Update</button>
                                <a href="{{url('sectionPackageDelete',$package->id)}}">
                                    <button type="button"  class="btn btn-danger" style="float: right;">Delete</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
        {{--tourist section end--}}
    </div>
</div>
@endsection

@section('modals')

<!-- Add new package Modal start -->
<div class="modal fade" id="addNewPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" style="min-width: 600px;margin-right;auto;margin-left:auto;">
        <div class="modal-content" >
                <center style="color:red;font-weight:95;font-size:15pt;padding-top:15px;">
                    Add new {{$package_name}} Package
                </center>
            <div class="modal-body" >
                <form id="newPackageCreateFoorm" action="{{url('new_package_create',$id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Package Name : </label>
                        <input class="form-control" name="packageName" id="packageName" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="">Package Image : </label>
                        <input class="form-control" name="packageImage" id="packageImage" type="file" required>
                    </div>
                    <div class="form-group">
                        <label for="">Package Detail : </label>
                        <textarea class="form-control" name="application" id="editor1" style="min-height:100px;" required></textarea>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" style="float: left">Create</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right;">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Add new package Modal end -->
    
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

function createPackageFormSubmitFunction(){
    var packageName = document.getElementById('packageName').value;
    var packageImage = document.getElementById('packageImage').value;
    var packageDetail = CKEDITOR.instances.editor1.getData();

    if(packageName.length < 1){
        alert('Package Name cant be empty');
        return false;
    }if(packageImage.length < 1){
        alert('Package Image cant be empty');
        return false;
    }if(packageDetail < 1 ){
        alert('Package detail cant be empty');
        return false;
    }else{
        document.getElementById("newPackageCreateFoorm").submit();
    }
}

function sectionPackageUpdateFormSubmitFunction(){
    document.getElementById("sectionPackageUpdateForm").submit();
}



</script>
<script src="{{url('public/ckkeditor/ckeditor.js')}}"></script>
<script>
	CKEDITOR.replace('editor1', { });
</script>
<script>
	CKEDITOR.replaceAll('editor2', { });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
@endsection