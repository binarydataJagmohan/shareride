@extends('rides.layouts.app')
@section('title','Dashboard')
@section('content')
 <section class="dash-details">
        <div class="container">
                    <div class="page-details">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="mb-5">Payments</h1>
                            </div>
                            <div class="col-sm-6 text-lg-end">
                                <p style="text-decoration:underline ;color: #777777;"> <a href="{{url('payment-setting')}}"><b>Payment settings </b></a> | <a href="#"><b>Payments help</b></a> </p>
                            </div>
                        </div>
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
                        </div>
                        <p class="mt-5">No payments for this period.</p>
                    </div>
                </div>
    </section>

@endsection
