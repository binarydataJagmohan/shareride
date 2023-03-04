@extends('rides.layouts.app')
@section('title','Find a Trip')
@section('content')
<style>
  div#input-container\ col-sm-12 {
    border-bottom: 2px solid;
    padding: 10px 0;
  }

  i.fa-solid.fa-location-dot {
    font-size: 20px;
  }

  input.stop_name.col-sm-10:focus {
    border: none;
    outline: none;
    margin-left: 15px;
    padding: 6px 0;
  }

  #input-container>img {
    position: absolute;
    top: 12px;
    left: 15px;
  }

  #input-container>input {
    padding-left: 40px;
  }
  .location .form-control{
      padding:15px 25px !important
  }
</style>

    <div class="container position-relative">
    <form class="row g-3" id="fromclass" method="post" action="{{url('find-trip')}}">
      @csrf
      <div class="col-md-3 mt-lg-0 text-center">
        <div class="position-relative location">
         <!--  <i class="fa-solid fa-location-dot"></i> -->
         <i class="fa-solid fa-location-dot" style="top:unset !important;margin: 15px -19px 10px;"></i>
          <input type="text" class="form-control" data-bs-toggle="modal" data-bs-target="#addOrigin" value="{{$origin->name ?? ''}}" style="margin-left: 10px;" placeholder="From" readonly  name="origin" id="input1"/ required>
          <input type="hidden" id="origin_value" name="origin">
        </div>
      </div>
      <div class="col-md-1 mt-lg-0 text-lg-center">
        <img src="{{asset('public/images/rute.png')}}" alt="" id="swapButton" />
      </div>
      <div class="col-md-3 mt-lg-0 text-center">
        <div class="position-relative location">
          <i class="fa-solid fa-location-dot" style="top:unset !important;;margin: 15px -19px 10px;"></i>
          <input type="text" class="form-control" placeholder="To" value="{{$destination->name ?? ''}}" style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#addDestination" readonly  id="input2" name="destination" required/>
          <input type="hidden" id="destination_value" name="destination">
        </div>
      </div>
      <div class="col-md-3 mt-lg-0">
        <div class="position-relative location toolip">
          
          <input type="date" class="form-control" placeholder="Leaving (optional)" name="date" min="{{date('Y-m-d')}}"/>
          <!-- <li class="tootip">Enter a date</li> -->
        </div>
      </div>
      <div class="col-md-2 mt-0" id="confrm-trips">
        <button type="submit" class="trip-search-button1">Search</button>
      </div>
    </form>
  </div>
   
  <div class="container">
    <div class="recent">
      @if(count($trip) > 0)

      <div class="post-book">
        <p class="mt-3 mb-5">@php $date1 = date('Y-m-d'); $day = date('l M,d',strtotime($date1)); echo $day @endphp</p>
        @foreach($trip as $arr)
         @php 
         $user =  DB::table('users')->where('id',$arr->user_id)->first();
         @endphp
        <div class="trip-container">
          <a href="{{route('booktrip',$arr->id)}}"><div class="trip-item clickable hide-on-mobile">
            <div class="trip-item-bar"></div>
            <div class="row">
              <div class="col-md-3">
                <div class="post-img">
                 @if($user)
                <img src="{{asset('public/'.$user->img)}}" alt="" class="img-responsive img-circle">
                @else
                <img src="{{asset('public/upload/no.jpg')}}" alt="" class="img-responsive img-circle">
                @endif
                  <!--<img src="{{asset('public/images/1.jpg')}}" alt="" />-->
                </div>
                <div class="post-text">
                     @if($user != null || '')
                  <h6 class="mt-3">{{$user->name}}&nbsp{{$user->last_name}}</h6>
                     @endif
                  <p>No ratings, yet</p>
                </div>
              </div>
              <div class="col-md-5">
                <div class="post-text-center">
                 
                  <h6>{{ Session::get('origin') }} to {{ Session::get('destination') }}</h6>
                  <span>Leaving </span>
                  <!-- <span><strong>Wednesday, February 15 at 9:30am</strong></span> -->
                  <span><strong>{{\Carbon\Carbon::parse($arr->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($arr->start_time)->format('H:i')}}</strong></span>
                </div>
                <div class="pickup mt-5">
                  <p>Pickup: <span>{{$arr->origin}}</span></p>
                  <p>
                    Dropoff:
                    <span>{{$arr->destination}}</span>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-8">
                    <div class="img-post-right">
                            @php
                            $car = DB::table('vehicle_models')->where('user_id',$arr['user_id'])->first();
                             $other = json_decode($arr->other);
                             $title = $other;
                            @endphp
                        @if(isset($car))
                        @if($car->img != null)
                      <img src="{{asset('public/'.$car->img)}}" class="home-img" alt="" />
                      @endif
                      
                      <p>{{$arr->model}}</p>
                      <ul class="d-flex img-box mt-3">
                        @if ($car->luggage)
                        <li>
                          <img src="{{asset('public/images/icon_vehicle_luggage.62a5dcf55f8e.png')}}" alt="" title="{{ $arr->luggage.' luggage ok' }}" />
                        </li>
                        @endif
                        @if (is_array($other) && (in_array('Winter tires',$other)))
                        <li>
                          <img src="{{asset('public/images/icon_vehicle_winter_tires.f88d4674a84d.png')}}" alt="" title="Winter tires Ok" />
                        </li>
                        @endif
                        @if (is_array($other) && (in_array('Bikes',$other)))
                        <li>
                          <img src="{{asset('public/images/icon_vehicle_bike.30c39bc8ff90.png')}}" alt="" title="Bikes Ok"  />
                        </li>
                        @endif
                        @if (is_array($other) && (in_array('Skis & snowboards',$other)))
                        <li>
                          <img src="{{asset('public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png')}}" alt="" title="Skis & snowboards ok"/>
                        </li>
                        @endif
                        @if (is_array($other) && (in_array('Pets',$other)))
                        <li>
                          <img src="{{asset('public/images/icon_vehicle_pets.4424314fa4c3.png')}}" alt=""  title="Pets Ok"/>
                        </li>
                        @endif
                        @endif
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-4 text-end">
                    <div class="seat">
                        @if($arr->seats > 0 )
                      <strong>{{$arr->seats}} seats left</strong>
                      @else
                      <strong>{{ 'Trip is Full' }}</strong>
                      @endif
                      <span>${{$arr->pricing}}</span>
                      <p>par seat</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div></a>
        </div>
        
        @endforeach
      </div>
    <!--  <div id="trip-list-ctas">-->
    <!--    <a href="javascript:void(0)" class="trip-list-cta driver">-->
    <!--      <div class="trip-list-cta-indicator"></div>-->
    <!--      <div class="trip-list-cta-title">Are you driving?</div>-->
    <!--      <div class="trip-list-cta-subtitle">Post a trip and cover your driving costs</div>-->
    <!--    </a>-->
    <!--  <div class="trip-list-cta-middle hide-on-mobile">or</div>-->
    <!--  <div id="trip-list-ctas">-->
    <!--    <a href="javascript:void(0)" class="trip-list-cta driver">-->
    <!--      <div class="trip-list-cta-indicator"></div>-->
    <!--      <div class="trip-list-cta-title">Need a ride?</div>-->
    <!--      <div class="trip-list-cta-subtitle">Post a request to tell drivers where you're going</div>-->
    <!--    </a>-->
    <!--  </div>-->
    <!--</div>-->
 
    </div>
     @else
    <P>No Result found</P>
    @endif
  </div>

  {{-- select origin model  --}}
  <div class="modal fade" id="addOrigin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enter a stop</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="input-container col-sm-12">
            <i class="fa-solid fa-location-dot"></i>
            <input type="text" class="stop_name col-sm-10 search_stop" data-type="origin" placeholder="" style="border: none;" required>
          </div>
          <p class="mt-4">Enter at least three characters to get started.</p>
          <div class="mt-3">
            <div class="row">
              <ul class="list-unstyled" id="origin_list"></ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end origin model  --}}
  {{-- select DESTINATION model  --}}
  <div class="modal fade" id="addDestination" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enter a stop</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="input-container col-sm-12">
            <i class="fa-solid fa-location-dot"></i>
            <input type="text" class="stop_name col-sm-10 search_stop" data-type="destination" placeholder="" style="border: none;" required>
          </div>
          <p class="mt-4">Enter at least three characters to get started.</p>
          <div class="mt-3">
            <div class="row">
              <ul class="list-unstyled" id="destination_list"></ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end DESTINATION model  --}}
 
  <section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var siteUrl = jQuery('meta[name="site-url"]').attr('content');

