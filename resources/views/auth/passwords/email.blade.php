@extends('templates.auth')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<form class="md-float-material form-material" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="text-center">
        <img src="{{ asset('img/master/logo.png') }}" alt="logo.png">
    </div>
    <div class="auth-box card">
        <div class="card-block">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h5 class="text-left">Recover your password</h5>
                </div>
            </div>
            
            <div class="form-group form-primary">
                <input type="email" name="email" class="form-control @error('email') form-control-danger @enderror" required placeholder="Your Email Address">
                @error('email')
                <span class="form-bar text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Send Email</button>
                </div>
            </div>
            <p class="f-w-600 text-right">Back to <a href="{{ route('login') }}">Login.</a></p>
            <div class="row">
                <div class="col-md-10">
                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                    <p class="text-inverse text-left"><a href="index-1.htm"><b class="f-w-600">colorlib.com</b></a></p>
                </div>
                <div class="col-md-2">
                    <img src="{{ asset('img/master/logo-adminty-auth.png') }}" alt="small-logo.png">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
