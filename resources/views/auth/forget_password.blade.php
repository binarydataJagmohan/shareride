@extends('layouts.app')
@section('title','Forget Password')
@section('content')
<style>
    #forget-password input.form-control {
    border: none;
}
</style>
        @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
        </div>
        @endif
<section>
    <div class="container py-sm-5">
        <div class="row">
            <div class="col-md-6">
                <div class="form-container-class" id="reset-password">
                    <h3 class="text-start">Password Reset</h3>
                    
                    <form class="form-horizontal" method="POST" action="{{ route('ForgetPasswordPost') }}" id="forget-password">
                        @csrf
                        <h6>We'll Send Instructions To Your Email For Resetting Your Password</h6>
                        <div class="form-group mb-2">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Your Email Address" name="email" value="{{old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn signin">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
