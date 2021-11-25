@extends('layouts.app')
@section('title')
Experienced Candidates
@endsection

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-wallet icon-gradient bg-plum-plate">
                </i>
            </div>
            <div>{{ $experience_info->fName . ' ' . $experience_info->lName }}
                <div class="page-title-subheading">Experience status. </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="card mb-3 widget-content col-lg-3">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">Departure Date</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-success"><span>{{ $experience_info->departure_date }}</span></div>
                    </div>
                </div>
            </div>
            <div class="card ml-5 mb-3 widget-content col-lg-3">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">Arrival Date</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-success"><span>{{ $experience_info->arrival_date }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row" >
                    <div class="col-lg-12"><h5>Departure Seal File</h5></div>
                    <div class="col-lg-8" style="position: relative;">
                        <span class="image">
                            <img src="{{ asset($experience_info->departureSealFile) }}" alt="" width="50vh">
                        </span>
                    </div>
                    <div class="col-lg-4" style="position: relative;">
                        <form action="{{ route('departure-update-file', ['candidate' => $experience_info->id]) }}" method="post" >
                            @csrf
                            <input type="file" class="my-pond" name="departureSealFile" id="departureSealFile">
                            <input type="text" class="form-control datepicker mb-3" autocomplete="off" name="departure_date_update" id="departure_date_update" placeholder="Updated Departure Date"/>
                            <button class="btn btn-sm btn-info">Update</button>
                        </form>
                    </div>
                    <div class="col-lg-12 mt-5"><h5>Arrival Seal File</h5></div>
                    <div class="col-lg-8" style="position: relative;">
                        <span class="image">
                            <img src="{{ asset($experience_info->arrivalSealFile) }}" alt="" width="50vh">
                        </span>
                    </div>
                    <div class="col-lg-4" style="position: relative;">
                        <form action="{{ route('arrival-update-file', ['candidate' => $experience_info->id]) }}" method="post" >
                            @csrf
                            <input type="file" class="my-pond" name="arrivalSealFile" id="arrivalSealFile">
                            <input type="text" class="form-control datepicker mb-3" autocomplete="off" name="arrival_date_update" id="arrival_date_update" placeholder="Updated Arrival Date"/>
                            <button class="btn btn-sm btn-info">Update</button>
                        </form>
                    </div>
                </div>
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