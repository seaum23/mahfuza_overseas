@extends('layouts.app')
@section('title')
Sponsors List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Sponsors</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover" id="sponsor_list_datatable">
                        <thead>
                            <tr>
                                <th>Delegate Information</th>
                                <th>Sponsor Name</th>
                                <th>Sponsor NID</th>
                                <th>VISA No.</th>
                                <th>Sponsor Phone</th>
                                <th>Comment</th>
                                <th>Alter</th>
                            </tr>
                        </thead>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection