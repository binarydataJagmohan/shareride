@extends('rides.layouts.app')
@section('title','Post a Trip')
@section('content')

<section class="dash-details">
  @php
  $origin = DB::table('cities')->where('id',$datas->origin)->first();
  $destination = DB::table('cities')->where('id',$datas->destination)->first();
@endphp
<form action="{{route('updatetrip',$datas->id)}}" method="post" enctype='multipart/form-data' id="product-add">
     @method('PUT')
     @csrf

<div class="container">
    <div class="trip_post">
      <div class="row">
        <div class="col-md-6">
          <h1>Edit Trip</h1>
          <div class="hr"></div>
          <h6 class="h6">Itinerary</h6>
          <p>Your origin, destination, and stops you're willing to make along the way.</p>
          <div class="row align-items-center pt-4">
            <div class="col-md-3">
              <div class="left-text">
                <p>Origin</p>
              </div>
            </div>
            <div class="col-md-9 position-relative location">
              <i class="fa-solid fa-location-dot"></i>
              <input type="text" class="@error('origin') is-invalid @enderror form-control" placeholder="Enter an Origin"  data-bs-toggle="modal" data-bs-target="#exampleModal4" name="origin" id="origin" required="" readonly value="{{ $datas->origin}}">
              @error('origin')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
               @enderror
            </div>
          </div>
          <div class="row align-items-center pt-4">
            <div class="col-md-3">
              <div class="left-text">
                <p>Destination</p>
              </div>
            </div>
            <div class="col-md-9 position-relative location">
              <i class="fa-solid fa-location-dot"></i>
              <input type="text" class="form-control" placeholder="Enter a destination" data-bs-toggle="modal" data-bs-target="#exampleModal5" name="destination"  id="destination" readonly value="{{ $datas->destination}}">
            </div>
          </div>
          <div class="row align-items-center pt-4">
            <div class="col-md-3">
              <div class="left-text">
                <p>Stops</p>
                <div class="info-circle"> ?</div>
              </div>
            </div>
            <div class="col-md-9 position-relative location" id="trip-form1">
              <div id="add-via-button" class="clickable" data-bs-toggle="modal" data-bs-target="#exampleModal6">
                Add a stop to get more bookings

              </div>
            </div>
          </div>


          <div class="hr1"></div>
          <h6 class="h6">Ride Schedule</h6>
          <p>Enter a precise date and time <span>with am (morning) or pm (afternoon).</span> </p>
          <div class="p-3" id="tab-commn">
            <nav>
              <div class="nav mb-3" id="" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                  type="button" role="tab" aria-controls="nav-home" aria-selected="true">One-time trip</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                  type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Recurring trip</button>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row align-items-center pt-4">
                  <div class="col-md-3">
                    <div class="left-text">
                      <p>Leaving</p>
                    </div>
                  </div>
                  <div class="col-md-6 position-relative location toolip">
                    <!-- <i class="fa-regular fa-calendar"></i> -->
                    <input type="date" class="form-control" placeholder="Departure date" min="{{date('Y-m-d')}}" name="date" required="" id="date" value="{{old('date',$datas->start_date)}}">
                    <!-- <li class="tootip">Enter a date</li> -->
                  </div>
                  <div class="col-sm-1">
                    at
                  </div>
                  <div class="col-sm-2 classtime p-0">
                    <input type="time" class="form-control" placeholder="Time" name="time" required="" id="time" value="{{old('time',$datas->start_time)}}">
                  </div>
                </div>

                <label for="item-3" class="toggle mt-5">Add return trip</label>
                <input type="checkbox" name="one" id="item-3" class="hide-input">
                <div class="toggle-el">
                  <div class="row align-items-center pt-4">
                    <div class="col-md-3">
                      <div class="left-text">
                        <p>Returning</p>
                      </div>
                    </div>
                    <div class="col-md-6 position-relative location toolip">
                      <!-- <i class="fa-regular fa-calendar"></i> -->
                      <input type="date" class="form-control" placeholder="Departure date" name="rdate" min="{{date('Y-m-d')}}">
                      <!-- <li class="tootip">Enter a date</li> -->
                    </div>
                    <div class="col-sm-1">
                      at
                    </div>
                    <div class="col-sm-2 classtime p-0">
                      <input type="time" class="form-control" placeholder="Time" name="rtimes">
                    </div>
                    <label for="item-3" class="toggle mt-5"> <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-cross-grey.591e3dcde35b.png" alt=""></label>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row">
                  <div class="col-sm-2">
                    <p>Select Date</p>
                    </div>
                  <div class="col-sm-6">
                    <div class="datepicker-inline">
                      <div class="month">
                        <input type="date">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 classtime position-relative" id="close">
                    <p class="mb-3"> Leaving at</p>
                    <input type="text" class="form-control" placeholder="Time">
                    <p class="mt-3 mb-3">Returning at<br>
                      (same day)</p>
                    <input type="text" class="form-control" placeholder="Time">
                    <div id="clear-return-time" class="clear-cross-circle"><i class="fa-solid fa-xmark"></i></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--<div class="col-md-6 pt-200">-->
        <!--  <img src="{{asset('public/images/img.png')}}" alt="" class="img-responsive img-fluid">-->
        <!--</div>-->
      </div>
    </div>
    @if($car)
    <div class="container">
      <div class="row mt-4">
        <div class="hr mb-5"></div>
        <h6 class="h6">Vehicle details</h6>
        <p class="mb-5">This helps you get more bookings and makes it easier for passengers to identify your vehicle
          during pick-up.
        </p>
      </div>
    </div>
    
    <input type="hidden" value=""  name="">
       <div class="container">
        <div class="row" id="main-ride-book">
          <div class="tabs-skips" id="flex-div">  
            <div class="tab-content mt-5" id="myTabContent">
          <!--<div class="row">-->
          <!--  <div class="col-sm-2">-->
          <!--    <div class="form-check">-->
          <!--      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">-->
          <!--      <label class="form-check-label" for="flexCheckDefault">-->
          <!--        Skip vehicle-->
          <!--      </label>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
            tabindex="0">
            <div class="row mt-5" id="img-position">
                
              <div class="col-md-5">
                <div class="vehicle-picture" id="file-box" style="cursor: pointer;">
                  <div class="vehicle-picture-add" style="padding: 0px ;">
                    <!-- <a href=""><input type="file" placeholder=" Add photo" class="img-url"></a> -->
                    <!-- Click here to select a file -->
                    <img src="{{ asset('public/'.$car->img)}}">
                    <!-- <input type="file" id="file-input" style="display: none"> -->
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <strong>
                <p>{{$car->model}}</p>
                 <p>{{$car->type}}</p>
                  <p>{{$car->color}}</p>
                  <p>{{$car->year}}</p>
                  </strong>
              </div>
            </div>
          </div>
          
      </div>
  </div>
