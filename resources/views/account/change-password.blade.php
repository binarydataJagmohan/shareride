@extends('layouts.app')
@section('title','change Password')
@section('content')


<section>
    <div class="container py-sm-5">
        @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif

        @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-container-class" id="reset-password">
                    <h3 class="text-start">Change Password</h3>
                    <form class="form-horizontal" method="POST" action="{{ url('/password/change') }}" id="change-pass">
                        @csrf
                        <div class="">
                            <label for="password" class="mt-3 mb-3">Current Password</label>
                            <input id="current_password" type="password" class="form-control" name="current_password" placeholder="current Password" required>

                        </div>
                        <div class="">
                            <label for="password" class="mt-3 mb-3">New Password</label>
                            <input id="new_password" type="password" class="form-control" name="new_password" placeholder="New Password" required>
                        </div>
                        <div class="">
                            <label for="password-confirm" class="mt-3 mb-3">Confirm Password</label>
                            <input id="password_confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password (again)" required>
                        </div>
                        <button type="submit" class="btn signin bgcolor mt-5">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection