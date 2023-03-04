<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verify | ShareRide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">
    <link rel="shortcut icon" href="{{url('public/images/fav.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
       .info-msg{
        border: 1px solid #ffcc00;
        background: #fbffcb;
        padding: 10px 0px;
        border-left: none;
        border-right: none;
        border-top: none;
        margin:0px;
       }
    </style>
</head>

<body>
    <div class="info-msg">
    @if(Session::has('success'))
    <div class="container">
        {{Session::get('success')}}
    </div>
    </div>
@endif
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
        <div class="text-center">
            <h3>Verify your email by clicking on the link we sent to {{ $email }}</h3>
            <div class="sndmail">
                <img src="images/icon-email-welcome.b05cd4020974.png" alt="">
            </div>
            <h6 class="mt-3">Please check your spam or junk folders</h6>
            <div class="Email mt-4">
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal1">Why we verify your email</a>
            </div>
            <br><br>
            <hr class="wth">
            <div class="conform">
                <strong>
                    <p class="mb-3">Didn't get our confirmation email?</p>
                </strong>
                <a href="javascript:void(0)" class="mb-5">Request another confirmation email</a>
                <p class="pcolor">We sent a confirmation email to you recently, please wait 3 minutes before resending.
                </p>
                <br>
                <br>
                <a href="javascript:void(0)" class="mt-3" id="show-hidden-menu">Use a different email address</a>
                <div class="hidden-menu" style="display: none;">
                    <form method="post" action="{{url('verify-email')}}">
                        @csrf
                        <input type="text" name="email" id="input_name" placeholder="Enter Email Address" class="mt-3">
                        <div>
                            <button class="btn mt-4" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <hr class="wth">
            <br>
            <hr class="wth">
            <div class="contact-a">
                <p>Need help getting set up? <a href="#">Contact us </a></p>
            </div>
        </div>
    </div>


    <div class="modal fade modelcahnge1" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Why we verify your email</span>
                    <h6 class="mt-3 mb-3">Passengers are instantly booked on your trip</h6>
                    <p>When you organize trips on  Share-ride, we send you an email notification to let you know if someone has messaged you. By verifying your email address, we make sure you receive our notifications and can communicate with other members.</p>
                    <div class="mt-5">
                        <a href="javascript:void()" class="popup-onebtn1" data-bs-dismiss="modal" aria-label="Close">Got it</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#show-hidden-menu').click(function() {
                $('.hidden-menu').slideToggle("slow");
            });

        });
    </script>
</body>


</html>