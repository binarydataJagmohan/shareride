@extends('layouts.app')
@section('title','Payment Setting')
@section('content')
<style>
    .method_id .add-h{
        font-size: 32px;
        font-weight: 800;
        color: #000;
    }
    .method_id  p.text-medium{
        font-size:16px;
    }
</style>
<section>
    <div class="container py-sm-5">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col-md-8">
                <div class="method_id">
                    <h3 class="mb-3 add-h">Payout settings</h3>
                    <div class="s-spacer"></div>
                    <p class="text-medium">Want to get paid? Just add a payout method and you'll be well on your way!</p>
                </div>
                <div class="mt-4 mb-3 " id="booking-rigt">
                  <a href="{{url('payouts-method')}}">  <input type="button" value="Add a payout method" class="button darkgrey" id="trip-post-button"></a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection