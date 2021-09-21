@extends('layouts.app')

@section('login')
<div class="wrapper login-wrapper row justify-content-center">
    <div class="company-logo" style="width: 100%;">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('images/company-logo.png') }}" alt="" width="200px">
            </div>
        </div>
    </div>
    <div class="col-md-2 col-9 align-self-center login-container">
        <div class="card">
            <div class="card-body p-5">
                @if (session('status'))
                    <p class="text-danger font-weight-500">{{ session('status') }}</p>
                @endif
                <form action="{{ route('login') }}" method="post" class="form login-form">
                    @csrf
                    <?php if(isset($_SESSION['failed_login'])){ ?><p class="text-danger">Incorrect Credentials</p> <?php } ?>
                    <div class="form-group" >
                        <input type="text" class="form-control" id="employee_id" aria-describedby="employee_id" placeholder="Email / Employee ID" name="employee_id">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" aria-describedby="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group form-check">
                        <label for="remember" class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            Remember Me!
                        </label>
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