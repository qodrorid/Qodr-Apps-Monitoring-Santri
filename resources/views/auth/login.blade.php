@extends('templates.auth')

@section('content')
<form class="md-float-material form-material" autocomplete="off" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="text-center">
        <img src="{{ asset('img/master/logo.png') }}" alt="logo.png">
    </div>
    <div class="auth-box card">
        <div class="card-block">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h5 class="text-center">Sign In</h5>
                </div>
            </div>
            <div class="form-group form-primary">
                <input type="text" name="username" class="form-control @error('username') form-control-danger @enderror" value="{{ old('username') }}" required placeholder="Username" autofocus>
                @error('username')
                <span class="form-bar text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group form-primary">
                <input type="password" name="password" class="form-control @error('password') form-control-danger @enderror" required placeholder="Password">
                @error('password')
                <span class="form-bar text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row m-t-25 text-left">
                <div class="col-12">
                    <div class="checkbox-fade fade-in-primary d-">
                        <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            <span class="text-inverse">Remember me</span>
                        </label>
                    </div>
                    <div class="forgot-phone text-right f-right">
                        <a href="{{ route('password.request') }}" class="text-right f-w-600"> Forgot Password?</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-10">
                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                    <p class="text-inverse text-left"><a href="https://colorlib.com/"><b class="f-w-600">colorlib.com</b></a></p>
                </div>
                <div class="col-md-2">
                    <img src="{{ asset('img/master/logo-adminty-auth.png') }}" alt="small-logo.png">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
