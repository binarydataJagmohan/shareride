@extends('rides.layouts.app')
@section('title','BookTrip')
@section('content')
<style>
    .vehicle {
    position: fixed;
    top: 15%;
}
</style>
 <section>
    @php
      $user = DB::table('users')->where('id',$trip->user_id)->first();
      $origin = DB::table('cities')->where('id',$trip->origin)->first();
      $destination = DB::table('cities')->where('id',$trip->destination)->first();
      $vehicle = DB::table('vehicle_models')->where('id',$trip->vehicle_id)->first();
    @endphp
    <form action="{{ url('save-booking') }}" method="post" id="booking_form">
        @csrf
        <input type="hidden" name="trip_id" value="{{ $trip->id }}">
        <input type="hidden" name="user_id" value="{{ $trip->user_id }}" id="">
        <div class="container pt-3" id="booking">
            <div class="row" id="route1">
                <div class="col-md-1 col-4">
                    @if($user)
                    <img src="{{ url('public/'.$user->img) }}" alt="" class="img-responsive img-circle1">
                     @else
                <img src="{{asset('public/upload/no.jpg')}}" alt="" class="img-responsive img-circle1">
                @endif
                </div>
                <div class="col-md-3 col-8">
                    
                    <h6>{{ $user->name ?? '' }} {{ $user->last_name ?? ''}}</h6>
                    <p class="m-0"><i class="fa-solid fa-star"></i> <strong>5.0</strong></p>
                </div>
                <div class="row">
                    <div class="col-md-8" id="desh-two1">
                        <div class="text-dash">
                            <h4>Request to book with {{ $user->name ?? ''}} {{ $user->last_name ?? ''}}</h4>
                            <h3 class="mb-3">{{ $trip->origin ?? ''}} to {{ $trip->destination ?? ''}}</h3>
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="">{{\Carbon\Carbon::parse($trip->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($trip->start_time)->format('H:i')}}</p>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="">{{ $trip->seats }} seats left</h5>
                                    <span id="pricing">${{$trip->pricing}} per seat</span>
                                </div>
                            </div>
                           

                            <h5 class="mt-3 mb-3">Trip details</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Pickup:</strong><br>
                                    <strong>Dropoff:</strong>
                                </div>
                                <div class="col-md-9">
                                    <strong>{{$trip->origin}}</strong><br>
                                    <strong>{{$trip->destination }}</strong>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                
                                @if($vehicle)
                               <img style="width:25px;margin-top:5px;" class="w-100" src="{{ url('public/'.$vehicle->img) }}" alt="">
                               @endif
                            </div>
                            <div class="col-sm-7">
                                <div class="vehicle-details">
                                    @if($vehicle)
                                    <p style="font-size: 16px;font-weight:600;"><b>{{ $vehicle->brand }} {{ $vehicle->model }} {{ $vehicle->year }} {{ $vehicle->color }}</b></p>
                                    @endif
                                    @php
                              $other = json_decode($trip->other);
                            @endphp
                            @if($trip != null) 
                            <p>
                            <img style="width:25px;margin-top:5px;" src="{{asset('public/images/icon_vehicle_luggage.62a5dcf55f8e.png')}}" alt="">
                            <span>{{$trip->luggage ." ok"}}</span>
                            </p>
                              @endif
                              @if (is_array($other) && (in_array('Winter tires',$other)))
                            <p>
                                <img style="width:25px;margin-top:5px;" src="{{asset('public/images/icon_vehicle_winter_tires.f88d4674a84d.png')}}" alt="">
                                <span>Has winter tires</span>
                                </p>
                              @endif
                             @if (is_array($other) && (in_array('Skis & snowboards',$other)))
                              <p>
                                <img style="width:25px;margin-top:5px;" src="{{asset('public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png')}}" alt="">
                                <span>Skis / snowboards ok</span>
                                </p>
                              @endif
                              @if (is_array($other) && (in_array('Bikes',$other)))
                              <p>
                                <img style="width:25px;margin-top:5px;" src="{{asset('public/images/icon_vehicle_bike.30c39bc8ff90.png')}}" alt="">
                                <span>Bikes ok</span>
                                </p>
                              @endif
                              @if (is_array($other) && (in_array('Pets',$other)))
                              <p>
                                <img style="width:25px;margin-top:5px;" src="{{asset('public/images/icon_vehicle_pets.4424314fa4c3.png')}}" alt="">
                                <span>Pets oks</span>
                                </p>
                              @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-sm-8">
                                <p><b style="font-weight: 600;">Seats required</b></p>
                            </div>
                            <div class="col-sm-3">
                                <select name="seat" class="form-select" id="seats">
                                    @for ($i = 1; $i <= $trip->seats; $i++)
                                     <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <p><b>Seat</b></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Message to {{ $user->name ?? '' }}.{{$user->last_name ?? ''}}</p>
                            </div>
                            <div class="col-md-6 text-lg-end">
                                <p>Private message </p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <textarea name="message" class="form-control"
                                placeholder="Tell {{ $user->name ?? ''}} a bit more about your trip"
                                id="floatingTextarea"></textarea>
                            <label for="floatingTextarea"></label>
                        </div>
                        <hr>
                        <div class="seat">
                            <div class="row align-items-center" id="seat-id">
                                <div class="col-md-8">
                                    <h5>How soon do you need a response?</h5>
                                    <p>Choose the time the driver has to respond to your Booking Request, beyond which
                                        it will expire automatically.</p>
                                </div>
                                <div class="col-md-4 text-end slect-change" id="select-booking">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Within 24 hours</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                         <div class="payment_mothod">
                            <h3>Payment method</h3>
                            <div class="col-md-6 text-start slect-change">
                                <label for="" class="mb-3 mt-3">Name on card</label>
                                <input class="form-control" id="cardholder_name" name="cardholder_name" placeholder="Enter card name" value="{{$user->cardholder_name ?? ''}}" size='4' required>
                            </div>
                            <div class="card-stye mt-3 mb-3">
                                <input id="card_number" type="number" size='20' name="card_number" placeholder="XXXX XXXX XXXX XXXX" style="    width: 200px;
                                background: transparent;
                                border: none;" value="{{$user->card_number ?? ''}}" required>
                                <input id="exp_month" type="text" name="exp_month" placeholder="MM/YY" style="width: 200px;background: transparent;
                                border: none;" size='2' value="{{$user->exp_month ?? ''}}" required>
                                <input id="exp_year" type="text" name="exp_year" placeholder="MM/YY" style="width: 200px;background: transparent;border: none;" size='4' value="{{$user->exp_year ?? ''}}" required>
                                <input id="cvc" name="cvc" type="number" placeholder="CVC" style="width: 130px;
                              background: transparent;
                              border: none;
                              color:#565a5c;" size='4' required>

                            </div>
                            <div class="form-check mt-4" id="cheak">
                                <input class="form-check-input" name="" type="checkbox" value="" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Securely store my card details for next time
                                </label>
                            </div>
                        </div>
                        <hr>
                        <h5>Promo code</h5>
                        <div class="card-stye mt-3 mb-3"> 
                            <input id="cc" type="text" name="promo_code" placeholder="Enter promo code (optional)"
                            style="    width: 200px;
                            background: transparent;
                            border: none;">
                          {{-- <input id="cvv" type="text" name="cvv" placeholder="Apply" style="width: 130px;
                          background: transparent;
                          border: none;
                          color: #565a5c;"> --}}
                         </div>
                         <br>
                         <hr>
                         <div class="row">
                            <div class="col-md-6">
                                <p> <strong>Policies</strong> </p>
                            </div>
                            <div class="col-md-6 text-lg-end">
                                <p> Cancellation policy <img src="images/icon-new-window.1ff942fdce75.png" alt=""> </p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                               <div class="row">
                                <div class="col-md-1">
                                   <img src="images/icon-credit-card-grey.099b4505c959.png" alt="">
                                </div>
                                <div class="col-md-11">
                                    <strong>Payment policy</strong>
                                    <p>Your card isn’t charged until the driver approves your Booking Request.</p>
                                </div>
                               </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                 <div class="col-md-1">
                                    <img src="images/icon-cancel-grey-2.7355841bd67f.png" alt="">
                                 </div>
                                 <div class="col-md-11">
                                     <strong>Cancellation policy</strong>
                                     <p>Full refund if your Booking Request isn't approved by the driver, is withdrawn or expires before being approved.</p>
                                <p>100% refund if you cancel your booking more than 24h before departure*
                                    50% refund if you cancel your booking less than 24h before departure*
                                    *Applies only if your booking is approved, and the booking fee is non-refundable.</p>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-lg-1 mt-3 positon-class-main" id="p-color-same">
                  <div class="vehicle">
                    <div class="positon-class">
                        <h5>Booking request </h5>
                        <span class="strong-color">{{ $trip->origin }} to {{ $trip->destination }}</span>
                        <p>{{\Carbon\Carbon::parse($trip->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($trip->start_time)->format('H:i')}}</p>
                        <hr>
                        <div class="row mt-3" id="text-img">
                            <div class="col-md-6 col-6">
                             <strong><p id="seat-display">1 seat</p></strong>
                            </div>
                            <div class="col-md-6 col-6">
                                <span id="price-display">${{$trip->pricing}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                               <p>Booking fee ?
                            </p>
                            </div>
                            <div class="col-md-6 col-6">
                                <span id="booking_price">$5.46</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                              <strong>Total
                            </strong>
                            </div>
                            <div class="col-md-6 col-6">
                               <strong>
                                   @php $price = $trip->pricing; $booking_price = 5.46; $total_price = $price + $booking_price;  @endphp
                                   
                                 <input type="hidden" name="price" id="total_price_input" value="{{ $total_price }}"><p id="total_price"> ${{ $total_price }} </p>
                                </strong>
                            </div>
                        </div>
                        <hr>
                        <a href="javascript:void(0)">Charles-Alexandre has 24 hours to approve your Booking Request.
                             <a href="javascript:void(0)" style="text-decoration: underline;"> More info</a></a>
                            <hr>
                            <a href="javascript:void(0)">By clicking <strong>Request to book,</strong> you agree to the <a href="javascript:void(0)" style="text-decoration: underline;">Passenger Cancellation Policy</a>, the <a href="javascript:void(0)" style="text-decoration: underline;">Terms of Service</a> and the  <a href="javascript:void(0)"  style="text-decoration: underline;">Privacy Policy</a> </a>
                      <div class="mt-3 mb-3 text-center" id="booking-rigt"> 
                        <button style="border: none;" type="submit" class="booking-summary-for-passenger cancelled-bg clickable" modal-name="modal-booking-restricted">
                            Request to book
                        </button>
                    </div>
                        </div>
                  </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>


<script>
    // $("#booking_form").submit(function(e){
    //     e.preventDefault();
    //     // return false;
    // })
    $(document).ready(function(){
        $('#seats').change(function() {
      // Get the selected value
      var selectedSeat = $(this).val();
     // alert(selectedSeat);
     var price = {{$trip->pricing}};
     var total_price = selectedSeat * price;
     var booking_price = 5.46;
     var total_prices = selectedSeat * price + booking_price;
     // alert(price);
      // Update the seat display
      $('#seat-display').text(selectedSeat + ' seat');

      // Update the price display based on the selected seat
      
      $('#price-display').text('$' + total_price);
      $('#total_price').text(total_prices);
      $('#total_price_input').val(total_prices);
    });
  
    });
</script>



@endsection