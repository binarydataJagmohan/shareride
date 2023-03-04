<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking confirm</title>
</head>

<body>
    <div class="container" id="Emailvarify" style="padding:0px 200px ;">
        <div class="d-flex justify-content-center">
            <div class="col-sm-6">
                <img src="{{url('public/images/logo1.png')}}" alt="" width="200px">
                <h5 class="mt-4" style="color: #000;font-weight: 500;font-size: 23px;">Dear {{ $data1["name"] }},</h5>
                   <p>I am writing to confirm that your ride booking has been successfully processed and confirmed. Our driver will be picking you up at {{ $data1["origin"] }} to {{ $data1["destination"] }} , as requested.</p>
                   <p>You can expect our driver to arrive at the specified pickup location on time to take you to your destination. If you need to make any changes to your booking, such as pickup or drop-off location or time, please let us know as soon as possible, and we will do our best to accommodate your request.</p>
                   <p>If you have any questions or concerns regarding your booking, please do not hesitate to contact us. We are committed to providing you with a safe and comfortable ride experience, and we look forward to serving you.</p>
                   <p>Thank you for choosing our services. We appreciate your business and hope to serve you again in the future</p>
                   <p>Best regards</p>
            </div>
        </div>
    </div>
    
</body>
</html>