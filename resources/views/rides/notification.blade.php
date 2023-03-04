@extends('rides.layouts.app') @section('title','Notification') @section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 right">
            <h5><div class="box-title border-bottom p-3">
                    <h6 class="m-0">Notifications</h6>
                </div></h5>
            @foreach($notifications as $notification)
            @php 
                $user = DB::table('users')->where('id',$notification->notify_by)->first();
                $trip = DB::table('post_trips')->where('id',$notification->trip_id)->first();
                $origin = DB::table('cities')->where('id',$trip->origin)->first();
                $destination = DB::table('cities')->where('id',$trip->destination)->first();
                $booking = DB::table('bookings')->where('id',$notification->booking_id)->first();
               
             @endphp
             @if($notification->booking_id == null)
            <div class="box shadow-sm rounded bg-white mb-3" style="padding: 15px 0;">
                <div class="box-body p-0">
                    <div class="row align-items-center">
                        <div class="col-sm-2">
                            <img src="{{ url('public/'.$user->img) }}">
                        </div>
                        <div class="col-sm-8">
                            <p class="text-dark">Message from <b>{{ $user->name." ".$user->last_name }}</b><span class="badge badge-light" style="background:red;">new</span></p>
                            <p>{{ $notification->notification_desc }}</p>
                        </div>
                        <div class="col-sm-2">
                            <p>{{ $notification->created_at->diffForHumans() }}</p>
                            
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="box shadow-sm rounded bg-white mb-3" style=" padding: 15px 0;">
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
                            <p class="text-dark">{{ $notification->notification_desc }}</p>
                        </div>
                    </div>
                    <div class="container" style="text-align: right"><p>{{ $notification->created_at->diffForHumans() }}</p></div>
                </div>
            </div>
            @endif
            @endforeach
    </div>
</div>
</div>


@endsection