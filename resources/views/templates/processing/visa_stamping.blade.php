@extends('layouts.app')
@section('title')
Visa Stamping Information
@endsection

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-wallet icon-gradient bg-plum-plate">
                </i>
            </div>
            <div>{{ $candidate_name }}
                <div class="page-title-subheading">Visa Stamping. </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row justify-content-between">
            <div class="card mb-3 widget-content col-lg-5">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">Stamping Date</div>
                    </div>
                    <div class="widget-content-right">
                        <form action="{{ route('visa_stamping_update') }}" method="post">
                            @csrf
                            <div class="row justify-content-between">
                                <input type="hidden" name="update_visa_stamping_id" value="{{ $processing_id }}">
                                <div class="col-md-5"><input name="stamping_date" type="text" class="form-control datepicker" value="{{ $visa_stamping_date }}"></div>
                                <div class="col-md-3"><button class="btn btn-info btn-xs">Update</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="card mb-3 col-lg-5 p-2">
                <form action="{{ route('visa_stamping_update') }}" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="update_visa_stamping_id" value="{{ $processing_id }}">                                    
                        <div class="col-md-8"><input type="file" class="my-pond-multiple" name="visa_stamping_file[]" id="visa_stamping_file"></div>
                        <div class="col-md-3"><button class="btn btn-info btn-xs">Update</button></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @foreach ($images as $image)
                    <div class="border row p-2 m-2">
                        <div class="col-md-8">
                            <a href="{{ asset($image->link) }}"><img src="{{ asset($image->link) }}" alt="" width="250px"></a>
                        </div>
                        <div class="col-md-4">
                            <button onclick="remove_file({{ $image->id }})" class="btn btn-xs btn-info danger"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    

$(function(){
    FilePond.setOptions({
        server: {
            url: "{{ url('/') }}",
            process: '/upload/processing-photo',
            revert: '/revert',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
    });
});
let remove_file = (id) => {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: '{{ url('/') }}' + '/processing/visa_stamping_update',
                data: {id, _method: 'DELETE'},
                beforeSend:function(){
                    $("#update_visa_stamping_button").html('<i class="fas fa-spinner fa-pulse"></i>');
                    $("#update_visa_stamping_button").prop('disabled', true);
                },
                success: function (response){
                    swal("Poof! Your file has been deleted!", {
                        icon: "success",
                    });
                    location.reload();
                },
            });            
        }
    });
}

</script>
    
@endsection