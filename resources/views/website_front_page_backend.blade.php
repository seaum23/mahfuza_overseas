@extends('layouts.app')
@section('title')
Website
@endsection

@section('content')
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
@if(session()->has('warning'))
<div class="alert alert-warning">
    {{ session()->get('warning') }}
</div>
@endif
<div class="row">
           
    <div class="col-md-4" style="border:5px solid #6ac4f7;padding:10px;">
        {{-- update logo div --}}
        <div class="row" style="padding: 20px;border:5px solid #66deda;margin:20px;">
            <h5>Logo : 
            </h5>
            <p style="width: 200px;margin-right:auto;margin-left:auto;">
                <img src="{{url('public/'.$logo->image)}}" alt="" style="width:150px;margin-left:auto;margin-right:auto">
            </p>
            <hr>
            <form action="{{url('logo_update',$logo->id)}}" method="POST" enctype="multipart/form-data" id="LogoForm">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="file" name="logo_name" id="logo_id" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary" type="submit" onclick="logoFormSubmit()">update</button>
                    </div>
                </div>
            </form>
        </div>
         {{-- update logo div end --}}
        

         {{-- update brand name div --}}
        <div class="row" style="padding: 20px;border:5px solid #66deda;margin:20px;">
            <h5>Brand Name : 
            </h5>
            <p style="width: 200px;margin-right:auto;margin-left:auto;">
                <img src="{{url('public/'.$brand_name->image)}}" alt="" style="width:450px;margin-left:auto;margin-right:auto">
            </p>
            <hr>
            <form action="{{url('brand_name_update',$brand_name->id)}}" method="POST" enctype="multipart/form-data" id="brandNameForm">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="file" name="brand_name" id="brand_name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary" type="submit" onclick="BrandNameSubmit()">update</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- update brand name div end--}}

        {{-- packages --}}
        <div class="row" style="padding: 20px;border:5px solid #66deda;margin:20px;">
            <div class="col-md-12" style="margin-block: 10px;">
                <p style="width: 200px;margin-left:auto;margin-right:auto;font-size:15pt;">
                    <button class="btn btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_new_section_modal" >Create new package section</button>
                </p>
            </div>
            <div class="col-md-12">
                <h6>Package Sections : </h6>
                <h6>
                    <ul style="height: 10vh;overflow-y:scroll;">
                        @foreach($packages as $package)
                        <li>
                            {{$package->section}}
                        </li>
                        @endforeach
                    </ul>
                </h6>
            </div>
        </div>
        {{-- packages --}}

    </div>

{{-- front backend image start--}}
    <div class="col-md-8" style="border: 5px solid #6ac4f7;padding:20px;">
        <h5 style="padding-top: 15px;">Front Background Image:</h5>
        <img src="{{url('public/'.$front_background_image->image)}}" alt="" style="width:100%;margin-left:auto;margin-right:auto">
        <hr>
        <form action="{{url('front_background_image_update',$front_background_image->id)}}" method="POST" enctype="multipart/form-data" id="front_background_image_update">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="file" name="frontBackendImage" id="frontBackendImage" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <button class="btn btn-primary" type="submit" onclick="FrontBackgroundImage()">update</button>
                </div>
            </div>
        </form>
    </div>
{{-- front backend image end--}}


<!-- Add new section Modal start -->
<div class="modal fade" id="add_new_section_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create new Package Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('create_package_section')}}" method="POST" enctype="multipart/form-data" id="add_package_section_form">
                @csrf
                <div class="form-row">
                    <label for="">Package Section Name : </label>
                    <div class="form-group col-md-6">
                        <input type="text" name="package_section" id="package_section" required>
                    </div>
                </div>
                <div class="form-row">
                    <label for="">Package Section Image : </label>
                    <div class="form-group col-md-6">
                        <input type="file" name="package_section_image" id="package_section_image" required>
                    </div>
                </div>
                <div class="form-row">
                    <label for="">Package Section Headline : </label>
                    <div class="form-group col-md-6">
                        <input type="text" name="package_section_headline" id="package_section_headline" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary" type="submit" onclick="AddPackageSection()">Create</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style="float: right;">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
<!-- Add new section Modal end -->


</div>


@endsection

@section('script')
<script>
    function logoFormSubmit(){
        var logo = document.getElementById('logo_id').value;
        if(logo.length < 1){
            alert('Image field cant be empty.');
            return false;
        }else {
            document.getElementById("LogoForm").submit();
            return false;
        }
    }

    function BrandNameSubmit(){
        var brand_name = document.getElementById('brand_name').value;
        if(brand_name.length < 1){
            alert('Image field cant be empty.');
            return false;
        }else {
            document.getElementById("brandNameForm").submit();
            return false;
        }
    }

    function FrontBackgroundImage(){
        var frontBackendImage = document.getElementById('frontBackendImage').value;

        if(frontBackendImage.length < 1){
            alert('Image field cant be empty.');
            return false;
        }else {
            document.getElementById("front_background_image_update").submit();
        }
    }

    function AddPackageSection(){
        var package_section = document.getElementById('package_section').value;
        var package_section_image = document.getElementById('package_section_image').value;
        var package_section_headline = document.getElementById('package_section_headline').value;
        if(package_section.length < 1){
            alert('Section name cant be empty!');
            return false;
        }else if(package_section_image.length < 1 ){
            alert('Section Image cant be empty!');
            return false;
        }else if(package_section_headline.length < 1 ){
            alert('Section Heading cant be empty!');
            return false;
        }else {
            document.getElementById("add_package_section_form").submit();
        }
    }

</script>
@endsection