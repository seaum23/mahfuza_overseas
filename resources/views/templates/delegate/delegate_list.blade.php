@extends('layouts.app')
@section('title')
Delegate List
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">New Delegate</h5>
                @foreach ($delegates as $delegate)
                    <p>{{ $delegate->name; }}</p>
                @endforeach
                
                {{ $delegates->links() }}
            </div>
        </div>
    </div>
</div>
@endsection