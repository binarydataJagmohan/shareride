@extends('rides.layouts.app')
@section('title','Notification')
@section('content')

<section class="dash-details">
        <div class="container">
            <div class="row">
                @include('layouts.sidebar')
                <div class="col-sm-9">
                    <div class="page-details">
                        <h1>ID verification</h1><br><br>
                        <div class="row">
                            <div class="col-sm-1 col-2">
                                <img src="images/icon-verified.804ca7ec886b.png" alt="">
                            </div>
                            <div class="col-sm-6 col-10">
                                <p>Receive a verification badge on your profile to build trust with other members and
                                    get more bookings.</p>
                            </div>
                            <strong class="mt-5">1. Enter your name as it appears on your ID</strong>
                            <div class="row align-items-center pt-4" id="id-varify">
                                <div class="col-md-4 position-relative location">
                                    <input type="text" class="form-control" data-bs-target="#exampleModal4"
                                        placeholder="Enter your first name from your ID">
                                </div>
                                <div class="col-md-4 position-relative location">
                                    <input type="text" class="form-control" data-bs-target="#exampleModal4"
                                        placeholder="Enter your last name from your ID">
                                </div>
                            </div>
                            <strong class="mt-5">2. Upload a photo ID</strong>
                            <p class="mt-3">Please upload a high-quality, legible scan of a photo of your passport,
                                driver's license or national ID card.</p>
                            <div class="mt-4">
                                <img src="images/id_accepted.e4f88551bd66.png" alt="">
                                <div class="row mt-4" id="id-img">
                                    <div class="col-sm-7">
                                        <div class="vehicle-picture" id="file-box" style="cursor: pointer;">
                                            <div class="vehicle-picture-add">
                                                <input type="file" id="file-input" style="display: none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p>The file will be destroyed after our team has verified it</p>
                                       </div>
                                        <div class="mt-5">
                                            <a href="" class="button darkgrey" id="trip-post-button">Submit
                                                verification</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection