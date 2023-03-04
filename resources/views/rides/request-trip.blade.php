@extends('rides.layouts.app')
@section('title','Trip Request')
@section('content')
<style>
  #modal-popup-there a.btn.btn-secondary {
    padding: 10px 50px;
    border: 2px solid #dfdbdb;
    background: transparent;
    color: #000;
    font-size: 14px;
  }

  a.btn.btn-secondary.red {
    color: red !important;
  }

  a.btn.btn-secondary.green {
    color: green !important;
  }

  .modal-body {
    padding: 0px 30px 0px;
  }

  .modal-footer {
    display: inline-block;
    padding-left: 24px;
  }

  #modal-popup-there button.btn.btn-secondary.green {
    padding: 10px 50px;
    border: 2px solid #dfdbdb;
    background: transparent;
    color: green;
    font-size: 14px;
  }

  .nav-link:focus,
  .nav-link:hover {
    color: #000;
  }

  button#booking-tab {
    background: none;
    border: none;
    padding: 10px 10px;
  }
</style>
<section class="dash-details">
  <div class="container">
    <div class="page-details">
      <div class="tabs-class">
        <ul class="nav" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">Trips
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link req" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Requests
            </button>
          </li>
          <!-- <li class="nav-item" role="presentation">-->
          <!--  <button class="nav-link req" id="my_booking" data-bs-toggle="tab" data-bs-target="#my_booking-tab-pane" type="button" role="tab" aria-controls="my_booking-tab-pane" aria-selected="false">My Booking-->
          <!--  </button>-->
          <!--</li>-->
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile-tab-pane1" type="button" role="tab" aria-controls="profile-tab-pane1" aria-selected="false">Archive
            </button>
          </li>
        </ul>

        @php
        $request_data = App\Models\PostTrip::where('user_id',Auth::user()->id)->get();
        @endphp

        <section class="dash-details p-0">
          <div class="container">
            <div class="page-details" id="bg-remove">
              <div class="tab-content" id="myTabContent">
                @if(count($request_data) > 0)
                <div id="hide">
                  @foreach($request_data as $data)
                  @php
                  $cancel_trip = App\Models\PostTrip::where('user_id',Auth::user()->id)->where('id',$data->id)->first();
                  @endphp
                  @if($cancel_trip->status != 'cancel')
                  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="top mt-4 ">
                      <div class="row" id="booking-new">
                        <div class="col-md-6">
                          <a href="{{url('tripdetail',$data->id)}}">
                            <h5>{{$data->origin}} to {{$data->destination}}</h5>
                          </a>
                          @if($data->stop != null)
                          <i>Stops: @foreach (json_decode($data->stop) as $item) {{ $item."," }} @endforeach</i><br>
                          @endif
                          <strong>{{\Carbon\Carbon::parse($data->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($data->start_time)->format('H:i')}}</strong>
                          <hr>
                          <a href="{{url('edit',$data->id)}}" class="clr">Edit</a>
                          <hr>
                          <a href="{{url('cancel-trip',$data->id)}}" class="clr">Cancel trip</a>
                          <hr>
                        </div>
                        <div class="col-md-6">
                          @php
                          $booking = DB::table('bookings')->where('trip_id',$data->id)->count();
                          @endphp
                          @if ($booking == 0)
                          <p><i>No bookings on this trip.</i></p>
                          @else
                          <p><i>{{$booking}} bookings on this trip.</i></p>
                          @endif

                        </div>
                      </div>
                    </div>
                  </div>
                  @else

                  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="top mt-4">
                      <div class="row" id="booking-new">
                        <div class="col-md-6">
                          <div class="mt-1 mb-1 trip-cancelled-alert">Trip cancelled</div>
                          <h5>{{$data->origin}} to {{$data->destination}}</h5>
                          @if($data->stop != null)
                          <i>Stops: @foreach (json_decode($data->stop) as $item) {{ $item."," }} @endforeach </i><br>
                          @else
                          <p>dgsdfdhd</p>
                          @endif
                          <strong>{{\Carbon\Carbon::parse($data->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($data->start_time)->format('H:i')}}</strong>
                        </div>
                        <div class="col-md-6">
                          <p><i>No bookings on this trip.</i></p>
                        </div>
                      </div>
                    </div>
                  </div>

                  @endif
                  @endforeach
                </div>
                @else
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                  <p class="mt-5">You have no requests set <a href="{{url('trip/offer')}}" style="text-decoration:underline;"> Post a trip</a>.</p>
                </div>
                 
                @endif
                  

                @php
                $post_request = App\Models\TripRequest::where('user_id',Auth::user()->id)->where('status','!=','deleted')->first();
                @endphp

                @foreach($bookings as $booking)
                @php
                $user = DB::table('users')->where('id',$booking->applied_by)->first();
                @endphp
                @if($booking->id == null)
                <div id="booking_id" style="display:none;">
                    <hr>
                  <div class="box shadow-sm rounded bg-white mb-3" style="padding: 15px 0;" id="booking_id">
                    <div class="box-body p-0">
                      <div class="row align-items-center">
                        <div class="col-sm-2">
                          <img src="{{ url('public/'.$user->img) }}">
                        </div>
                        <div class="col-sm-8">
                          <p class="text-dark">Message from <b>{{ $user->name." ".$user->last_name }}</b><span class="badge badge-light" style="background:red;">new</span></p>
                          <p>{{ $booking->message }}</p>
                        </div>
                        <div class="col-sm-2">
                          <p>{{ $booking->created_at->diffForHumans() }}</p>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div id="booking_id" style="display:none;">
                     <hr>
                  <div class="box shadow-sm rounded bg-white mb-3" style="padding: 15px 0;">
                    <div class="box-body p-0">
                      <div class="row align-items-center">
                        <div class="col-sm-2">
                          <div id="nuser">
                            <img src="{{ url('public/'.$user->img) }}">
                          </div>
                        </div>
                        <div class="col-sm-8">
                          <p class="text-dark">Message from <b>{{ $user->name." ".$user->last_name }}</b><span class="badge badge-light" style="background:red;">new</span></p>
                          <p class="text-dark">Booking for : <b>{{ $booking->origin." to ". $booking->destination }}</b></p>
                          <p class="text-dark">Seats : <b>{{ $booking->seats }}</b></p>
                          <p class="text-dark">{{ $booking->message }}</p>
                        </div>
                        <div class="col-sm-2">
                          @if($booking->status == 'pending')
                          <a href="{{ url('confirm-booking',$booking->id) }}" class="btn-dark btn"><i class="fa fa-check" aria-hidden="true"></i></a>
                          <a href="{{ url('cancel-booking',$booking->id) }}" class="btn-dark btn"><i class="fa fa-window-close" aria-hidden="true"></i></a>
                          @elseif($booking->status == 'cancelled')
                          <button class="btn-danger btn" style="opacity:0.6;"><i class="fa fa-check" aria-hidden="true"></i></button>
                          @else
                          <button class="btn-success btn" style="opacity:0.6;"><i class="fa fa-check" aria-hidden="true"></i></button>
                          @endif

                        </div>
                      </div>
                      <div class="container" style="text-align: right">
                        <p>{{ $booking->created_at->diffForHumans() }}</p>
                      </div>
                    </div>
                  </div>
                  </div>
                    @endif
                    @endforeach
                    @if($post_request != '')
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                      <div class="top mt-4 ">
                        <div class="row" id="booking-new">
                          <div class="col-md-6">
                            <h5>{{$post_request->pickup_location}} to {{$post_request->drop_location}}</h5>
                            <strong>{{\Carbon\Carbon::parse($post_request->leaving)->format('l , F d')}} - {{$post_request->seat}} seats needed</strong>
                            <hr>
                            <a href="{{url('request/edit',$post_request->id)}}" class="clr">Edit</a>
                            <hr>
                            <a href="{{url('request/delete',$post_request->id)}}" data-bs-toggle="modal" data-bs-target="#exampleModal12" class="clr">Delete</a>
                            <hr>
                          </div>
                          <div class="col-md-6">
                            <p><i>No matches or invitations, yet</i></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    @else
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                      <p class="mt-5">You have no requests set <a href="{{url('trip/request')}}" style="text-decoration:underline;"> Post a request</a>.</p>
                    </div>
                    @endif
                    @foreach($bookings_archive as $archive)
                     @php
                $user = DB::table('users')->where('id',$archive->applied_by)->first();
                @endphp
                    <div id="booking_archive" style="display:none;">
                     <hr>
                  <div class="box shadow-sm rounded bg-white mb-3" style="padding: 15px 0;">
                    <div class="box-body p-0">
                      <div class="row align-items-center">
                        <div class="col-sm-2">
                          <div id="nuser">
                            <img src="{{ url('public/'.$user->img) }}">
                          </div>
                        </div>
                        <div class="col-sm-8">
                          <p class="text-dark">Message from <b>{{ $user->name." ".$user->last_name }}</b><span class="badge badge-light" style="background:red;">new</span></p>
                          <p class="text-dark">Booking for : <b>{{ $archive->origin." to ". $archive->destination }}</b></p>
                          <p class="text-dark">Seats : <b>{{ $archive->seats }}</b></p>
                          <p class="text-dark">{{ $archive->message }}</p>
                        </div>
                        <div class="col-sm-2">
                          <button class="btn-success btn" style="opacity:0.6;"><i class="fa fa-check" aria-hidden="true"></i></button>

                        </div>
                      </div>
                      <div class="container" style="text-align: right">
                        <p>{{ $archive->created_at->diffForHumans() }}</p>
                      </div>
                    </div>
                  </div>
                  </div>
                  @endforeach

                    <div class="tab-pane fade" id="profile-tab-pane1" role="tabpanel" aria-labelledby="profile-tab1" tabindex="0">
                      <p class="mt-5"> No trips archive. <a href="{{url('trip/offer')}}" style="text-decoration:underline;">Post a trip</a>.</p>
                    </div>

                  </div>
                </div>
              </div>
        </section>
      </div>
    </div>
  </div>
</section>

@if($post_request != '')
<div class="modal fade class-cahnge-popup delete-popup" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('request-delete',$post_request->id)}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-sm-12" id="checkbox-id">
            <h4 class="" style="font-weight: 600;">{{$post_request->pickup_location}} to {{$post_request->drop_location}}</h4>
            <p style="font-weight: 400; font-size:16px;">{{\Carbon\Carbon::parse($post_request->leaving)->format('l , F d')}}</p>
            <br>
            <br>
            <h6>Are you Sure You want to Delete this request</h6>
          </div>
        </div>
        <div class="modal-footer border-0" id="modal-popup-there">
          <a href="" class="btn btn-secondary red" data-bs-dismiss="modal" aria-label="Close">NO</a>
          <button type="submit" class="btn btn-secondary green">YES</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $("#profile-tab").click(function() {
    $("#hide").hide();
    $("#booking_id").show();
    $("#booking_archive").hide();
  });
  $("#home-tab").click(function() {
    $("#hide").show();
    $("#booking_id").hide();
    $("#booking_archive").hide();
  });
  $("#profile-tab1").click(function() {
    $("booking_c").hide();
     $("#booking_archive").show();
  });
</script>
@endsection