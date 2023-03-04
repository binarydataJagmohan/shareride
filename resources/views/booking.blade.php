@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@extends('rides.layouts.app')
@section('title','RideShare from ShareRide')
@section('content')
<style>
    a#book_trip {
    text-align: center;
}
</style>
        <section>
         @php 
         $user =  DB::table('users')->where('id',$trips[0]->user_id)->first();
        
         @endphp
        <div class="container mt-5" id="deshboard">
            <div class="row" id="route1">
                <div class="col-sm-1 col-1">
                     @if($user)
                <img src="{{asset('public/'.$user->img)}}" alt="" class="img-responsive img-circle1">
                @else
                <img src="{{asset('public/upload/no.jpg')}}" alt="" class="img-responsive img-circle1">
                @endif
                   
                </div>
                <div class="col-sm-3 col-3">
                    <h6>Hi {{$user->name ?? ''}}&nbsp{{$user->last_name ?? ''}}</h6>
                    <p class="m-0">Welcome to ShareRide!</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-sm-7" id="desh-two1">
                        <div class="text-dash">
                            <h4>Request to book with {{$user->name ?? ''}}</h4>
                            @php
                              $origin = DB::table('cities')->where('id',$trips[0]->origin)->first();
                              $destination = DB::table('cities')->where('id',$trips[0]->destination)->first();
                            @endphp
                            <h3 class="mb-3">{{$trips[0]->origin}} to {{$trips[0]->destination}}</h3>
                            <div class="row">
                                <div class="col-sm-12">
                                    <strong class="mb-3">{{\Carbon\Carbon::parse($trips[0]->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($trips[0]->start_time)->format('H:i')}}</strong>
                                  <p class="mt-4">Pickup: <a href="#"> {{$trips[0]->origin }}</a> </p>
                                </div>
                            </div>
                            <p class="mb-3">Dropoff: <a href="#">{{$trips[0]->destination }}</a> </p>
                             @php
                            $car = DB::table('vehicle_models')->where('user_id',$trips[0]->user_id)->first();
                            @endphp
                            <div class="col-sm-12">
                              <p style="font-size: 16px;"><b>@if($trips[0]->seats > 0 ){{ $trips[0]->seats }} seats left @else <b style="color: red;font-weight:600;">{{ 'Trip is Almost full!!' }} @endif</b></b><br>
                              <span style="color: green;font-weight:600;">${{$trips[0]->pricing}} per seat</span></p>
                            </div>
                            <div class="col-sm-12 mt-3">
                              <div class="row align-items-center">
                                <div class="col-sm-1">
                                  <p>Booked:</p>
                                </div>
                                <div class="col-sm-4">
                                  <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                    @for($i=0;$i < $trips[0]->seats;$i++ )
                                       <input type="checkbox" class="btn-check" id="" autocomplete="off" name="other[]" value="{{$i}}">
                                       <!--<label class="btn btn-outline-primary" for="btncheck5">-->
                                       
                                       <img src="{{ url('public/images/seat1.png') }}" alt=""></label>
                                    @endfor
                                    
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <!--<p>Trip viewed by 3 people</p>-->
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                              <p>"{{ $trips[0]->description }}"</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-5 mt-lg-1 mt-3">
                        @if($car)
                        <div class="vehicle">
                            <div class="row">
                                <div class="col-sm-5 col-5">
                                    <img src="{{asset("public/".$car->img)}}" alt="">
                                </div>
                                <div class="col-sm-7 col-7">
                                 <div><b>{{$car->brand}}</b></div>
                                 <div>{{$car->model}}</div>
                                 <div>{{$car->year}}</div>
                                 <div>{{$car->color}}</div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3" id="text-img">
                              <div class="col-sm-2 col-2">
                                <img src="{{asset('public/images/green-seat.png')}}" alt="">
                              </div>
                              <div class="col-sm-10 col-10">
                                <span>{{$trips[0]->back_row_seat}} in the back</span>
                              </div>
                            </div>
                            @php
                              $other = json_decode($trips[0]->other);

                            @endphp
                            @if($trips != null) 
                            
                            <div class="row mb-3">
                                <div class="col-sm-2 col-2">
                                  <img src="{{asset('public/images/icon_vehicle_luggage.62a5dcf55f8e.png')}}" alt="">
                                </div>
                                <div class="col-sm-10 col-10">
                                  <span>{{$trips[0]->luggage ." ok"}}</span>
                                </div>
                              </div>
                              @endif
                            @if (is_array($other) && (in_array('Winter tires',$other)))
                              <div class="row">
                                <div class="col-sm-2 col-2">
                                  <img src="{{asset('public/images/icon_vehicle_winter_tires.f88d4674a84d.png')}}" alt="">
                                </div>
                                <div class="col-sm-10 col-10">
                                  <span>Has winter tires</span>
                                </div>
                              </div>
                              @endif
                              @if (is_array($other) && (in_array('Skis & snowboards',$other)))
                              <div class="row">
                                <div class="col-sm-2 col-2">
                                  <img src="{{asset('public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png')}}" alt="">
                                </div>
                                <div class="col-sm-10 col-10">
                                  <span>Skis / snowboards ok</span>
                                </div>
                              </div>
                              @endif
                              @if (is_array($other) && (in_array('Bikes',$other)))
                              <div class="row">
                                <div class="col-sm-2 col-2">
                                  <img src="{{asset('public/images/icon_vehicle_bike.30c39bc8ff90.png')}}" alt="">
                                </div>
                                <div class="col-sm-10 col-10">
                                  <span>Bikes ok</span>
                                </div>
                              </div>
                              @endif
                              @if (is_array($other) && (in_array('Pets',$other)))
                              <div class="row">
                                <div class="col-sm-2 col-2">
                                  <img src="{{asset('public/images/icon_vehicle_pets.4424314fa4c3.png')}}" alt="">
                                </div>
                                <div class="col-sm-10 col-10">
                                  <span>Pets ok</span>
                                </div>
                              </div>
                              @endif
                    @endif
                        </div>
                    </div>
                    
                </div>
            </div>
            </section>
            
         <section>
            @php
                $booking = DB::table('bookings')->where(['trip_id'=>$trips[0]->id,'applied_by'=>Auth::user()->id])->count();
            @endphp
            <div class="booking-summary-for-passenger-container">
              @if(Auth::check())
              @if ($trips[0]->user_id == Auth::user()->id)
                <a class="booking-summary-for-passenger cancelled-bg clickable" modal-name="modal-booking-restricted" style="opacity: 0.6;">
                    You can't book this trip
                </a>
                @elseif($booking > 0)
                <a class="booking-summary-for-passenger cancelled-bg clickable" modal-name="modal-booking-restricted" style="opacity: 0.6;">
                  You already applied
              </a>
              @elseif($trips[0]->seats == 0)
                <a class="booking-summary-for-passenger cancelled-bg clickable" modal-name="modal-booking-restricted" style="opacity: 0.6;">
                 Seats unavailble
                </a>
                @else
                <a class="booking-summary-for-passenger cancelled-bg clickable" modal-name="modal-booking-restricted" href="{{route('booking',$trips[0]->id)}}" id="book_trip">
                  Book this trip
              </a>
                @endif
                @else
                <a class="booking-summary-for-passenger cancelled-bg clickable" modal-name="modal-booking-restricted" href="{{route('login')}}" id="book_trip">
                  You have Need To Login first!!
              </a>
                @endif
                  </div>
            </section>
                <!--<div class="container" id="post-send">-->
                <!--    <div class="text-center">-->
                <!--@if($user)-->
                <!--<img src="{{asset('public/'.$user->img)}}" alt="" class="img-center">-->
                <!--@else-->
                <!--<img src="{{asset('public/upload/no.jpg')}}" alt="" class="img-center">-->
                <!--@endif-->
                        <!--<img src="{{asset('public/images/user.jpg')}}" alt="" class="img-center">-->
                <!--        <h6>Vinay wrote this trip description:</strong>-->
                <!--            <div class="message-contents mt-4">-->
                <!--                <div class="message-bubble">-->
                <!--                    <pre class="m-0">{{ Str::limit($trips[0]->description,30,'...') }}</pre>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="message mt-4">-->
                <!--                <div class="message-time align-center">-->
                <!--                    <span>Feb-6 at 6:06 pm</span>-->
                <!--                </div>-->
                <!--                <div class="message-container author">-->
                <!--                    <div class="message-picture">-->
                <!--                        <div class="profile-pic">-->
                <!--                            <img src="{{asset('public/images/1.jpg')}}" alt="">-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="message-contents">-->
                <!--                        <div class="message-bubble">-->
                <!--                            <pre class="m-0">dfgdfgdgdgddgdgdgdgdgdgdg</pre>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="info-msg text-medium no-margin">-->
                <!--               <p> book online, cash isn't allowed. <a href="#" style="text-decoration: underline;color: #333333;">Why?</a></p>-->
                <!--            </div>-->
                <!--            <form action="" class="message-form-row">-->
                <!--                <div class="message-content" placeholder="Message to Vinay" submit-form="tripmessageform">-->
                <!--                    <textarea name="content" cols="40" rows="10" maxlength="1024" required="" id="id_content" placeholder="Message to Vinay"></textarea>-->
                <!--                        <div class="clear"></div>-->
                <!--                        <div class="xs-spacer"></div>-->
                <!--                        <div class="button-loader button-loader-message">-->
                <!--                            <input type="submit" value="Send" submitted-value="&nbsp;" class="message-send-button">-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--            </form>-->
                <!--    </div>-->
                <!--</div>-->
      

@endsection