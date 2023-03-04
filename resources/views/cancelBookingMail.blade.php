<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Cancel</title>
</head>

<body>
    <div class="container" id="Emailvarify" style="padding:0px 200px ;">
        <div class="d-flex justify-content-center">
            <div class="col-sm-6">
                <img src="{{url('public/images/logo1.png')}}" alt="" width="200px">
                <h5 class="mt-4" style="color: #000;font-weight: 500;font-size: 23px;">Dear {{ $data1["name"] }},</h5>
                   <p>We are sorry to inform you that your booking on our ShareRide app has been cancelled.</p>
                   <strong>Details of your cancelled ride are as follows:</strong>
                   <p>Pick-up Location: {{ $data1["origin"] }} </p>
                   <p>Drop-off Location: {{ $data1["destination"] }}</p>
                   <p></p>
                   <p></p>
                   <p>If you have any questions or concerns, please do not hesitate to contact our customer support team. They are available 24/7 to assist you.</p>
                   <p>If you have any questions or concerns regarding your booking, please do not hesitate to contact us. We are committed to providing you with a safe and comfortable ride experience, and we look forward to serving you.</p>
                   <p>Thank you for considering our ShareRide  for your transportation needs, and we hope to have the opportunity to serve you in the future.</p>
                   <p>Best regards</p>
                   <p>ShareRide Team</p>
            </div>
        </div>
    </div>
    
</body>
</html>