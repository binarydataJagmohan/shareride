@extends('layouts.app')
@section('title','Login')
@section('content')
<style>
    .form-control:focus {
        border-color:unset;
    }.main-menu a.main-logo {
    width: 200px;
    margin-left: 65px;
}
.alert.alert-danger {
    text-align: center;
}
#login-form .form-group{
    display: block;
}
</style>
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
@endif
    <div class="container py-5">
        <div class="form-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-container">
                            <h3 class="text-center">Sign in to Shareride</h3>
                            <form class="form-horizontal" method="POST"
                                        action="{{ route('login') }}" id="login-form">
                                        @csrf
                                <h6>Sign in to your account with:</h6>
                                <div class="userid text-center" id="facebook_a">
                                    <a href="{{ url('auth/facebook') }}" class="form-control position-relative mb-3">
                                        <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-social-facebook.76512ffeaf2e.png" alt="">
                                        facebook
                                    </a>
                                    <a href="{{ url('authorized/google') }}" class="form-control position-relative mb-3">
                                        <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-social-google.1446d6483197.png" alt="">
                                        Google
                                    </a>

                                </div>
                                <h6>Or if you signed up without social login:</h6>
                                <div class="form-group mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button class="login1" type="submit">{{ __('Login') }}</button>
                                <span class="forgot-pass">
                                    @if (Route::has('password.request'))
                                    <a href="{{ url('forget-password') }}">
                                    Forgot your password?
                                    </a>
                                    @endif
                                   
                                </span>
                                <hr>
                                <div class="rister">
                                    <p>Not feeling social? <a href="{{url('/register')}}">Sign up with your email</a> </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection