@extends('layouts.app')
@section('title','Payment Setting')
@section('content')
<style>
    #stripe-elements-input {
        padding: 15px;
        box-sizing: border-box;
        max-width: 420px;
        background: #ececec;
        border-radius: 15px;
        border: none;
        color: #565a5c;
    }

    .credit-card-form .form-row {
        position: relative;
    }

    .error {
        color: red;
    }

    .text-slarge {
        font-size: 18px;
        line-height: 26px;
    }

    .s-spacer {
        height: 20px;
        clear: both;
    }

    .payment_mothod {
        display: none;
    }

    .payment_mothod .add-h {
        font-size: 32px;
        font-weight: 800;
        color: #000;
    }
    .method_id .add-h{
        font-size: 32px;
        font-weight: 800;
        color: #000;
    }
    .payment_mothod .text-slarge a {
    color: #000;
    text-decoration: underline;
}
</style>
<section>
    <div class="container py-sm-5">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col-md-8">
                <div class="method_id">
                    <h3 class="mb-3 add-h">Payment method</h3>
                    <div class="s-spacer"></div>
                    <p class="text-slarge">You don't have any payment methods set up yet.</p>
                </div>
                <form method="post" action="{{url('payment-store')}}" id="payment">
                    @csrf
                    <div class="payment_mothod">
                        <h3 class="mb-3 add-h">Add payment method</h3>
                        <div class="s-spacer"></div>
                        <div class="text-slarge">
                            <a href="{{url('payment-setting')}}" class="link-grey underline">Payment methods</a> &gt; Add payment method
                        </div>
                        <!-- <div class="hr mb-3"></div> -->
                        <div class="col-md-6 text-start slect-change">
                            <label for="" class="mb-3 mt-3">Name on card</label>
                            <input class="form-control" name="cardholder_name" id="cardholder_name" placeholder="Enter card name" size='4' value="{{Auth::user()->cardholder_name ?? ''}}" required>
                            <span class="text-danger d-none" id="error_span_1"></span>
                        </div>
                        <label for="" class="mb-3 mt-3">Card details</label>
                        <div class="card-stye mt-3 mb-3">
                            <input id="card_number" type="number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" size='20' style="width: 200px;background: transparent;border: none;" value="{{Auth::user()->card_number ?? ''}}" required>
                            <input id="exp_month" type="text" name="exp_month" placeholder="MM" size='2' style="width: 200px;background: transparent;border: none;" value="{{Auth::user()->exp_month ?? ''}}" required>
                            <input id="exp_year" type="text" name="exp_year" placeholder="MM/YY" size='4' style="width: 200px;background: transparent;border: none;" value="{{Auth::user()->exp_year ?? ''}}" required>
                            <input id="cvc" name="cvc" size='4' type="number" placeholder="CVC" style="width: 130px;background: transparent;border: none;color:#565a5c;" required>
                        </div>
                        <span class="text-danger d-none" id="error_span_3"></span>
                        <div class="mt-4 mb-3 " id="booking-rigt">
                            <input type="submit" value="Add payment method" class="button darkgrey" id="trip-post-button1">
                        </div>
                    </div>
                </form>
                <div class="mt-4 mb-3 " id="booking-rigt">
                    <input type="button" value="Add payment method" class="button darkgrey" id="trip-post-button">
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#trip-post-button').click(function() {
            $('.payment_mothod').show();
            $('#trip-post-button').hide();
            $('.method_id').hide();
        });
    });
</script>
@endsection