@extends('rides.layouts.app')
@section('title','Payouts')
@section('content')
 <section class="dash-details">
        <div class="container">
            <div class="page-details">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-5">Payouts</h1>
                    </div>
                    <div class="col-sm-6 text-lg-end">
                        <p style="text-decoration:underline ;color: #777777;"> <a href="#"><b>Payouts settings </b></a>
                            | <a href="#"><b>Payouts help</b></a> </p>
                    </div>
                </div>

                <div class="tabs-class">
                    <ul class="nav" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Pending</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">Paid</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="top mt-4"><strong>Important:</strong> You haven't set up a payout method yet. <a
                                    href="#" style="text-decoration:underline ;color: #777777;">Add one now</a> </div>
                            <br>
                            <strong class="mt-3">You have no pending payouts</strong><br><br>
                            <a href="" style="text-decoration:underline ;color: #777777; margin-top:10px;">View your
                                payouts that have been paid</a>
                        </div>


                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="top mt-4"><strong>Important:</strong> You haven't set up a payout method yet. <a
                                    href="#" style="text-decoration:underline ;color: #777777;">Add one now</a> </div>
                            <br>
                            <div class="row" id="payment">
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>2023</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>From: January</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>To: January</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 text-lg-end">
                                    <strong>Total paid for period: $CAD 0.00
                                    </strong>
                                </div>
                            </div>
                            <p class="mt-5">It seems there are no payouts for this period.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection