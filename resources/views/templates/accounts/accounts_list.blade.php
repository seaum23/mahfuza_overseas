@extends('layouts.app')
@section('title')
Accounts List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-1">
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Asset</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Liability</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                    <span>Revenue</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-3">
                    <span>Expense</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-4">
                    <span>Equity</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">            
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="main-card mt-3 card">
                            <div class="card-body">
                                <div class="table-responsive w-100">
                                    <table class="mb-0 table table-hover" id="assets_datatable">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Account Name</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-6"> 
                        <div class="main-card mt-3 card">
                            <div class="card-body">
                                <div class="table-responsive w-100">
                                    <table class="mb-0 table table-hover" id="agent_list_datatable">
                                        <thead>
                                            <tr>
                                                <th>Account Name</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>                
                            </div>
                        </div>             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
@endsection

@section('script')
@endsection
