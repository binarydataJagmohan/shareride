@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@extends('rides.layouts.app')
@section('title','Dashboard')
@section('content')
<style>
  #body-offcanvas {
    max-width: 90%;
    margin: 0 auto;
    width: 100%;
  }
  img#res-image{
      width:120px !important;
      height:120px !important;
  }
</style>

<section>
  <div class="container p-lg-5 p-2" id="deshboard">
    <div class="row">
      <div class="col-sm-2">
         <a href="{{asset('account')}}">
        @if(Auth::user()->img != null || '')
        <img src="{{asset('public/'.Auth::user()->img)}}" alt="" class="img-responsive img-circle" id="res-image">
        @else
        <img src="{{asset('public/upload/no.jpg')}}" alt="" class="img-responsive img-circle" id="res-image">
        @endif
        </a>
      </div>
      <div class="col-sm-10" id="desh-two1">
        <div class="text-dash">
          <h1>Hi {{ Auth::user()->name }},</h1>
          <h6 class="m-0">Welcome to Shareride!</h6>
        </div>
        <!--<div class="row">-->
        <!--  <div class="col-sm-3">-->
        <!--    <div class="mt-5 d-none d-md-block">-->
        <!--      <img style="width: unset;" src="https://cdn.poparide.com/static/pop/webui/common/images/stats/km_shared.a41f811cf5df.svg" alt="" class="img-responsive">-->
        <!--      <span>No km shared, yet</span>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="col-sm-3">-->
        <!--    <div class="mt-5 d-none d-md-block">-->
        <!--      <img style="width: unset;" src="https://cdn.poparide.com/static/pop/webui/common/images/stats/rides_taken.f3d74a40610f.svg" alt="" class="img-responsive">-->
        <!--      <span>No activity, yet</span>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
      </div>
    </div>
    <!--<div class="row">-->
    <!--  <div class="col-sm-2">-->
    <!--  </div>-->
    <!--  <div class="col-sm-10">-->
    <!--    <div class="mt-4" id="btndegin">-->
    <!--      <a href="" class="button darkgrey" id="trip-post-button" data-bs-toggle="offcanvas" data-bs-target="#getstrated" aria-controls="getstrated">Get started</a>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
  </div>
  <div class="offcanvas offcanvas-end" tabindex="-1" id="getstrated" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
    </div>
    <div class="offcanvas-body">
      <div class="pro" id="body-offcanvas">
        <button type="button" class="btn-closes text-reset" data-bs-dismiss="offcanvas" aria-label="Close">Close menu</button>
        <h5>Hey {{auth::user()->name}}, what are you looking to do today?</h5>
        <ul class="offcanvas-menu-link">
          <li><a href="{{url('trip/instruction')}}" class="b-line">Post a trip as a driver</a></li>
          <li><a href="{{url('find')}}" class="b-line">Find a trip as a passenger</a></li>
          <li><a href="#" class="b-line">Follow us on Instagram</a></li>
          <li><a href="#" class="b-line">Follow us on TikTok</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<div class="container" id="dash-post">
  <nav class="dashboard">
    <div class="nav mb-3" id="nav-tab" role="tablist">
      <button class="nav-link " id="nav-profile-tab1" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Trips ({{(count($bookings))}})</button>
      <button class="nav-link active" id="nav-home-tab1" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Your requests ({{(count($requests))}})</button>

    </div>
  </nav>
  <div class="tab-content p-3 border-tabs" id="nav-tabContent">
    <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      @if(count($requests) > 0)
      @foreach($requests as $arr)
      <div class="row align-items-center">
        <div class="col-md-1">
          <div class="left-text" id="redius-img">
            @if(Auth::user()->img != '')
            <img src="{{asset('public/'.Auth::user()->img)}}" alt="">
            @else
            <img src="{{asset('public/upload/no.jpg')}}" alt="" class="img-responsive img-circle">
            @endif
            <!--<div class="sub-cricle"></div>-->
          </div>
        </div>
        <div class="col-sm-6">
          <div class="text-post clr">
            <a href="{{url('request-view',$arr->id)}}">
              <h6 class="clr">{{$arr->pickup_location}} to {{$arr->drop_location}}</h6>
            </a>
            {{-- <p>{{$arr->leaving}}</p> --}}
            <strong>{{\Carbon\Carbon::parse($arr->leaving)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($arr->leaving)->format('H:i')}}</strong>
            <!--<p>Tuesday, February 7 at 9:15am</p>-->
          </div>
        </div>
        <div class="col-sm-3">
          <div class="text-center-div">
            <p><strong>{{$arr->seat}} seats Needed</strong> • </p>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <p>No Request Have been published by you</p>
      @endif
    </div>

    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

      @if(count($bookings) > 0)
      @foreach($bookings as $arr)
      @if ($loop->index > 2)
      <div class="trips_li" style="display: none;">
        @endif
        <a href="{{route('tripdetail',$arr->id)}}">
          <div class="row align-items-center">
            <div class="col-md-1">
              <div class="left-text" id="redius-img">
                @if(Auth::user()->img != '')
                <img src="{{asset('public/'.Auth::user()->img)}}" alt="" class="img-responsive img-circle">
                @else
                <img src="{{asset('public/upload/no.jpg')}}" alt="" class="img-responsive img-circle">
                @endif
                <!--<img src="{{asset('public/images/1.jpg')}}" alt="">-->
              </div>
            </div>
            <div class="col-sm-6">
              <div class="text-post clr">
                @php
                $origin = DB::table('cities')->where('id',$arr->origin)->first();
                $destination = DB::table('cities')->where('id',$arr->destination)->first();
                @endphp
                <h6>{{$arr->origin}} to {{$arr->destination}}</h6>
                {{-- <p>{{$arr->start_date}} at {{$arr->start_time}}</p> --}}
                <strong>{{\Carbon\Carbon::parse($arr->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($arr->start_time)->format('H:i')}}</strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="text-center-div">
                <p><strong>{{$arr->seats}} seats</strong>- ${{$arr->pricing}} each</p>
              </div>
            </div>
          </div>
        </a>
        @if ($loop->index > 2)
      </div>
      @endif
      @if ($loop->index > 2)
      @if($loop->last)
      <hr>
      <p><a id="view_all_trips" style="text-decoration: underline; cursor: pointer; color:rgba(29, 29, 145, 0.664);">View more</a></p>
      @endif
      @endif
      @endforeach
      @else
      <p>No booking Have been published by user</p>
      @endif
    </div>
  </div>
</div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  $("#view_all_trips").click(function() {
    $(".trips_li").slideToggle();
  })
</script>

@endsection