<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detials | ShareRide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('public/asset/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
</head>

<style>
    label.error{
        color:red;
        margin-right:50px;
    }
    div#site-logo img {
    width: 200px;
}
</style>

<body>
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
    <div class="container" id="phone-number">
        <form method="post" action="{{url('/save-details')}}" id="form-verify">
            @csrf
        <div class="text-center" id="phone">
            <h3>How will you use  Share-ride?</h3>
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-1 col-1 text-end">
                    <label class="switch">
                        <input type="checkbox" name="is_driver">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="col-sm-2 text-start">
                    <span>I will mostly drive</span>
                </div>
            </div>
            <div class="Email mt-4">
                <a href="#">Why we ask if you're a driver</a>
            </div>
            <hr class="wth">
            <div class="text-center birthday mt-5">
                <strong>Birthday</strong>
                <p>
                    You must be 18 years or older to use our service</p>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-4 d-flex slect">
                    <div class="col-sm-4 text-end" id="select-id">
                        <select class="form-select" name="month" id="month" aria-label="Default select example">
                            <option selected disabled>Month</option>
                            @for($i=1; $i<=12; $i++)
                              @php
                                  $month_name = date('F', mktime(0, 0, 0, $i, 10)); 
                                  $month = date('m', mktime(0, 0, 0, $i, 10));
                              @endphp
                                  <option value="{{$month}}">{{$month_name}}</option>
                              @endfor
                        </select>
                    </div>
                    <div class="col-sm-4 text-end" id="select-id">
                        <select class="form-select" name="day" id="day" aria-label="Default select example">
                            <option selected disabled>Day</option>
                              @foreach(range(1, 31) as $date)
                                <option value="{{$date}}">{{$date}}</option>
                              @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 text-end" id="select-id">
                        <select class="form-select" name="year" id="year" aria-label="Default select example">
                            <option selected disabled>Year</option>
                                  @foreach(range(1950, date('Y')) as $year)
                                    <option value="{{$year}}">{{$year}}</option>
                                  @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="Email mt-5">
                <a href="#">Why we ask for age</a>
            </div>
            <hr class="wth mt-5 mb-5">
            <div class="text-center birthday">
                <strong>Gender</strong>
                <p>
                    Our members feel safer knowing who they’re travelling with</p>
            </div>
            <div class="Email mt-4">
                <a href="#">Why we ask for age</a>
            </div>
            <div class="row justify-content-center mt-5" id="slect">
                <div class="col-md-2">
                    <div class="col-sm-12 text-end" id="select-id">
                        
                        <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                            <option selected disabled>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="Email mt-4 mb-5">
                <a href="#">Why we ask for age</a>
            </div>
            <div class="">
                <button type="submit" class="button darkgrey" id="trip-post-button">Next</button>
            </div>
            <hr class="wth">
            <div class="Email mt-4">
                <p>Need help getting set up? <a href="#">Contact us</a></p>
            </div>
        </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            
            $('#form-verify').validate({
            rules : {
                month : {
                required: true,
               },
               year : {
                required: true,
               },
               day : {
                required: true,
               },
               gender : {
                required: true,
               },
             },
             messages : {
                month : {
                    required:  "required!",
                },
                 day : {
                    required:  "required!",
                },
                 year : {
                    required:  "required!",
                },
                
                gender : {
                    required: "required!",
                }
             }
           });
        });
    </script>
</body>

</html>