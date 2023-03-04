<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posting a trip - Instrcution </title>
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
  <div class="container">
    <div class="row mt-5">
        <h6 class="h6">Rules when posting a trip</h6>
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot3.png')}}" alt="">
              <h6>Be reliable</h6>
              <p>Only post a trip if you’re sure you’re driving and show up on time.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot1.png')}}" alt="">
              <h6>No cash</h6>
              <p>All passengers pay online and you receive a payout after the trip.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot2.png')}}" alt="">
              <h6>Drive safely</h6>
              <p>Stick to the speed limit and do not use your phone while driving.</p>
            </div>
          </div>
          <form method="" action="{{route('offer')}}">
          <div class="form-check mt-4" id="cheak">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required="">
            <label class="form-check-label" for="flexCheckDefault">
                I understand that <strong>my account could be suspended if I break these rules</strong>
            </label>
          </div>
        </div>
        <div class="hr mb-5 mt-5"></div>
        <div class="trip-submit-button button-loader">
          <input type="submit" value="Post trip" class="button darkgrey" submitted-value="Posting..." id="trip-post-button" >
      </div>
    </div>
  </section>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>