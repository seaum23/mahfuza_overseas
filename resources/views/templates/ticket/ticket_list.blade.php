@extends('layouts.app')
@section('title')
Ticket List
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card mt-3 card">
            <div class="card-body"><h5 class="card-title">All Candidates</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable w-100" id="datatable">
                        <thead>
                            <tr>
                                <th>Candidate Name</th>
                                <th>Airplane</th>
                                <th>Flight No</th>
                                <th>Flight Date</th>
                                <th style="width: 70px !important;">Transit</th>
                                <th style="width: 70px !important;">From</th>
                                <th>To</th>
                                <th>Amount</th>
                                <th>Comment</th>
                                <th>Ticket Copy</th>
                                <th>Alter</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
@endsection

@section('script')
<script>
$(function() {
    datatable = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('/') }}' + '/ticket/list',
        columns: [
            { data: 'processing.candidate.fName' },
            { data: 'airline' },
            { data: 'flight_number' },
            { data: 'flight_time' },
            { data: 'transit' },
            { data: 'flight_from' },
            { data: 'flight_to' },
            { data: 'ticket_price' },
            { data: 'comment' },
            { data: 'ticket_file' },
            { data: 'action' },
            // { data: 'final_medical_status' },
            // { data: 'police_clearance_file' },
            // { data: 'training_card_file' },            
            // { data: 'action' },            
        ],
    });
});
</script>
@endsection
