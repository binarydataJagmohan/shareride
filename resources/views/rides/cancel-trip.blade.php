@extends('rides.layouts.app')
@section('title','Cancel Trip')
@section('content')
<section class="dash-details p-0">
    <div class="container">
        <div class="page-details" id="confirm">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="top mt-4">
                        <form method="post" action="{{url('confirm-trip',$cancel->id)}}">
                            @csrf
                        <div class="row" id="booking-new">
                            <div class="col-md-12">
                                <h2 class="pb-4">Confirm cancellation</h2>
                                <hr>
                                <h5>{{$cancel->origin}} to {{$cancel->destination}}</h5>
                                <i>{{\Carbon\Carbon::parse($cancel->start_date)->format('l , F d \a\t ')}} {{\Carbon\Carbon::parse($cancel->start_time)->format('H:i')}}</i><br>
                                <hr>
                                <br>
                                <strong>
                                    <h4>Please confirm the trip cancellation</h4>
                                    </p>
                                    <div class="form-check mt-4" id="cheak">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                        <label class="form-check-label m-0" for="flexCheckDefault">
                                            I confirm that I want to cancel this trip
                                        </label>
                                    </div>
                                    <div class="text-end mt-4">
                                        <input type="submit" value="Cancel trip" class="button darkgrey" submitted-value="Posting..." id="trip-post-button">
                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection