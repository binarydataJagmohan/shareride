@extends('rides.layouts.app') @section('title','Post a Trip') @section('content') <style>
  /* div#input-container\ col-sm-12 {
    border-bottom: 2px solid;
    padding: 10px 0;
  } */

  i.fa-solid.fa-location-dot {
    font-size: 22px;
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
  #tooltip-text {
  position: relative;
  display: inline-block;
}

#tooltip-text .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute ;
  z-index: 1;
  bottom: 100%;
  left: 50%;
  margin-left: -60px;
}

#tooltip-text:hover .tooltiptext {
  visibility: visible;
}
</style>
<section class="dash-details">
  <form method="post" action="{{route('posttrip')}}" id="trip_add" enctype='multipart/form-data'> @csrf <div class="container">
      <div class="trip_post">
        <div class="row">
          <div class="col-md-12">
            <h1>Post a trip</h1>
            <!---->
            <div class="accordion" id="accordionPanelsStayOpenExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <span class="copy_icon">
                      <i class="fa-solid fa-copy" style="font-size: 25px;padding: 0 10px;"></i>
                    </span>Copy another trip's details </button>
                </h2> @foreach ($trips as $trip)
                @php
                  $origin = DB::table('cities')->where('id',$trip->origin)->first();
                  $destination = DB::table('cities')->where('id',$trip->destination)->first();
                @endphp
                <!--<hr>-->
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body" style="padding: 5px 20px;">
                    <div class="row" style="align-items: center;">
                      <div class="col-sm-8">
                        <a href="{{ url('book/trip',$trip->id) }}">{{ $trip->origin }} to {{ $trip->destination }}</a>
                        <p>
                          <span>{{ $trip->seats }}</span> Seats <span> • {{ $trip->pricing ?? 00 }} per seat</span>
                        </p>
                      </div>
                      <div class="col-sm-4" style="text-align: right; ">
                        <p class="trip_detail" data-id="{{ $trip->id }}" style="cursor: pointer;">Copy</p>
                      </div>
                    </div>
                  </div>
                </div> @endforeach @if($trip_count == 0) <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <strong>No trip found.</strong>
                  </div>
                </div> @endif
              </div>
            </div>
            <div class="col-md-12 mt-3 trip_copied d-none">
              <p>
                <span class="right_sign" style="color: green;font-weight: 600;font-size: 16px;">
                  <i class="fa fa-check" aria-hidden="true"></i>Trip copied </span>- Scroll down to complete your trip
              </p>
            </div>
            <!---->
          </div>
          <div class="col-md-6">
            {{-- <div class="hr"></div> --}}
            <h6 class="h6">Itinerary</h6>
            <p>Your origin, destination, and stops you're willing to make along the way.</p>
            <div class="row align-items-center pt-4">
              <div class="col-md-3">
                <div class="left-text">
                  <p>Origin</p>
                </div>
              </div>
              <div class="col-md-9 position-relative location" id="tooltip-text">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" class="form-control" readonly placeholder="Enter an Origin" data-bs-toggle="modal" data-bs-target="#addOrigin" id="origin" required="">
                <input type="hidden" name="origin" id="origin_value">
                <!--<span class="tooltiptext">Tooltip text</span>-->
              </div>
              <!-- <div class="modal fade modelcahnge oldclass" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><h6>Enter an origin</h6><div class="input-group mb-3" id="location"><span class="input-group-text" id="basic-addon1"><img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/location.a9dbd27e31d6.svg" alt=""></span><input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="origin"></div></div></div></div></div> -->
            </div>
            <div class="row align-items-center pt-4">
              <div class="col-md-3">
                <div class="left-text">
                  <p>Destination</p>
                </div>
              </div>
              <div class="col-md-9 position-relative location">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" class="form-control" readonly placeholder="Enter a destination" data-bs-toggle="modal" data-bs-target="#addDestination" id="destination" required="">
                <input type="hidden" name="destination" id="destination_value">
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
                <div class="mt-2" id="insert_before">
                  <div id="add-via-button" class="clickable" data-bs-toggle="modal" data-bs-target="#addStopsModal"> Add a stop to get more bookings </div>
                </div>
              </div>
            </div>
            <div class="hr1"></div>
            <h6 class="h6">Ride Schedule</h6>
            <p>Enter a precise date and time <span>with am (morning) or pm (afternoon).</span>
            </p>
            <div class="p-3" id="tab-commn">
              <nav>
                <div class="nav mb-3" id="" role="tablist">
                  <button class="nav-link active" id="nav-home-tabs" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">One-time trip</button>
                  <!--<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Recurring trip</button>-->
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
                      <input type="date" class="form-control" placeholder="Departure date" min="{{date('Y-m-d')}}" name="date" required="" id="date">
                      <!-- <li class="tootip">Enter a date</li> -->
                    </div>
                    <div class="col-sm-1"> at </div>
                    <div class="col-sm-2 classtime p-0">
                      <input type="time" class="form-control" placeholder="Time" name="time" required="" id="time">
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
                      <div class="col-sm-1"> at </div>
                      <div class="col-sm-2 classtime p-0">
                        <input type="time" class="form-control" placeholder="Time" name="rtimes" id="rtimes">
                      </div>
                      <label for="item-3" class="toggle mt-5">
                        <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-cross-grey.591e3dcde35b.png" alt="">
                      </label>
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
                      <p class="mt-3 mb-3">Returning at <br> (same day) </p>
                      <input type="text" class="form-control" placeholder="Time">
                      <div id="clear-return-time" class="clear-cross-circle">
                        <i class="fa-solid fa-xmark"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 pt-200">
            <img src="{{asset('public/images/img.png')}}" alt="" class="img-responsive img-fluid">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-4">
          <div class="hr mb-5"></div>
          <h6 class="h6">Vehicle details</h6>
          <p class="mb-5">This helps you get more bookings and makes it easier for passengers to identify your vehicle during pick-up. </p>
        </div>
      </div>
      @if(isset($car_details)) 
      <input type="hidden" value="{{ $car_details->id }}" name="car_id">
      <div class="container">
        <div class="row" id="main-ride-book">
          <div class="tabs-skips" id="flex-div">
            <div class="tab-content mt-5" id="myTabContent">
              <!--<div class="row">-->
              <!--  <div class="col-sm-2">-->
                  <!--<div class="form-check">-->
                  <!--  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">-->
                  <!--  <label class="form-check-label" for="flexCheckDefault"> Skip vehicle </label>-->
                  <!--</div>-->
              <!--  </div>-->
              <!--</div>-->
              <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="row mt-5" id="img-position">
                  <div class="col-md-5">
                    <div class="vehicle-picture" id="file-box" style="cursor: pointer;">
                      <div class="vehicle-picture-add" style="padding: 0px ;">
                        <!-- <a href=""><input type="file" placeholder=" Add photo" class="img-url"></a> -->
                        <!-- Click here to select a file -->
                        <img src="{{ asset('public/').'/'.$car_details->img }}">
                        <!-- <input type="file" id="file-input" style="display: none"> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                        <p><b>{{$car_details->brand}}</b></p>
                      <p>{{$car_details->model}}</p>
                      <p>{{$car_details->type}}</p>
                      <p>{{$car_details->color}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @else 
      <div class="navtabs-clas">
        <div class="row">
          <div class="col-sm-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="toggle" name="skip_vehicle">
              <label class="form-check-label" for="flexCheckDefault"> Skip vehicle </label>
            </div>
          </div>
        </div>
        <div class="row" id="target">
          <div class="col-sm-2"></div>
          <div class="col-sm-4" id='target'>
            <div class="vehicle-picture" id="file-box">
              <div class="vehicle-picture-add" style="background: url('{{ url('public/images/icon-vehicle-add.fc6fe73ed22b.png') }}') no-repeat;">
                <!-- <a href=""><input type="file" placeholder=" Add photo" class="img-url"></a> --> 
                <!-- style="display: none"  -->
                <input type="file" id="image" name="img" required style="display:none;">
              </div>
                    
            </div>
          </div>
          <div class="col-sm-4" id="target">
            <div class="vehicle-details">
              <div class="row align-items-center">
                <div class="col-sm-2 text-lg-end">
                  <div class="vehicle-label model">Brand</div>
                </div>
                <div class="col-md-10 position-relative location">
                    <!--<input type="text" class="form-control" name="car_brand" id="brand-input" oninput="searchBrands(this.value)">-->
                    <!--<div id="brand-results"></div>-->
                    @php $car = DB::table('car_brands')->get(); @endphp
                    <select id="car-brand" name="car_brand" class="form-select">
                    <option value="">Select your car brand</option>
                    @foreach($car as $cars)
                      <option value="{{ $cars->brand_name }}">{{ $cars->brand_name }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              
              <div class="row mt-2 align-items-center">
                <div class="col-sm-2 text-lg-end">
                  <div class="vehicle-label model">Model</div>
                </div>
                <div class="col-md-10 position-relative location">
                    <!--<input type="text" class="form-control" name="car_model_name"  id="model-input" oninput="searchModels(this.value)">-->
                    <!--<div id="model-results"></div>-->
                    <select id="car-model" name="car_model_names" class="form-select">
                        @php $types = DB::table('brand_types')->get(); @endphp
                      <option value="">Select a brand first</option>
                      @foreach($types as $type)
                      <option value="{{ $type-> brand_types}}">{{ $type->brand_types }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              
            </div>
            
            <div class="row mt-2 align-items-center" id="max-width">
              <div class="col-sm-2 text-lg-end">
                <div class="vehicle-label model">Type</div>
              </div>
              <div class="col-sm-10">
                   @php $car_type = DB::table('car_type')->get(); @endphp
                  <select class="form-select" name="type">
                      <option value="">Select a car type</option>
                      @foreach($car_type as $ct)
                      <option value="{{ $ct->car_type }}">{{ $ct->car_type }}</option>
                      @endforeach
                    </select>
                    </div>
                </div>
                <div class="row mt-2 align-items-center" id="max-width">
                  <div class="col-sm-2 text-center">
                    <div class="vehicle-label model">Color</div>
                  </div>
              <div class="col-sm-10">
                  @php $color = DB::table('colors')->get(); @endphp
                <select class="form-select" aria-label="Default select example" name="color" required="" id="color">
                  <option value="">Select a color</option>
                  <option value="">Select a car Color</option>
                      @foreach($color as $clr)
                      <option value="{{ $clr->color }}">{{ $clr->color }}</option>
                      @endforeach
                </select>
              </div>
              </div>
              
              <div class="row mt-2 align-items-center" id="max-width1">
              <div class="col-sm-2 text-lg-end">
                <div class="vehicle-label model">Year</div>
              </div>
              <div class="col-sm-4" type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="This top tooltip is themed via CSS variables.">
                <input type="number" min="1908" max="2024" id="id_year" placeholder="1991" data-gtm-form-interact-field-id="0" aria-invalid="false" class="form-control" name='year'>
              </div>
              <div class="col-sm-2 text-center">
                <div class="vehicle-label model">Licence Plate</div>
              </div>
              <div class="col-sm-4">
                <input type="text" step="1" id="id_year" placeholder="POP 123" data-gtm-form-interact-field-id="0" aria-invalid="false" class="form-control" name="licence" id="licence">
              </div>
            </div>
            </div>
            
            <div></div>
          
        </div>
      </div>
      
      @endif 
      
      <div class="row mt-4">
        <div class="hr mb-5"></div>
        <h6 class="h6">Trip preferences</h6>
        <p class="mb-5">This informs passengers of how much space you have for their luggage and extras before they book. </p>
      </div>
      <div class="row" id="time-set">
        <div class="col-sm-2 classtime" id="close">
          <p class="mb-3">Options</p>
        </div>
        <div class="col-sm-9">
          <p class="mb-4 mt-3">
            <strong>Luggage</strong>
          </p>
          <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input type="radio" class="btn-check luggage" name="luggage" id="btnradio1" autocomplete="off" checked value="No luggage">
            <label class="btn btn-outline-primary" for="btnradio1">
              <i class="fa-solid fa-bag-shopping"></i> No luggage </label>
            <input type="radio" class="btn-check luggage" name="luggage" id="btnradio2" autocomplete="off" value="Small">
            <label class="btn btn-outline-primary" for="btnradio2">
              <i class="fa-solid fa-bag-shopping"></i> S </label>
            <input type="radio" class="btn-check luggage" name="luggage" id="btnradio3" autocomplete="off" value="Medium">
            <label class="btn btn-outline-primary" for="btnradio3">
              <i class="fa-solid fa-bag-shopping"></i> M </label>
            <input type="radio" class="btn-check luggage" name="luggage"id="btnradio4" autocomplete="off" value="Large">
            <label class="btn btn-outline-primary" for="btnradio4">
              <i class="fa-solid fa-bag-shopping"></i> L </label>
          </div>
          <p class="mt-4">
            <span> Back row seating</span>
          </p>
          <p class="mb-3">Pledge to a maximum of 2 people in the back for better reviews</p>
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check back_sitting" name="back_sitting" value="Max 2 people" id="btnradio5" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio5">
              <i class="fa-solid fa-bag-shopping"></i> Max 2 people </label>
            <input type="radio" class="btn-check back_sitting" name="back_sitting" value="3 people" id="btnradio6" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio6">
              <i class="fa-solid fa-bag-shopping"></i> 3 people </label>
          </div>
          <p class="mb-3 mt-4">Other</p>
          <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off" name="other[]" value="Winter tires">
            <label class="btn btn-outline-primary" for="btncheck5">
              <img src="{{asset('public/images/icon_vehicle_winter_tires.f88d4674a84d.png')}}" alt=""> Winter tires </label>
            <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off" name="other[]" value="Bikes">
            <label class="btn btn-outline-primary" for="btncheck6">
              <img src="{{asset('public/images/icon_vehicle_bike.30c39bc8ff90.png')}}" alt=""> Bikes </label>
            <input type="checkbox" class="btn-check" id="btncheck7" autocomplete="off" name="other[]" value="Skis & snowboards">
            <label class="btn btn-outline-primary" for="btncheck7">
              <img src="{{asset('public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png')}}" alt=""> Skis & snowboards </label>
            <input type="checkbox" class="btn-check" id="btncheck8" autocomplete="off" name="other[]" value="Pets">
            <label class="btn btn-outline-primary" for="btncheck8">
              <img src="{{asset('public/images/icon_vehicle_pets.4424314fa4c3.png')}}" alt=""> Pets </label>
          </div>
        </div>
        <div class="container">
          <div class="row mt-4" id="htag">
            <div class="hr mb-5"></div>
            <h6 class="h6">Empty seats</h6>
            <div class="top">
              <strong>Pro tip:</strong> We recommend putting a maximum of 2 people per row to ensureeveryone's comfort.
            </div>
          </div>
          <div class="row align-items-center mt-5">
            <div class="col-sm-2">
              <p class="mb-0">
                <strong>Select a number</strong>
              </p>
            </div>
            <div class="col-sm-10">
              <div class="d-flex-div">
                <ul>
                  <input type="radio" class="btn-check" name="seat" value="1" id="btnradio7" autocomplete="off">
                  <label class="btn " for="btnradio7"> 1</label>
                  <input type="radio" class="btn-check" name="seat" value="2" id="btnradio8" autocomplete="off">
                  <label class="btn" for="btnradio8"> 2</label>
                  <input type="radio" class="btn-check" name="seat" value="3" id="btnradio9" autocomplete="off">
                  <label class="btn" for="btnradio9"> 3</label>
                  <input type="radio" class="btn-check" name="seat" value="4" id="btnradio10" autocomplete="off">
                  <label class="btn" for="btnradio10"> 4</label>
                  <input type="radio" class="btn-check" name="seat" value="5" id="btnradio11" autocomplete="off">
                  <label class="btn" for="btnradio11"> 5</label>
                  <input type="radio" class="btn-check" name="seat" value="6" id="btnradio12" autocomplete="off">
                  <label class="btn" for="btnradio12"> 6</label>
                  <input type="radio" class="btn-check" name="seat" value="7" id="btnradio13" autocomplete="off">
                  <label class="btn" for="btnradio13"> 7</label>
                </ul>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="hr mb-3"></div>
            <br>
            <br>
            <h6 class="h6">Pricing</h6>
            <div class="mb-5">Enter a fair price per seat to cover your gas and other expenses. Note that all prices are <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">CAD</a> . </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <p>
                <strong>Price per seat</strong>
              </p>
            </div>
            <div class="col-sm-10">
              <p>
                <i><input type="number" name="price" step="1" min="5" required="" data-msg-required="Please enter a contribution" data-msg-min="Please enter a minimum of $5" max="34"  data-lpignore="true" autocomplete="off" id="id_compensation" class="valid" aria-invalid="false" value="$12/-"></i>
              </p>
            </div>
          </div>
          <div class="row mt-5">
            <div class="hr mb-3"></div>
            <br>
            <br>
            <br>
            <br>
            <h6 class="h6">Booking preference</h6>
            <div class="mb-5">Select your preference: review each booking request manually or accept all bookings instantly. </div>
          </div>
          <div class="modal fade modelcahnge " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h6>Currency support</h6>
                  <p>Please note that prices on Poparide are in <strong>Canadian dollars ($CAD)</strong>
                  </p>
                  <p>If you are based in the US, you can still post trips, but an exchange rate will apply when your payout is sent to your US PayPal account.</p>
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
                  <i>You control who gets in your car</i>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-5" id="#trip-form">
            <p class="text-end">
              <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal1">More Info</a>
            </p>
            <div class="card card-2">
              <img src="{{asset('public/images/icon_instant_book_greyed.988ce14db2cd.png')}}" alt="" class="img-fluid imgclass1">
              <div class="card-body">
                <h5 class="card-title">Instant book</h5>
                <strong>Unavailable for you</strong>
                <p class="card-text">
                  <i>Drive at least 5 passengers to enable Instant book</i>
                </p>
              </div>
            </div>
          </div>
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
                  <input type="text" class="stop_name col-sm-10 search_stop" data-type="origin" placeholder="" style="border: none;">
                  <hr>
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
                  <input type="text" class="stop_name col-sm-10 search_stop" data-type="destination" placeholder="" style="border: none;">
                  <hr>
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
        {{-- add stops modal --}}
        <div class="modal fade" id="addStopsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter a stop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="input-container col-sm-12">
                  <i class="fa-solid fa-location-dot"></i>
                  <input type="text" class="stop_name col-sm-10 search_stop" placeholder="" style="border: none;">
                </div>
                <p class="mt-4">Enter at least three characters to get started.</p>
                <div class="mt-3">
                  <div class="row">
                    <ul class="list-unstyled" id="stops_list"></ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- end modal  --}}
        <div class="modal fade modelcahnge" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <span> Happier members</span>
                    <p>Passengers don't have to wait to get approved. This provides a better experience for them and helps you fill your car faster.</p>
                    <p>Read more about Instant book in our <a href="#">Help centre <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-new-window.1ff942fdce75.png" alt="" class="img-cover">
                      </a>
                    </p>
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
          <br>
          <br>
          <h6 class="h6">Trip description</h6>
          <div class="mb-5">Add any details relevant to your trip for passengers before they book. expenses. Note that all prices are CAD. </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <p>Description</p>
            </div>
            <div class="col-sm-10">
              <div class="mb-3" id="text-ara">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="We recommend writing the exact pick-up and drop-off locations in your description" required name="description" id="floatingTextarea"></textarea>
              </div>
              <!--   <div class="form-floating"><textarea class="form-control" placeholder="We recommend writing the exact pick-up and drop-off locations in your description" id="floatingTextarea" name="desc" required=""></textarea></div> -->
            </div>
          </div>
          <div class="row mt-5">
            <div class="hr mb-5"></div>
            <h6 class="h6 mb-5 mt-5"> Rules when posting a trip</h6>
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
            <div class="form-check mt-4" id="cheak">
             <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" required name="toc">
              <label class="form-check-label" for="flexCheckDefault">
              I agree to these rules, to the <a href="#">Driver Cancellation Policy, Terms of Service </a> and the <a href="#">Privacy Policy,</a> and <strong>I understand that my account could <br>be suspended if I break the rules </strong>
              </label>
            </div>
          </div>
        </div>
        <div class="hr mb-5 mt-5"></div>
        <div class="">
          <input type="submit" class="button darkgrey" value="Submit">
        </div>
      </div>
    </div>
  </form>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var siteUrl = jQuery('meta[name="site-url"]').attr('content');
    $(function() {
      $(".trip_detail").click(function() {
        var id = $(this).attr("data-id");
        $.ajax({
          type: "POST",
          url: siteUrl + "/get-trip-details",
          data: {
            id: id
          },
          success: function(response) {
            if (response.status == "success") {
              var trip = response.data;
              console.log(trip);
              $('#origin').val(`${response.origin.name} , ${response.origin.state} , ${response.origin.country} , ${response.origin.pin_code}`);
              $('#destination').val(`${response.destination.name} , ${response.destination.state} , ${response.destination.country} , ${response.destination.pin_code}`);
              $('#origin_value').val(response.origin.id);
              $('#destination_value').val(response.destination.id);
              $('#date').val(trip.start_date);
              $('#time').val(trip.start_time);
              $('#rtimes').val(trip.rtimes);
              $('.luggage[value="' + trip.luggage + '"]').attr("checked", 'checked');
              $('.back_sitting[value="' + trip.back_row_seat + '"]').attr("checked", 'checked');
              $(".trip_copied").removeClass('d-none');
              $(".accordion-collapse").collapse("hide");
            }
          },
        });
      });
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
                html += `<li style="cursor:pointer;" data-id="${stop.id}" data-type="${type}" data-name="${stop.name}" data-state="${stop.state}" data-country="${stop.country}" data-pin="${stop.pin_code}" class="stop">
			<p style="font-weight: 600;font-size:16px;">${stop.name}</p>
			<p>${stop.state} , ${stop.country}</p>
			<hr>
		</li>`
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
          $("#origin").val(`${name} , ${state} , ${country} , ${pin}`);
          $("#origin_value").val(`${name}`);
          $('#addOrigin').modal('hide');
        } else if (type == 'destination') {
          $("#destination").val(`${name} , ${state} , ${country} , ${pin}`);
          $("#destination_value").val(`${name}`);
          $('#addDestination').modal('hide');
        } else {
          var html = `<div class="mt-2">
									      <i class="fa-solid fa-location-dot" style="top:unset !important;margin-top: 20px;"></i>
                        <input type="text" class="form-control"  value="${name} , ${state} , ${country} , ${pin}"  id="destination" required="">
                        <input type="hidden" class="form-control" placeholder="Enter a destination" name="stops[]" value="${name}"  id="destination" required="">
                     </div>`;
          $(html).insertBefore("#insert_before");
          $('#addStopsModal').modal('hide');
        }
        
      });
    });
  });

  $("#form_id").submit(function(e){
    e.preventDefault();
    name = $('#name').val();
    email = $('#email').val();
    pass = $('#password').val();
    if(name = ""){
      $('#name_error').show();
      return false;
    }
    if(email = ""){
      $('#email_error').show();
      return false;
    }
    if(pass = ""){
      $('#pass_error').show();
      return false;
    }
  })
</script>
<script>
  $("#trip_add").validate({
    rules: {
      origin: {
        required: true,
        maxlength: 50,
        //notEqualTo: "#destination"
      },
      destination: {
        required: true,
       // notEqualTo: "#origin"
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
      description: {
        required: true,
        maxlength: 100,
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
        required: "Please enter time",
      },
      seat: {
        required: 'please select the seat',
      },
      description: {
        required: 'Please enter  the description',
      },
    },
  });
</script>
<script>

$(document).ready(function() {

  // when car-brand select box value changes
  $('#car-brand').on('change', function() {
    // get selected brand value
    var brand = $(this).val();
    // filter models based on selected brand
    var models = carModels[brand];
    // remove all options except the default option
    $('#car-model').children('option:not(:first)').remove();
    // add options for selected brand's models
    $.each(models, function(index, value) {
      $('#car-model').append('<option value="' + value + '">' + value + '</option>');
    });
  });
});

// car models data
// var carModels = {
//   volkswagen: ['Jetta', 'Golf', 'Passat', 'Tiguan', 'Atlas'],
//   toyota: ['Camry', 'Corolla', 'RAV4', 'Highlander', 'Tacoma'],
//   ford: ['Mustang', 'F-150', 'Escape', 'Explorer', 'Edge'],
//   honda: ['Accord', 'Civic', 'CR-V', 'Pilot', 'Odyssey'],
//   bmw: ['3 Series', '5 Series', 'X3', 'X5', 'M3'],
//   audi: ['A4', 'A6', 'Q5', 'Q7', 'RS5'],
//   'mercedes-benz': ['C-Class', 'E-Class', 'S-Class', 'GLC', 'GLE'],
//   chevrolet: ['Corvette', 'Silverado', 'Equinox', 'Traverse', 'Suburban'],
//   nissan: ['Sentra', 'Altima', 'Rogue', 'Pathfinder', 'Frontier'],
//   hyundai: ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Palisade']
// };

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
</script> @endsection