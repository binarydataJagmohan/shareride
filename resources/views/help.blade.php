
@extends('rides.layouts.app')
@section('title','Account')
@section('content')

<section class="dash-details">
    
  <div class="container">
            <div class="page-details">
                <div class="row justify-content-center">
                   <div class="col-sm-7">
                  <div class="row">
                    <div class="col-sm-12 mb-5">
                        <h1 class="mb-5">Help</h1>
                        <h5>Get quick answers here</h5>
                    </div>
                    <div class="help-search mb-3 mt-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="How can we help?" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                          </div>
                    </div>
                    <div class="ss">
                        <ul class="offcanvas-menu-link">
                            <h6>My trip</h6>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)" class="b-line">I can’t reach my driver or passenger</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)" class="b-line">My driver didn't show up</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)" class="b-line">My passenger didn't show up</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">Report abuse or scam</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)" class="b-line">I have safety concerns</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <h6>Passenger payments</h6>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">I have not received my refund</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)" class="b-line">Can I pay without a credit card?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)" class="b-line">Can I pay cash?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <h6>Driver payouts</h6>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">I haven't received a payout yet</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">Payouts to my bank account are not working</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <h6>Cancellations</h6>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">I'm a passenger and need to cancel a booking</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">The driver cancelled and I'd like a refund</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">I'm a driver and need to cancel a trip</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <h6>Bookings</h6>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">What is Instant book?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">Can I book for someone else?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <h6>Reviews</h6>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">Why can't I leave a review after a trip?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">How can I remove a review from my profile?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <h6>Accounts</h6>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">How do I change my phone number?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">Why is my phone is linked to a new account?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">How do I verify my ID?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <h6>Other</h6>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">Can I call Poparide?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">How do I report a bug?</a><i class="fa-solid fa-arrow-right"></i></li>
                            <hr class="hr-line">
                            <li class="d-flex"><a href="javascript:void(0)">It's something else</a><i class="fa-solid fa-arrow-right"></i></li>
                            <h5 class="mt-5 mb-3"><b>Can't find what you're looking for?</b></h5>
                            <p class="mt-3">Search our comprehensive help centre for answers.</p>
                            <div class="help-search mb-3 mt-5">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="How can we help?" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                                  </div>
                            </div>
                        </ul>
                    </div>
                  </div>
                   </div>
                </div>
            </div>
        </div>
  
</section>

@endsection