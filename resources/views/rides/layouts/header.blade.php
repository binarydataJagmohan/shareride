<style>
a.main-logo {
    margin-top: 0px;
    width: 200px;
}
li#bell-id {
    position: absolute;
    top: 15%;
    left: -16%;
}
li#bell-id .ul-width {
    width: 400px;
    text-align: left;
    display: block;
    border-radius: 15px;
    border: 1px solid #dfdbdb;
    z-index: 1001;
    margin-top: 42px;
    background-color: #fff;
    position: relative;
   
}
ul.ul-width li {
    display: block !important;
    text-align: left;
    display: block;
}
ul.ul-width li a {
    text-decoration: underline;
}
.ul-width:before, .ul-width:after {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    border-style: solid;
    border-color: transparent;
    border-top: 0;
}
.ul-width:before {
    top: -16px;
    left: 5%;
    border-bottom-color: #dfdbdb;
    border-width: 16px;
}
.ul-width:after {
    bottom: 0px;
    left: 12px;
    border-bottom-color: #fff;
    border-width: 15px;
}
/*ul.link-menu.position-relative {*/
/*    margin-left: 120px;*/
/*}*/
li.bell img {
    width: 25px;
    margin-top: 20px;
}
span.position-absolute.top-0.start-100.translate-middle.badge.rounded-pill.bg-danger {
    margin-top: 27px;
    margin-left: -21px;
}

.notification-ui a:after {
    display: none;
}

.notification-ui_icon {
    position: relative;
}

.notification-ui_icon .unread-notification {
    display: inline-block;
    height: 7px;
    width: 7px;
    border-radius: 7px;
    background-color: #66BB6A;
    position: absolute;
    top: 7px;
    left: 12px;
}
ul.link-menu.position-relative {
    margin-top: -13px;
}

@media (min-width: 900px) {
    .notification-ui_icon .unread-notification {
        left: 20px;
    }
}

.notification-ui_dd {
    padding: 0;
    border-radius: 10px;
    -webkit-box-shadow: 0 5px 20px -3px rgba(0, 0, 0, 0.16);
    box-shadow: 0 5px 20px -3px rgba(0, 0, 0, 0.16);
    border: 0;
    max-width: 400px;
}

@media (min-width: 900px) {
    .notification-ui_dd {
        min-width: 400px;
        position: absolute;
        left: -192px;
        top: 70px;
    }
}

.notification-ui_dd:after {
    content: "";
    position: absolute;
    top: -30px;
    left: calc(50% - 7px);
    border-top: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 15px solid #fff;
    border-left: 15px solid transparent;
}

.notification-ui_dd .notification-ui_dd-header {
    border-bottom: 1px solid #ddd;
    padding: 15px;
}

.notification-ui_dd .notification-ui_dd-header h3 {
    margin-bottom: 0;
}

.notification-ui_dd .notification-ui_dd-content {
    max-height: 500px;
    overflow: auto;
}

.notification-list {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
        align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 20px 0;
    margin: 0 25px;
    border-bottom: 1px solid #ddd;
}

.notification-list--unread {
    position: relative;
}

.notification-list--unread:before {
    content: "";
    position: absolute;
    top: 0;
    left: -25px;
    height: calc(100% + 1px);
    border-left: 2px solid #29B6F6;
}

.notification-list .notification-list_img img {
    height: 48px;
    width: 48px;
    border-radius: 50px;
    margin-right: 20px;
}

.notification-list .notification-list_detail p {
    margin-bottom: 5px;
    line-height: 1.2;
}

.notification-list .notification-list_feature-img img {
    height: 48px;
    width: 48px;
    border-radius: 5px;
    margin-left: 20px;
}






