<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Going somewhere | Shere Ride</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><link rel="stylesheet" href="{{url('public/css/style.css')}}">
    <link rel="stylesheet" href="{{url('public/rides/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>

<header class="main-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
        <a href="#" class="main-logo"><img src="{{url('public/images/logo1.png')}}" alt="logo"></a>
      </div>
    </div>
  </div>
</header>
    <section class="dash-details">
        <div class="max-container">
        <div class="container">
            <div class="row mt-5 align-items-center">
                <h6 class="h6 mb-5 mt-5"><i>Howdy! What are you looking to do today?</i></h6>
               <a href="{{route('instruction')}}"> <div class="row align-items-center pt-4 pb-5" id="hoverdiv">
                    <div class="col-md-2 col-2">
                        <div class="rules">
                            <img src="{{url('public/images/car.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-9 col-9 text-lg-start text-center">
                        <h6 class="h6">I'm driving</h6>
                        <p>I want to fill empty seats in my car</p>
                    </div>
                    <div class="col-sm-1 col-1">
                        <img src="{{asset('public/images/icon-triangle-grey-right.11ca7a45b10e.png')}}" alt="">
                    </div>
                </div></a>
                <hr>
                <a href="{{route('request')}}"><div class="row align-items-center pt-4 pb-5" id="hoverdiv">
                    <div class="col-md-2 col-2">
                        <div class="rules">
                            <img src="{{asset('public/images/bull.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-9 col-9 text-lg-start text-center">
                        <h6 class="h6">I need a ride</h6>
                        <p>Notify me when a ride is available</p>
                    </div>
                    <div class="col-sm-1 col-1">
                        <img src="{{asset('public/images/icon-triangle-grey-right.11ca7a45b10e.png')}}" alt="">
                    </div>
                </div></a>
            </div>
        </div>
    </div>

    </section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>


    
