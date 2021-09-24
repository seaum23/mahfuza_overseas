@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Sponsors</h5>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover" id="jobs_datatable">
                        <thead>
                            <tr>
                                <th>Job Name</th>
                                <th>Job Credit Type</th>
                                <th>Creation Date</th> 
                                <th>Edit</th>
                            </tr>
                        </thead>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection