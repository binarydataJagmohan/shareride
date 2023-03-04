@extends('rides.layouts.app')
@section('title','My booking')
@section('content')
<style>
    



</style>

  <section class="dash-details">
        <div class="max-container">
        <div class="container">
            <div class="row mt-5 align-items-center">
                
      <h1>My Bookings</h1>
	         <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
	             @foreach($user_bookings as $ub)
                    <div class="top mt-4 ">
                      <div class="row" id="booking-new">
                        <div class="col-md-6">
                          <a href="">
                            <h5>{{$ub->origin}} to {{$ub->destination}}</h5>
                          </a>
                         
                          <strong>{{\Carbon\Carbon::parse($ub->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($ub->start_time)->format('H:i')}}</strong>
                          <hr>
                           <p><i>seats</i>&nbsp&nbsp<b>{{ $ub-> seats }}</b></p></b><br>
                          <p><i>Price</i>&nbsp&nbsp<b>${{ $ub->amount }}</b></b></p>
                          <p><i></i></p>
                          <hr>
                          @if($ub->status == 'approvered')
                          <a href="" class="clr btn btn-success">Booking Confirmed</a>
                          @elseif($ub->status == 'pending')
                          <a href="" class="clr btn btn-danger">Booking pending</a>
                          @else
                          <a href="" class="clr btn btn-secondary">Booking Cancelled</a>
                          <hr>
                          @endif
                        </div>
                        <div class="col-md-6">
                        
                         
                          
                          

                        </div>
                      </div>
                    </div>
                    @endforeach
                 </div>
            </div>
        </div>
    </div>
</section>


@endsection