</div>
</div>
@endif
    <div class="row mt-4">
      <div class="hr mb-5"></div>
      <h6 class="h6">Trip preferences</h6>
      <p class="mb-5">This informs passengers of how much space you have for their luggage and extras before they book.
      </p>
    </div>
    <div class="row" id="time-set">
      <div class="col-sm-2 classtime" id="close">
        <p class="mb-3">Options</p>
      </div>
      <div class="col-sm-9">
        <p class="mb-4 mt-3">

          <strong>Luggage</strong></p>
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

          <input type="radio" class="btn-check" name="luggage" id="btnradio1" autocomplete="off"  value="No luggage" {{ ($datas->luggage=="No luggage")? "checked" : "" }}>
          <label class="btn btn-outline-primary" for="btnradio1"><i class="fa-solid fa-bag-shopping"></i> No
            luggage</label>

          <input type="radio" class="btn-check" name="luggage"  id="btnradio2" autocomplete="off"  value="S" {{ ($datas->luggage=="S")? "checked" : "" }}>
          <label class="btn btn-outline-primary" for="btnradio2"><i class="fa-solid fa-bag-shopping"></i> S</label>

          <input type="radio" class="btn-check" name="luggage"  id="btnradio3" autocomplete="off"  value="M" {{ ($datas->luggage=="M")? "checked" : "" }}>
          <label class="btn btn-outline-primary" for="btnradio3"><i class="fa-solid fa-bag-shopping"></i> M</label>

          <input type="radio" class="btn-check" name="luggage"  id="btnradio4" autocomplete="off"  value="L" {{ ($datas->luggage=="L")? "checked" : "" }}>
          <label class="btn btn-outline-primary" for="btnradio4"><i class="fa-solid fa-bag-shopping"></i> L</label>
        </div>

        <p class="mt-4"><span>
            Back row seating</span></p>
        <p class="mb-3">Pledge to a maximum of 2 people in the back for better reviews</p>

        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

          <input type="radio" class="btn-check" name="back_sitting" value="Max 2 people" id="btnradio5" autocomplete="off" {{ ($datas->back_row_seat=="Max 2 people")? "checked" : "" }}>
          <label class="btn btn-outline-primary" for="btnradio5"><i class="fa-solid fa-bag-shopping"></i> Max 2 people</label>

          <input type="radio" class="btn-check" name="back_sitting" value="3 people" id="btnradio6" autocomplete="off" {{ ($datas->back_row_seat=="3 people")? "checked" : "" }}>
          <label class="btn btn-outline-primary" for="btnradio6"><i class="fa-solid fa-bag-shopping"></i> 3
            people</label>
        </div>

        <!--<p class="mb-3 mt-4">Other</p>-->
        @php
            $other = json_decode($datas->other);
        @endphp
                    <p class="mb-3 mt-4">Other</p>
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                      <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off" name="others[]" @if (in_array('Winter tires',$other)) checked @endif value="Winter tires">
                      <label class="btn btn-outline-primary" for="btncheck5">
                        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_winter_tires.f88d4674a84d.png" alt=""> Winter tires </label>
                      <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off" name="others[]" @if (in_array('Bikes',$other)) checked @endif value="Bikes">
                      <label class="btn btn-outline-primary" for="btncheck6">
                        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_bike.30c39bc8ff90.png" alt=""> Bikes </label>
                      <input type="checkbox" class="btn-check" id="btncheck7" autocomplete="off" name="others[]" @if (in_array('Skis & snowboards',$other)) checked @endif value="Skis &amp; snowboards">
                      <label class="btn btn-outline-primary" for="btncheck7">
                        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png" alt=""> Skis &amp; snowboards </label>
                      <input type="checkbox" class="btn-check" id="btncheck8" autocomplete="off" name="others[]" @if (in_array('Pets',$other)) checked @endif value="Pets">
                      <label class="btn btn-outline-primary" for="btncheck8">
                        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_pets.4424314fa4c3.png" alt=""> Pets </label>
                    </div>

      </div>
      <div class="container">
        <div class="row mt-4" id="htag">
          <div class="hr mb-5"></div>
          <h6 class="h6">Empty seats</h6>
          <div class="top">
            <strong>Pro tip:</strong> 
           We recommend putting a maximum of 2 people per row to ensureeveryone's comfort.</div>
        </div>

        <div class="row align-items-center mt-5">
          <div class="col-sm-2">
            <p class="mb-0"> <strong>Select a number</strong></p>
          </div>
          <div class="col-sm-10">
            <div class="d-flex-div">
              <ul>
                <input type="radio" class="btn-check" name="seat" value="1" id="btnradio7" autocomplete="off" @if ($datas->seats == 1) checked @endif>
                  <label class="btn " for="btnradio7"> 1</label>
                <input type="radio" class="btn-check" name="seat" value="2" id="btnradio8" autocomplete="off" @if ($datas->seats == 2) checked @endif>
                  <label class="btn" for="btnradio8"> 2</label>
                <input type="radio" class="btn-check" name="seat" value="3" id="btnradio9" autocomplete="off" @if ($datas->seats == 3) checked @endif>
                  <label class="btn" for="btnradio9"> 3</label>
                <input type="radio" class="btn-check" name="seat" value="4" id="btnradio10" autocomplete="off" @if ($datas->seats == 4) checked @endif>
                  <label class="btn" for="btnradio10"> 4</label>
                <input type="radio" class="btn-check" name="seat" value="5" id="btnradio11" autocomplete="off" @if ($datas->seats == 5) checked @endif>
                  <label class="btn" for="btnradio11"> 5</label>
                <input type="radio" class="btn-check" name="seat" value="6" id="btnradio12" autocomplete="off" @if ($datas->seats == 6) checked @endif>
                  <label class="btn" for="btnradio12"> 6</label>
                <input type="radio" class="btn-check" name="seat" value="7" id="btnradio13" autocomplete="off" @if ($datas->seats == 7) checked @endif>
                  <label class="btn" for="btnradio13"> 7</label>

              </ul>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="hr mb-3"></div>
          <br><br>
          <h6 class="h6">Pricing</h6>
          <div class="mb-5">Enter a fair price per seat to cover your gas and other expenses. Note that all prices are
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">CAD</a> .
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <p><strong>Price per seat</strong></p>
          </div>
          <div class="col-sm-10">
            <p><i>Please scroll up to enter an origin and destination so we can recommend a fair price for your
                trip.</i></p>
          </div>
        </div>
        <div class="row mt-5">
          <div class="hr mb-3"></div>
          <br><br>
          <br><br>
          <h6 class="h6">Booking preference</h6>
          <div class="mb-5">Select your preference: review each booking request manually or accept all bookings instantly.
          </div>
        </div>
        <div class="modal fade modelcahnge " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h6>Currency support</h6>
                <p>Please note that prices on Poparide are in <strong>Canadian dollars ($CAD)</strong></p>
                <p>If you are based in the US, you can still post trips, but an exchange rate will apply when your
                  payout is sent to your US PayPal account.</p>
                <p>We intend to support multiple currencies soon.</p>
                <div class="mt-5">
                  <a href="#" class="popup-onebtn">Got it</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-sm-2">
          <p>Select a type</p>
        </div>
        <div class="col-sm-5 mt-5">
          <div class="card">
            <img src="{{asset('pubic/images/icon_request_to_book.6d57c6621e14.png')}}" alt="" class="img-fluid imgclass">
            <div class="card-body">
              <h5 class="card-title">Request to book</h5>
              <strong>You approve or decline passengers manually</strong>
              <p class="card-text">
                <i>You control who gets in your car</i></p>
            </div>
          </div>
        </div>
        <div class="col-sm-5" id="#trip-form">
         <p class="text-end"> <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal1" >More Info</a></p>
          <div class="card card-2">
            <img src="{{asset('public/images/icon_instant_book_greyed.988ce14db2cd.png')}}" alt="" class="img-fluid imgclass1">
            <div class="card-body">
              <h5 class="card-title">Instant book</h5>
              <strong>Unavailable for you</strong>
              <p class="card-text">
                <i>Drive at least 5 passengers to enable Instant book</i></p>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade modelcahnge" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon_instant_book.12f0689c84f8.svg" alt="">
            <span>Instant book</span>
            <h6 class="mt-3 mb-3">Passengers are instantly booked on your trip</h6>
         <div class="row" id="timeid">
          <div class="col-sm-2">
            <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/on_time.db6baae9329b.svg" alt="">
          </div>
          <div class="col-sm-10">
            <span>No need to manually approve bookings</span>
            <p>When passengers book, they are automatically approved on your trip.</p>
          </div>
         </div>
         <div class="row mt-3" id="timeid">
          <div class="col-sm-2">
            <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-smiley-grey.d1c499868cd9.png" alt="">
          </div>
          <div class="col-sm-10">
            <span>
              Happier members</span>
            <p>Passengers don't have to wait to get approved. This provides a better experience for them and helps you fill your car faster.</p>
          <p>Read more about Instant book in our  <a href="#">Help centre <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-new-window.1ff942fdce75.png" alt="" class="img-cover"></a></p>
          
          </div>
         </div>
            <div class="mt-5">
              <a href="#" class="popup-onebtn">Got it</a>
            </div>
          </div>
        </div>
      </div>
    </div>

      <div class="row mt-5">
        <div class="hr mb-3"></div>
        <br><br>
        <h6 class="h6">Trip description</h6>
        <div class="mb-5">Add any details relevant to your trip for passengers before they book. expenses. Note that all
          prices are CAD.
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-sm-2">
            <p>Description</p>
          </div>
          <div class="col-sm-10">
            <div class="mb-3" id="text-ara">
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="We recommend writing the exact pick-up and drop-off locations in your description" required name="description" id="floatingTextarea" value="{{old('description',$datas->description)}}">{{$datas->description}}
          </textarea>
             </div>
          <!--   <div class="form-floating">
              <textarea class="form-control" placeholder="We recommend writing the exact pick-up and drop-off locations in your description" id="floatingTextarea" name="desc" required=""></textarea>
            </div> -->
          </div>
        </div>
        <div class="row mt-5">
          <div class="hr mb-5"></div>
          <h6 class="h6">
            Rules when posting a trip</h6>
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot3.png')}}" alt="">
              <h6>Be reliable</h6>
              <p>Only post a trip if you’re sure you’re driving and show up on time.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot1.png')}}" alt="">
              <h6>No cash</h6>
              <p>All passengers pay online and you receive a payout after the trip.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot2.png')}}" alt="">
              <h6>Drive safely</h6>
              <p>Stick to the speed limit and do not use your phone while driving.</p>
            </div>
          </div>
          <!--<div class="form-check mt-4" id="cheak">-->
          <!--  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required="">-->
          <!--  <label class="form-check-label" for="flexCheckDefault">-->
          <!--    I agree to these rules, to the <a href="#">Driver Cancellation Policy, Terms of Service </a> and the <a-->
          <!--      href="#">Privacy Policy,</a> and <strong>I understand that my account could <br>be suspended if I break-->
          <!--      the rules</strong>-->
          <!--  </label>-->
          <!--</div>-->
        </div>
      </div>
      <div class="hr mb-5 mt-5"></div>
      <div class="">
        <input type="submit" value="Update Trip" class="button darkgrey" id="trip-post-button">
      </div>
    </div>
  </div>
</form>

    
</section>
<script>
document.getElementById("file-box").addEventListener("click", function() {
      document.getElementById("image").click();
    });
    $(document).ready(function() {
      $("#image").change(function() {
        const file = this.files[0];
        if (file) {
          let reader = new FileReader();
          reader.onload = function(event) {
            $(".vehicle-picture-add").removeAttr("style");
            $(".vehicle-picture-add").css("background-image", "url(" + event.target.result + ")");
            
            
          };
          reader.readAsDataURL(file);
        }
      });
    });
 $(document).ready(function() {
     
      //validation for form 
        $("#product-add").validate({
 
            rules: {
                origin: {
                    required: true,
                    maxlength: 50,
                },
 
                destination: {
                    required: true,
                },
 
                date: {
                    required: true,
                },
                time: {
                    required: true,
                },
                seat: {
                    required: true,
                },
                image: {
                    required: true,
                },
            },
            messages: {
 
                origin: {
                    required: "Please enter start Origin Point",
                },
                destination: {
                    required: "Please enter valid destination",
                },
                 date: {
                    required: "Please enter date",
                },
                time: {
                    required : "Please enter time",
                },
                seat: {
                    required: 'please select the seat',
                },
              
            },
        });
 });
</script>
@endsection