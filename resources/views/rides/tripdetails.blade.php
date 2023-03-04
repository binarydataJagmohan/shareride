@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@extends('rides.layouts.app')
@section('title','ShareRide From')
@section('content')
<style>
/*    div#hide {*/
/*    display: none;*/
/*}*/
/*#dataContainer{*/
/*   display: block;*/
/*}*/
#trip-info .hide {
     display: block; 
}
.edit-tripp i.fa.fa-pencil {
    font-size: 12px;
    color: #4C4C4C;
    margin-right: 5px;
}
.edit-tripp a {
    color: #4C4C4C;
    text-decoration:underline;
}
</style>
 <section>
    <div class="dashboard-two">
      <div class="container">
        <div class="row" id="bordr-pdeng">
          <div class="col-sm-6" id="checkbox-id">
            <div class="center">
              <input type="checkbox" />
              <span class="coor">Trip open</span> <span class="colo2">Passengers can book on this trip</span>
            </div>
          </div>
          <div class="col-sm-6 text-md-end" id="images-seting">
            <div class="right-setting" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <img src="{{asset('public/images/icon-settings-grey.83e4cbfd8a1d.png')}}" alt="">
              <span>Trip settings</span>
            </div>
          </div>
        </div>

        <div class="route-text" id="trip-info">
          <div class="row mt-4">
            <div class="col-md-5">
              @php
              $origin = DB::table('cities')->where('id',$trips[0]->origin)->first();
              $destination = DB::table('cities')->where('id',$trips[0]->destination)->first();
              @endphp
              <h1 class="mt-4"> {{$trips[0]->origin}} to {{$trips[0]->destination}}</h1>
              <P>Leaving {{$trips[0]->start_date}} at {{$trips[0]->start_time}}</P>
              <!--<p>Leaving Thursday, March 2 at 8:45am</p>-->
              <div class="row align-items-center hide" id="hide">
                <div class="col-sm-12" id="desh-two1">
                    <div class="text-dash">
                        <div class="row">
                            <div class="col-sm-8">
                              <p class="mt-4">Pickup: <a href="#">{{$trips[0]->origin}}</a> </p>
                            </div>
                        </div>
                        <p class="mb-3">Dropoff: <a href="#">{{$trips[0]->destination}}</a> </p>
                        <p class="mb-3">"{{$trips[0]->description}}"</p>
                         <a href="{{url('edit?#text-ara',$trips[0]->id)}}">Edit description</a>
                         <br>
                          <!--<a href="#" class="button-reveal-more-info" id="show_less">Less details</a>-->
                    </div>
                </div>
            </div>
            
              <!--<a href="#" class="button-reveal-more-info" id="show_more">More details</a>-->
            </div>
            
            @if($vehicls)
            <div class="col-md-7" >
              <div class="col-sm-12 mt-lg-1 mt-3" id="vehicle-width">
                <div class="vehicle" id="dataContainer">
                  <div class="row">
                    <div class="col-sm-4 col-4">
                      <img src="{{asset('public/'.$vehicls->img)}}" alt="" width="150px">
                    </div>
                    <div class="col-sm-3 col-3">
                      <div>{{$vehicls->brand}}</div>
                      <div>{{$vehicls->model}}</div>
                      <div>{{$vehicls->year}}</div>
                      <div>{{$vehicls->color}}</div>
                    </div>
                    <div class="col-sm-5 text-end edit-tripp col-5">
                      <a href="{{url('edit?#flex-div',$trips[0]->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                    </div>
                  </div>
                  <div class="row img-cover-class mt-2">
                    <div class="col-sm-2 col-2 text-center">
                      <img src="{{asset('public/images/icon_vehicle_luggage.62a5dcf55f8e.png')}}" alt="">
                    </div>
                    <div class="col-sm-10 col-10">
                      <span>@if($trips != null) {{$trips[0]->luggage ." ok"}}  @endif</span>
                    </div>
                  </div>
                              @php
                              $other = json_decode($trips[0]->other);
                              @endphp
                  <div class="row img-cover-class">
                    <div class="col-sm-2 col-2 text-center">
                      <img src="{{asset('public/images/icon_vehicle_winter_tires.f88d4674a84d.png')}}" alt="">
                    </div>
                    <div class="col-sm-10 col-10">
                      <span> @if(is_array($other) && (in_array('Winter tires',$other))) {{ 'has Winter tires' }} @else {{ 'Winter tires No' }} @endif</span>
                    </div>
                  </div>
                  <div class="row img-cover-class">
                    <div class="col-sm-2 col-2 text-center">
                      <img src="{{asset('public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png')}}" alt="">
                    </div>
                    <div class="col-sm-10 col-10">
                      <span> @if(is_array($other) && (in_array('Skis & snowboards',$other))) {{ 'Skis & snowboards ok' }} @else {{ 'Skis & snowboards  No' }} @endif</span>
                    </div>
                  </div>
                  <div class="row img-cover-class">
                    <div class="col-sm-2 col-2 text-center">
                      <img src="{{asset('public/images/icon_vehicle_bike.30c39bc8ff90.png')}}" alt="">
                    </div>
                    <div class="col-sm-10 col-10">
                       <span>@if(is_array($other) && (in_array('Bikes',$other))) {{ 'Bikes ok' }} @else {{ 'Bikes No'}} @endif</span>
                    </div>
                  </div>
                  <div class="row img-cover-class">
                    <div class="col-sm-2 col-2 text-center">
                      <img src="{{asset('public/images/icon_vehicle_pets.4424314fa4c3.png')}}" alt="">
                    </div>
                    <div class="col-sm-10 col-10">
                       <span>@if(is_array($other) && in_array('Pets',$other)) {{ 'Pets ok'}} @else {{'Pets No'}} @endif </span>
                    </div>
                  </div>
                  <div class="vehicle-plate">
                    <div class="plate">
                      <div class="plate-top">PLATE</div>
                      <div class="plate-number">{{$vehicls->licence_no}}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>

          <div class="plues mt-5">
            <span>Invite people to join your trip</span>
          </div>
          <div class="row mt-5" id="there-con">
            <div class="col-md-4">
              <div class="rules">
                <img src="{{asset('public/images/chat.png')}}" alt="">
                <h6>Respond quickly</h6>
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
                <img src="{{asset('public/images/home1.png')}}" alt="">
                <h6>Get paid after the trip</h6>
                <p>Stick to the speed limit and do not use your phone while driving.</p>
              </div>
            </div>
          </div>
        </div>
        <br><br>
        <hr>
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="four-class">
              <h6>Seating Plan</h6>
              <div class="border-class-box">
                <div class="row">
                  <div class="col-sm-4 col-4 border-end">
                    <span>{{$trips[0]->origin}}</span>
                    <p>{{$trips[0]->start_time}}</p>
                      @if($trips[0]->stop)
                      @foreach(json_decode($trips[0]->stop) as $stop)
                     <div class="line"></div> 
                     <span>{{$stop}}</span>
                     @endforeach
                     @endif
                     <div class="line"></div> 
                    
                    <span>{{$trips[0]->destination}}</span>
                    <p>{{$trips[0]->end_time}}</p>
                  </div>
                  <div class="col-sm-2 col-2 border-end text-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="Seat available">
                    -
                  </div>
                  <div class="col-sm-2  col-2 border-end  text-center" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" data-bs-title="Seat available">
                    -
                  </div>
                  <div class="col-sm-2 col-2  border-end  text-center" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" data-bs-title="Seat available">
                    -
                  </div>
                  <div class="col-sm-2  col-2 text-center" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="Seat available">
                    -
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="four-class">
              <h6>Trip pricing</h6>
              <div class="border-class-box" id="border-left">
                <div class="row  py-2">
                  <div class="col-sm-4 col-4 border-end">
                    <p>{{$trips[0]->origin}} / {{$trips[0]->destination}}</p>
                  </div>
                  <div class="col-sm-8 col-8 text-center">
                    Hisar
                  </div>
                </div>
                <div class="row py-2">
                  <div class="col-sm-4 col-4 border-end">
                    <p>Tohana</p>
                  </div>
                  <div class="col-sm-8 col-4  text-center">
                    <strong>${{$trips[0]->pricing}}</strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        
        <!-- Modal -->
        <div class="modal fade class-cahnge-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Trip settings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="col-sm-12" id="checkbox-id">
                  <div class="center mb-4">
                    <input type="checkbox" />
                    <span class="coor">Trip open</span>
                  </div>
                  <p class="mb-4"> <span class="colo2">Turn off this setting if you’d like dataContainerto stop receiving bookings
                      from passengers</span></p>
                  <div class="divider light no-margin"></div>
                  <a href="{{route('edit',$trips[0]->id)}}" class="modal-list-item">Edit trip</a>
                  <div class="divider light no-margin"></div>
                  <a href="#" class="modal-list-item">Edit pricing</a>
                  <div class="divider light no-margin"></div>
                  <a href="{{url('cancel-trip',$trips[0]->id)}}" class="modal-list-item">Cancel trip</a>
                  <div class="divider light no-margin"></div>
                </div>
              </div>
              <div class="modal-footer">
                <a href="" data-bs-dismiss="modal">Share trip:</a>
                <button type="button" class="btn btn-secondary">More</button>
              </div>
            </div>
          </div>
        </div>


        <div class="modal fade class-cahnge-popup" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Trip settings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="col-sm-12" id="checkbox-id">
                  <p class="mb-4"> <span class="colo2">Uh oh, there are no passengers looking for rides on this route
                      right now.</span></p>
                  <div class="divider light no-margin"></div>
                  <a href="#" class="modal-list-item">Come back later?</a>
                </div>
              </div>
              <div class="modal-footer">
                <p class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">All done</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container-fluid py-5">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.5447316468667!2d76.68998501558927!3d30.703083081647566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390feef45533cde3%3A0x6492bea79120e89a!2sBinary%20Data%20Private%20Limited!5e0!3m2!1sen!2sin!4v1676017642175!5m2!1sen!2sin"
      width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
      </iframe>
  </div>
 <script>
       $(document).ready(function() {
        $('#show_more').click(function() {
            $('#hide').show();
            $('#dataContainer').show();
            $('#show_more').hide();
            // $('#show_less').show();
        });

        $('#show_less').click(function() {
            $('#hide').hide();
            $('#dataContainer').hide();
             $('#show_more').show();
        });
    });
 </script>



@endsection