$(".search_stop").on("input", function() {
        var city = $(this).val();
        var type = $(this).attr('data-type');
        // alert(type);
        // alert(city);
        $.ajax({
          type: "POST",
          data: {
            city: city
          },
          url: siteUrl + "/search-stops",
          success: function(response) {
            if (response.status == "success") {
              var stops = response.data;
              var html = " ";
              stops.forEach(stop => {
                html += `<li style="cursor:pointer;" data-id="${stop.id}" data-type="${type}" data-name="${stop.name}" data-state="${stop.state}" data-country="${stop.country}" data-pin="${stop.pin_code}" class="stop"><p style="font-weight: 600;font-size:16px;">${stop.name} , ${stop.state} , ${stop.country}</p><hr></li>`
              });
              console.log(html);
              if (html.length > 0) {
                if (type == 'origin') {
                  $("#origin_list").html(html);
                } else if (type == 'destination') {
                  $("#destination_list").html(html);
                } else {
                  $("#stops_list").html(html);
                }
              }
            }
          },
        });
      });

      $(document).on("click", '.stop', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var state = $(this).attr('data-state');
        var country = $(this).attr('data-country');
        var pin = $(this).attr('data-pin');
        var type = $(this).attr('data-type');
        if (type == 'origin') {
          $("#input1").val(`${name} , ${state} , ${country}`);
          $("#origin_value").val(name);
          $('#addOrigin').modal('hide');
        } else if (type == 'destination') {
          $("#input2").val(`${name} , ${state} , ${country}`);
          $("#destination_value").val(name);
          $('#addDestination').modal('hide');
        } else {
          var html = `<div class="mt-2">
									      <i class="fa-solid fa-location-dot" style="top:unset !important;margin-top: 20px;"></i>
                        <input type="text" class="form-control"  value="${name} , ${state} , ${country} , ${pin}"  id="destination" required="">
                        <input type="hidden" class="form-control" placeholder="Enter a destination" name="stops[]" value="${id}"  id="destination" required="">
                     </div>`;
          $(html).insertBefore("#insert_before");
          $('#addStopsModal').modal('hide');
        }
        
      });
      
      $(document).ready(function(){
          $('#fromclass').validate({
              rules:{
                  origin:{
                      required:true,
                  },
                  destination:{
                       required:true,
                  },
              },
                  messages:{
                      origin:{
                          required:'origin  is required',
                      },
                      destination:{
                          required:'destination is required',
                      },
                  }
          });
      });
      
</script>

@endsection