</style>
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
@endif
<header class="main-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2 col-6">
        <a href="{{url('dashboard')}}" class="main-logo"><img src="{{url('public/images/logo1.png')}}" alt="logo"></a>
      </div>
      <div class="col-sm-10 col-6">
        <div class="menu-part">
          <div class="row">
            <div class="col-sm-6 text-align-left d-none d-lg-inline position-relative"  id="id-right">
              <ul class="link-menu top-sp hide-mobile">
                <li class="list-group-item {{ (request()->is('dashboard')) ? 'active' : '' }}"><a href="{{route('dash')}}">Dashboard</a></li>
                <li class="list-group-item {{ (request()->is('trips')) ? 'active' : '' }}"><a href="{{url('request-trip')}}">Trips</a></li>
                <li class="list-group-item {{ (request()->is('help/start')) ? 'active' : '' }}"><a href="{{route('help')}}">Help</a></li>
                <li class="list-group-item {{ (request()->is('my_booking')) ? 'active' : '' }}"><a href="{{route('my_booking')}}">My Booking</a></li>
              </ul>
            </div>
            <div class="col-lg-6 col-md-12 text-align-right " id="ball_right">
                
              <ul class="link-menu position-relative">
                @php
                    $notification = DB::table('notifications')->where('notify_to',Auth::user()->id)->where('status','unseen')->count();
                @endphp
                <li class="bell  hide-mobile d-none d-lg-inline" id="bell-id"><a href="#"><img src="{{url('public/images/bell.png')}}" alt="bell"><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ $notification }}
                  <span class="visually-hidden">unread messages</span></a>
                   @php
                    $notifi = DB::table('notifications')->where('notify_to',Auth::user()->id)->latest()->take(3)->get();
                   @endphp
                  
                     </a><ul class="ul-width">
                   @if ($notifi->count() > 0)
                   @foreach($notifi as $notifis)
                   @php 
                   $user = DB::table('users')->where('id',$notifis->notify_by)->first();
                   $post_trip = DB::table('post_trips')->first();
                   $vm = DB::table('vehicle_models')->where('id',$post_trip->vehicle_id)->where('status','=','active')->first();
                   $booking = DB::table('bookings')->where('id',$notifis->booking_id)->first();
                   $data = \Carbon\Carbon::parse($notifis->created_at);
                   @endphp
                           
                            <a href="{{ url('notification') }}"><div class="notification-ui_dd-content">
                                 @if($notifis->notification_type == 'Booking')
                                <div class="notification-list notification-list--unread">
                                    <div class="notification-list_img">
                                        <img src="{{ url('public/'.$user->img) }}" alt="user">
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b>{{ $user->name." ".$user->last_name }}</b>&nbspWants to Book Your Cab</p>
                                        <p><small> {{$data->diffForHumans()}}</small></p>
                                    </div>
                                    <div class="notification-list_feature-img">
                                       
                                    </div>
                                </div>
                               @elseif($notifis->notification_type == 'confirmation')
                               <div class="notification-list notification-list--unread">
                                    <div class="notification-list_img">
                                        <img src="{{ url('public/'.$user->img) }}" alt="user">
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b>{{ $user->name." ".$user->last_name }}</b>&nbspHas Approved</p>
                                        <p><small>{{$data->diffForHumans()}}</small></p>
                                    </div>
                                    <div class="notification-list_feature-img">
                                       
                                    </div>
                                </div>
                               @else
                                <div class="notification-list notification-list--unread">
                                    <div class="notification-list_img">
                                        <img src="{{ url('public/'.$user->img) }}" alt="user">
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b>{{ $user->name." ".$user->last_name }}</b>&nbspHas Cancelled</p>
                                        <p><small>{{$data->diffForHumans()}}</small></p>
                                    </div>
                                    <div class="notification-list_feature-img">
                                       
                                    </div>
                                </div>
                                @endif
                            </div></a>
                            @endforeach
                     @else
                      <li class="border-bottom">No Notification Yet!!</li>
                      @endif
                      <li class="border-bottom text-center"><a href="{{ url('notification') }}">View all notifications</a></li>
                     </ul></a>
                     
                  </li>
                 
                <li class="user  hide-mobile d-none d-lg-inline">
                    <a href="{{ route( 'account')}}">
                @if(Auth::user()->img != '')
                <img src="{{asset('public/'.Auth::user()->img)}}" alt="user">
                @else
                <img src="{{asset('public/upload/no.jpg')}}" alt="user">
                @endif
                    <!--<img src="{{url('public/images/user.jpg')}}" alt="user">-->
                </a>
                </li>
                <li class="btn-li  hide-mobile d-none d-lg-inline"><a href="{{route('find')}}"><i class="fa-solid fa-magnifying-glass "></i> Find</a></li>
                <li class="btn-li  hide-mobile d-none d-lg-inline"><a href="{{route('choose')}}"><i class="fa-solid fa-plus"></i> Post</a></li>
                <li class="bar"><a href="#"><i class="fa-solid fa-bars" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i></a>

                  <!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button> -->
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">

                    </div>
                    <div class="offcanvas-body" id="menu-block">
                      <div class="pro" id="body-offcanvas">
                        <button type="button" class="btn-closes text-reset" data-bs-dismiss="offcanvas" aria-label="Close">Close menu</button>
                        <ul class="offcanvas-menu-link">
                          <li><a href="{{route('account')}}" class="b-line">Profile settings</a></li>
                          <li><a href="{{route('notification')}}" class="b-line">Notifications</a></li>
                          <li><a href="{{route('security')}}" class="b-line">Security</a></li>
                          <li><a href="{{route('verification')}}">ID verification</a></li>
                          <li><a href="{{route('payment')}}" class="b-line">Payments</a></li>
                          <li><a href="{{route('payout')}}">Payouts</a></li>
                          <li><a href="{{route('help')}}" class="b-line">Help</a></li>
                          <li><a href="#" class="b-line">Cool stuff</a></li>
                          <li><a href="#">Students</a></li>
                          <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                            </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>