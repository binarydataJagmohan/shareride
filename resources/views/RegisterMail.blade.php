<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email_varify</title>
</head>

<body>
    <div class="container" id="Emailvarify" style="padding:0px 200px ;">
        <div class="d-flex justify-content-center">
            <div class="col-sm-6">
                <img src="{{url('public/images/logo1.png')}}" alt="" width="200px">
                <h5 class="mt-4" style="color: #000;font-weight: 500;font-size: 23px;">hi {{ $data1["name"] }},</h5>
                <strong>
                    <h3 class="mt-3 mb-3">To verify your email, please click on the big orange button below.</h3>
                </strong>
                <a href="{{url('welcome/phone')}}"
                    style=" padding: 20px 40px 20px 40px;background: #ff5400;color: #fff;margin-bottom: 20px; font-weight: bold;text-decoration: none;clear: both;border-radius: 5px;font-size: 16px;display: inline-block;">Verify
                    your email</a>
            </div>
        </div>
    </div>
    
</body>
</html>