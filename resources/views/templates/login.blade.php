@extends('layouts.app')

@section('content')
<div class="wrapper login-wrapper row justify-content-center">
    <div class="company-logo" style="width: 100%;">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('img/company-logo.png') }}" alt="" width="200px">
            </div>
        </div>
    </div>
    <div class="col-md-2 col-9 align-self-center login-container">
        <div class="card">
            <div class="card-body p-5">
                <form action="{{ route('login') }}" method="post" class="form login-form">
                    <?php if(isset($_SESSION['failed_login'])){ ?><p class="text-danger">Incorrect Credentials</p> <?php } ?>
                    <div class="form-group" >
                        <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Email/Employee ID" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" aria-describedby="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <input class="form-control btn-info" type="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection