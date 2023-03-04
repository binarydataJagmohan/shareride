<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forget Password Email</title>
</head>

<body>
    <div class="container" id="Emailvarify" style="padding:0px 200px ;">
        <div class="d-flex justify-content-center">
            <div class="col-sm-6">
                <img src="{{url('public/images/logo1.png')}}" alt=""  width="200px">
                <!--<strong>-->
                <!--    <h3 class="mt-3 mb-3">Hi </h3>-->
                <!--</strong>-->
              <p>Please click <a href="{{ route('ResetPasswordGet', $token) }}">this link to reset your ShareRide password</a></p>
              <p>The ShareRide Team</p>
            </div>
        </div>
    </div>
    
</body>
</html>