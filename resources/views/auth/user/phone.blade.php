<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Phone Verify | ShareRide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">
    <link rel="shortcut icon" href="{{url('public/images/fav.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
</head>
<style>
/*button.phonebtn {*/
/*    background: #333333;*/
/*    color: #fff;*/
/*    padding: 5px 19px 5px 30px;*/
/*    font-size: 16px;*/
/*    width: 100%;*/
/*    font-weight: 600;*/
/*    margin: 10px 0px 10px;*/
/*    margin-top: 0;*/
/*    clear: both;*/
/*    display: inline-block;*/
/*    text-align: center;*/
/*    cursor: pointer;*/
/*    border-radius: 15px;*/
/*    box-sizing: border-box;*/
/*}*/

label#mobile_code-error {
    color: red;
    margin-right: 106px;
    /* margin-top: 0; */
}
</style>
<body>
<!--    @if(Session::has('success'))-->
<!--    <div class="alert alert-success">-->
<!--        {{Session::get('success')}}-->
<!--    </div>-->
<!--@endif-->

<!--@if(Session::has('error'))-->
<!--    <div class="alert alert-danger">-->
<!--        {{Session::get('error')}}-->
<!--    </div>-->
<!--@endif-->
    <div class="email">
        <div class="container-fluid p-3" id="paclass">
            <div class="row align-items-center">
                <div class="col-sm-4 col-4">
                    <div class="logo" id="site-logo">
                        <img src="{{url('public/images/logo1.png')}}" alt="">
                    </div>
                </div>
                <div class="col-sm-6 col-6">
                    <div class="row">
                        <div class="col-sm-2">
                            <h6>Progress</h6>
                        </div>
                        <div class="col-sm-6">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 text-end col-2">
                    <div>
                        <a class="Quik" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Exit</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="container" id="pages">
        <div class="text-center" id="phone">
            <h3>Phone verification</h3>
            <p>Please enter your phone number with a valid country code</p>
            <form method="post" action="{{url('/save-phone')}}" id="phone_form">
                @csrf
            <div class="row justify-content-center mt-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="number" id="mobile_code" class="form-control" placeholder="Phone Number" name="mobile_no">
                        @if ($errors->has('mobile_no'))
                            <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                       <button type="submit" class="phonebtn">Send code</button>
                    </div>
                </div>
            </div>
            </form>
            <div class="Email mt-4">
                <a href="#">Why we verify your email</a>
            </div>
            <hr class="wth">
            <div class="contact-a">
                <p>Need help getting set up? <a href="#">Contact us </a></p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput-jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    $(document).ready(function () {
        $("#mobile_code").intlTelInput({
            initialCountry: "in",
            separateDialCode: true,
        });

    $('#phone_form').validate({ // initialize the plugin
        rules: {
            mobile_no: {
                required: true,
                integer: true,
                maxWords:13
            },
        }
    });

});
</script>
    
</body>

</html>