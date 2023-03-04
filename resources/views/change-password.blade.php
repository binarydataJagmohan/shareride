@extends('layouts.app')
@section('title','change Password')
@section('content')

  <section>
    <div class="container py-sm-5">
      <div class="row">
          @include('layouts.sidebar')
        <div class="col-md-6">
          <div class="form-container-class" id="reset-password">
            <h3 class="text-start">Password Reset</h3>
            <form class="form-horizontal" method="POST" action="{{ url('/password/change') }}">
                @csrf
               <div class="">
                <label for="password" class="mt-3 mb-3">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="current Password" required autocomplete="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="">
                <label for="password" class="mt-3 mb-3">Password</label>
                <input id="new-password" type="password" class="form-control @error('password') is-invalid @enderror" name="new_password" placeholder="New Password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
               <div class="">
                <label for="password-confirm" class="mt-3 mb-3">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password (again)" required autocomplete="new-password">
              </div>
              <button type="submit" class="btn signin bgcolor mt-5">Change Password</button>  
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection