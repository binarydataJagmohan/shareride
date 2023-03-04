@extends('layouts.app')
@section('title','Reset Password')
@section('content')
  <section>
    <div class="container py-sm-5">
      <div class="row">
        <div class="col-md-6">
          <div class="form-container-class" id="reset-password">
            <h3 class="text-start">Password Reset</h3>
            <form class="form-horizontal" method="POST" action="{{ route('ResetPasswordPost') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
              <div class="email">
                <label for="" class="mt-3 mb-3">Email</label>
                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="">
                <label for="password" class="mt-3 mb-3">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Your Password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
               <div class="">
                <label for="password-confirm" class="mt-3 mb-3">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="New Password (again)" required autocomplete="new-password">
              </div>
              <button type="submit" class="btn signin bgcolor mt-5">Change Password</button>  
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection