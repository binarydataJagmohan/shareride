@extends('rides.layouts.app') @section('title','Dashboard') @section('content') <section class="dash-details">
    <div class="container">
      <div class="row"> @include('account.sidebar') <div class="col-sm-9">
          <h1><?php if(isset($vehicle)){ echo "Edit"; }else{ echo "Add"; } ?> Vehicle</h1>
          <br>
            <form method="post" enctype="multipart/form-data" action="{{ url('update-vehicle') }}"> @csrf <input type="hidden" name="vehicle_id" value="{{ $vehicle->id ?? "" }}">
              <div class="row" id="target">
                <div class="col-sm-6" id='target'>
                  <div class="vehicle-picture" id="select_photo">
                    <div class="d-none">
                    <input type="file" id="photo" name="img" value="{{ $vehicle->img ?? "" }}">
                    </div>
                    @if(isset($vehicle))
                    @if($vehicle->img != null)
                    <img id="preview_photo" src="{{ asset('public/'.$vehicle->img) }}" class="" alt="">
                    
                    @else
                    <img id="preview_photo" src="{{ asset('public/images/icon-vehicle-add.fc6fe73ed22b.png') }}" class="w-100" alt="">
                    @endif
                    @else
                    <img id="preview_photo" src="{{ asset('public/images/icon-vehicle-add.fc6fe73ed22b.png') }}" class="w-100" alt="">
                    @endif
                  </div>
                </div>
                @php
                $types = DB::table('vehicle_models')->get();
                
                @endphp
                <div class="col-sm-6" id="target">
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
                      <option value="{{ $cars->brand_name }}" <?php if(isset($vehicle)){ if($cars->brand_name == $vehicle->brand) 
                          { echo "selected"; }} ?>>{{ $cars->brand_name }}</option>
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
                    <select id="car-model" name="car_model_name" class="form-select">
                        @php $types = DB::table('brand_types')->get(); @endphp
                      <option value="">Select a brand first</option>
                      @foreach($types as $type)
                      <option value="{{ $type-> brand_types}}" <?php if(isset($vehicle)){ if($type->brand_types == $vehicle->model) 
                          { echo "selected"; }} ?>>{{ $type->brand_types }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>
                  <!--<div class="row mt-5 align-items-center" id="max-width">-->
                    <div class="row mt-2 align-items-center" id="max-width">
              <div class="col-sm-2 text-lg-end">
                <div class="vehicle-label model">Type</div>
              </div>
              <div class="col-sm-10">
                    @php $car_type = DB::table('car_type')->get(); @endphp
                  <select class="form-select" name="type">
                      <option value="">Select a car type</option>
                      @foreach($car_type as $ct)
                      <option value="{{ $ct->car_type }}" <?php if(isset($vehicle)){ if($ct->car_type == $vehicle->type) 
                          { echo "selected"; }} ?>>{{ $ct->car_type }}</option>
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
                <select class="form-select" aria-label="Default select example" name="color" id="color">
                  <option value="">Select a color</option>
                      @foreach($color as $clr)
                      <option value="{{ $clr->color }}" <option value="{{ $clr->color }}" <?php if(isset($vehicle)){ if($clr->color  == $vehicle->color) 
                          { echo "selected"; }} ?>>{{ $clr->color }}</option>
                      @endforeach
                </select>
              </div>
              </div>
                    
                      <div class="row mt-2 align-items-center" id="max-width1">
              <div class="col-sm-2 text-lg-end">
                <div class="vehicle-label model">Year</div>
              </div>
              <div class="col-sm-4" type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="This top tooltip is themed via CSS variables.">
                <input type="number" min="1908" max="2024" id="id_year" placeholder="1991" data-gtm-form-interact-field-id="0" aria-invalid="false" class="form-control" name='year' value="{{ $vehicle->year ?? '' }}">
              </div>
              <div class="col-sm-2 text-center">
                <div class="vehicle-label model">Licence Plate</div>
              </div>
              <div class="col-sm-4">
                <input type="text" step="1" id="id_year" placeholder="POP 123" data-gtm-form-interact-field-id="0" aria-invalid="false" class="form-control" name="licence" id="licence" value="{{ $vehicle->licence_no ?? '' }}">
              </div>
            </div>
                  </div>
                  <div></div>
                  <button type="submit" class="button darkgrey mt-3" id="trip-post-button">Update Vehicle</button>
                </div>
                
                <!--<div class="row">-->
                <!--  <div class="col-sm-9">-->
                <!--    <p class="mb-4 mt-3">-->
                <!--      <strong>Luggage</strong>-->
                <!--    </p>-->
                <!--    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">-->
                <!--      <input type="radio" class="btn-check" name="luggage" id="btnradio1" autocomplete="off" <?php if(isset($vehicle))if($vehicle->luggage == "NO"){ { echo "checked"; } }?> value="No">-->
                <!--      <label class="btn btn-outline-primary" for="btnradio1">-->
                <!--        <i class="fa-solid fa-bag-shopping"></i> No luggage </label>-->
                <!--      <input type="radio" <?php if(isset($vehicle))if($vehicle->luggage == "Small"){ { echo "checked"; } }?> class="btn-check" name="luggage" valeu="Small" id="btnradio2" autocomplete="off"  value="S">-->
                <!--      <label class="btn btn-outline-primary" for="btnradio2">-->
                <!--        <i class="fa-solid fa-bag-shopping"></i> S </label>-->
                <!--      <input type="radio" <?php if(isset($vehicle))if($vehicle->luggage == "Medium"){ { echo "checked"; } }?> class="btn-check" name="luggage" value="Medium" id="btnradio3" autocomplete="off" >-->
                <!--      <label class="btn btn-outline-primary" for="btnradio3">-->
                <!--        <i class="fa-solid fa-bag-shopping"></i> M </label>-->
                <!--      <input type="radio" <?php if(isset($vehicle))if($vehicle->luggage == "Large"){ { echo "checked"; } }?> class="btn-check" name="luggage" value="Large" id="btnradio4" autocomplete="off" >-->
                <!--      <label class="btn btn-outline-primary" for="btnradio4">-->
                <!--        <i class="fa-solid fa-bag-shopping"></i> L </label>-->
                <!--    </div>-->
                <!--    <p class="mt-4">-->
                <!--      <span> Back row seating</span>-->
                <!--    </p>-->
                <!--    <p class="mb-3">Pledge to a maximum of 2 people in the back for better reviews</p>-->
                <!--    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">-->
                <!--      <input type="radio" <?php if(isset($vehicle))if($vehicle->back_row_seat == 2){ { echo "checked"; } }?> class="btn-check" name="back_sitting" value="2" id="btnradio5" autocomplete="off" >-->
                <!--      <label class="btn btn-outline-primary" for="btnradio5">-->
                <!--        <i class="fa-solid fa-bag-shopping"></i> Max 2 people </label>-->
                <!--      <input type="radio" class="btn-check" <?php if(isset($vehicle))if($vehicle->back_row_seat == 3){ { echo "checked"; } }?> name="back_sitting" value="3" id="btnradio6" autocomplete="off">-->
                <!--      <label class="btn btn-outline-primary" for="btnradio6">-->
                <!--        <i class="fa-solid fa-bag-shopping"></i> 3 people </label>-->
                <!--    </div>-->
                <!--    @if($vehicle != null)-->
                <!--    @if($vehicle->others != null)-->
                <!--    @php-->
                <!--         $other = json_decode($vehicle->others);-->
                <!--    @endphp-->
                <!--    <p class="mb-3 mt-4">Other</p>-->
                <!--    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">-->
                <!--      <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off" name="others[]" @if (in_array('Winter tires',$other)) checked @endif value="Winter tires">-->
                <!--      <label class="btn btn-outline-primary" for="btncheck5">-->
                <!--        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_winter_tires.f88d4674a84d.png" alt=""> Winter tires </label>-->
                <!--      <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off" name="others[]" @if (in_array('Bikes',$other)) checked @endif value="Bikes">-->
                <!--      <label class="btn btn-outline-primary" for="btncheck6">-->
                <!--        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_bike.30c39bc8ff90.png" alt=""> Bikes </label>-->
                <!--      <input type="checkbox" class="btn-check" id="btncheck7" autocomplete="off" name="others[]" @if (in_array('Skis & snowboards',$other)) checked @endif value="Skis &amp; snowboards">-->
                <!--      <label class="btn btn-outline-primary" for="btncheck7">-->
                <!--        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png" alt=""> Skis &amp; snowboards </label>-->
                <!--      <input type="checkbox" class="btn-check" id="btncheck8" autocomplete="off" name="others[]" @if (in_array('Pets',$other)) checked @endif value="Pets">-->
                <!--      <label class="btn btn-outline-primary" for="btncheck8">-->
                <!--        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_pets.4424314fa4c3.png" alt=""> Pets </label>-->
                <!--    </div>-->
                    
                <!--    @endif-->
                <!--    @else-->
                <!--    <p class="mb-3 mt-4">Other</p>-->
                <!--    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">-->
                <!--      <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off" name="others[]"  value="Winter tires">-->
                <!--      <label class="btn btn-outline-primary" for="btncheck5">-->
                <!--        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_winter_tires.f88d4674a84d.png" alt=""> Winter tires </label>-->
                <!--      <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off" name="others[]"  value="Bikes">-->
                <!--      <label class="btn btn-outline-primary" for="btncheck6">-->
                <!--        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_bike.30c39bc8ff90.png" alt=""> Bikes </label>-->
                <!--      <input type="checkbox" class="btn-check" id="btncheck7" autocomplete="off" name="others[]"  value="Skis &amp; snowboards">-->
                <!--      <label class="btn btn-outline-primary" for="btncheck7">-->
                <!--        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png" alt=""> Skis &amp; snowboards </label>-->
                <!--      <input type="checkbox" class="btn-check" id="btncheck8" autocomplete="off" name="others[]"  value="Pets">-->
                <!--      <label class="btn btn-outline-primary" for="btncheck8">-->
                <!--        <img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_pets.4424314fa4c3.png" alt=""> Pets </label>-->
                <!--    </div>-->
                    
                <!--    @endif-->
                    
                <!--  </div>-->
                <!--</div>-->
              </div>
              
        </div>
        </form>
      </div>
    </div>
    </div>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script>
    document.getElementById("select_photo").addEventListener("click", function() {
      document.getElementById("photo").click();
    });
    $(document).ready(function() {
      $("#photo").change(function() {
        const file = this.files[0];
        if (file) {
          let reader = new FileReader();
          reader.onload = function(event) {
            $("#preview_photo").removeAttr("src");
            $("#preview_photo").attr("src", event.target.result);
          };
          reader.readAsDataURL(file);
        }
      });
    });
  </script> @endsection