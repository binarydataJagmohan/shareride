@extends('layouts.app')
@section('title','Home')
@section('content')
<style>
input.stop_name.col-sm-10:focus {
    border: none;
    outline: none;
    margin-left: 15px;
    padding: 6px 0;
  }

input.stop_name.col-sm-10.search_stop {
    border: none;
}
</style>
  <section>
    <div class="container pt-5" id="banner">
      <div class="row">
        <div class="col-md-6">
          <div class="sec-text">
            <h3>Carpool for the Planet</h3>
            <h6>Join 600,000+ people who carpool between cities in Canada. <strong> <i>Free sign up.</i></strong></h6>
            <div class="mt-4">
              <a href="javascript:void(0)" class="downloadbtn">Download our app</a>
              <a href="#" class="howbtn">how it works</a>
            </div>
          </div>
          <form method="" action="{{route('find')}}">
          <div class="formtype">
            <h6>Need a ride?</h6>
            <p>Find a ride and carpool anywhere in Canada.</p>
            <div class="row">
              <div class="col-md-6 mt-3 position-relative location">
                <i class="fa-solid fa-location-dot"></i>
               <!--  <input type="text" class="form-control m-0" readonly placeholder="Form" data-bs-toggle="modal"
                  data-bs-target="#addOrigin" name="origin" id="origin" required>
                   <input type="hidden" name="origin" id="origin_value"> -->
                   <input type="text" class="form-control" readonly placeholder="Enter an Origin" data-bs-toggle="modal" data-bs-target="#addOrigin" id="origin" required="">
                <input type="hidden" name="origin" id="origin_value">
              </div>


          

              <div class="col-md-6 mt-3 position-relative location">
                <i class="fa-solid fa-location-dot"></i>
                <!-- <input type="text" class="form-control m-0" readonly placeholder="To" data-bs-toggle="modal"
                  data-bs-target="#addDestination" name="destination" id="destination" required>
                  <input type="hidden" name="destination" id="destination_value"> -->
                  <input type="text" class="form-control" readonly placeholder="Enter a destination" data-bs-toggle="modal" data-bs-target="#addDestination" id="destination" required="">
                <input type="hidden" name="destination" id="destination_value">
              </div>
              <div class="col-md-12 mt-3 position-relative location toolip">
                <!-- <i class="fa-regular fa-calendar"></i> -->
                <input type="date" class="form-control m-0" placeholder="Leaving (optional)" min="{{date('Y-m-d')}}">
                <!-- <li class="tootip">Enter a date</li> -->
                <!--<div class="location-clear"></div>-->
              </div>
            </div>
            <button class="trip-search-button mt-4">Find a ride</button>
          </div>
          </form>
        </div>
        <div class="col-md-6 text-lg-end">
          <img src="https://cdn.poparide.com/static/pop/webui/common/images/home/home-clouds.05ba4607b412.svg" alt=""
            id="img-show">
          <div class="img-banner">
            <img src="{{asset('public/images/home-picture-5.582fe34ff9cf.jpg')}}" alt="">
          </div>

          <div class="bule mt-5" id="home-post-box">
            <div class="blue-div">
              <h6 class="text-start">Driving somewhere?</h6>
              <div class="row align-items-center">
                <div class="col-sm-3 text-start col-3">
                  <h5>City A</h5>
                </div>
                <div class="col-sm-6 text-start col-6">
                  <img src="https://cdn.poparide.com/static/pop/webui/common/images/home/car-a-b.651df5a95345.svg"
                    alt="">
                </div>
                <div class="col-sm-3 text-start col-3">
                  <h5>City B</h5>
                </div>
              </div>
              <p class="text-start">
                Post empty seats and collect money to cover your driving costs.</p>
              <a href="{{url('trip/offer')}}"><button class="trip-search-button mt-4 bg-chngebtn">Post your trip</button></a>
            </div>
          </div>
        </div>
      </div>
      <div class="home-safety-box">
        <img src="https://cdn.poparide.com/static/pop/webui/common/images/home/safety-graphic.6b6a3d449191.svg" alt="">
        <h1>Trust and Safety</h1>
        <p>Poparide is designed with your safety in mind.</p>
        <button class="trip-search-button mt-4 bg-chngebtn1">Find out more</button>
      </div>
    </div>
  </section>


     {{-- Start origin model  --}}
     
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

  <section class="sectiontwo">
    <div class="container mt-5">
      <div class="row align-items-center">
        <div class="col-sm-8 mb-3">
          <div class="sectwo">
            <img src="https://cdn.poparide.com/static/pop/webui/common/images/home/tree-graphic.bcb581f22bc1.svg"
              alt="">
            <h1>Over <strong>11,000</strong> Metric Tonnes<br>
              of CO2 saved since 2015</h1>
          </div>
        </div>
        <div class="col-sm-4" id="pleft">
          <p class="mb-3">Learn how we're reducing our carbon footprint.</p>
          <a href="#" class="readbtn">Read more</a>
        </div>
      </div>
    </div>
  </section>

  <section class="section-there">
    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-3 d-lg-block d-none m-0">
              <img src="{{asset('public/images/1.jpg')}}" alt="" class="img-responsive img-same">
              <div class="col-sm-12 d-lg-block d-none mt-4">
                <img src="{{asset('public/images/2.jpg')}}" alt="" class="img-responsive img-same">
              </div>
            </div>
            <div class="col-sm-6 position-relative">
              <img src="{{asset('public/images/3.jpg')}}" alt="" class="img-responsive img-center">
              <div class="text-img">
                <p> Follow our members’ adventures<br>

                  <a href="javascript:void(0)">on Instagram </a> and on <a href="javascript:void(0)">TikTok</a> </p>
              </div>
            </div>
            <div class="col-sm-3 d-lg-block d-none">
              <img src="{{asset('public/images/image.png')}}" alt="" class="img-responsive img-height">
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  <section>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-11" id="slidetext">
          <h1>We receive a 4.7 star rating on average</h1>
          <div id="testimonial-slider" class="owl-carousel">
            <div class="testimonial">
              <h3 class="title mb-4">"Safest and most reliable Canadian rideshare platform."</h3>
              <div class="testimonial-content">
                <div class="testimonial-profile">
                  <img src="{{asset('public/images/1.jpg')}}" alt="">
                  <span class="post">Bev Knapton</span>
                </div>
              </div>
            </div>

            <div class="testimonial">
              <h3 class="title mb-4">
                "This service is awesome. I recommend it to everyone."</h3>
              <div class="testimonial-content">
                <div class="testimonial-profile">
                  <img src="{{asset('public/images/2.jpg')}}" alt="">
                  <span class="post">Michael Lee
                  </span>
                </div>
              </div>
            </div>
            <div class="testimonial">
              <h3 class="title mb-4">
                "This service is awesome. I recommend it to everyone."</h3>
              <div class="testimonial-content">
                <div class="testimonial-profile">
                  <img src="{{asset('public/images/3.jpg')}}" alt="">
                  <span class="post">Michael Lee
                  </span>
                </div>
              </div>
            </div>
            <div class="testimonial">
              <h3 class="title mb-4">
                "This service is awesome. I recommend it to everyone."</h3>
              <div class="testimonial-content">
                <div class="testimonial-profile">
                  <img src="{{asset('public/images/4.jpg')}}" alt="">
                  <span class="post">Michael Lee
                  </span>
                </div>
              </div>
            </div>
          </div>
          <p class="text-center">More reviews on the <strong> <a href="#">App store,</a> </strong> the <strong> <a
                href="#">Play store,</a> </strong> <strong> <a href="#">Google,</a> </strong> and <strong> <a
                href="#">Facebook</a> </strong> </p>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container" id="img-full">
      <img src="{{asset('public/images/full.png')}}" alt="">
    </div>
  </section>
@endsection

