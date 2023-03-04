<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms & Condition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

</head>
<style>
.img-box {
    border: 1px dotted black;
    border-radius: 50%;
    padding: 10px;
}

#form_btn {
    padding: 15px 70px;
    font-size: 16px;
    background-color: #333333;
    color: #ffffff;
    font-weight: 600;
    margin: 10px 0px 10px;
    clear: both;
    display: inline-block;
    /* text-align: center; */
    border: none;
    cursor: pointer;
    border-radius: 15px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

a.other_img {
    font-size: 12px;
    text-decoration: underline;
    color:#333333;
}
div#site-logo img {
    width: 200px;
}
.progress-bar {
    width: 100%;
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
    <div class="container" id="pages">
        <div class="text-center" id="phone">
            <h3>Poparide Community Agreement</h3>
            <P class="mt-3" style="color:#33333;">Three simple rules to ensure everyone has a positive experience</P>
            <div class="row mt-1 justify-content-center">
                <div class="col-sm-10 mt-1">
                    <div class="container">
    <div class="row mt-5">
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot3.png')}}" alt="">
              <h6>No cash</h6>
              <p>All payments happen online</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot1.png')}}" alt="">
              <h6>Respond quickly</h6>
              <p>To drivers and passengers</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="rules">
              <img src="{{asset('public/images/Screenshot2.png')}}" alt="">
              <h6>Be on time</h6>
              <p>Like when you catch a bus</p>
            </div>
          </div>
          <form method="post" action="{{url('toc')}}">
              @csrf
          <div class="form-check mt-4" id="cheak">
            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" required name="toc">
            <label class="form-check-label" for="flexCheckDefault">I understand that <strong>my account could be suspended if I break these rules</strong>
            </label>
          </div>
        </div>
        <div class="hr mb-5 mt-5"></div>
        <div class="trip-submit-button button-loader">
          <input type="submit" value="Submit" id="form_btn" class="button darkgrey" submitted-value="Posting..." id="trip-post-button" >
      </div>
      </form>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.js" integrity="sha256-DKU1CmJ8kBuEwumaLuh9Tl/6ZB6jzGOBV/5YpNE2BWc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput-jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    
    
    
      document.getElementById("upload-image").addEventListener("click", function () {
             document.getElementById("file_input").click();
            });
            
    $(document).ready(function () {
        $(".other_img").click(function(){
            document.getElementById("file_input").click();
        })
        
        $("#file_input").change(function(){
            $(".btn_group_1").removeClass('d-none');
            // $("#profile_form").removeClass('d-none');
            const file = this.files[0];
                if (file) {
                  let reader = new FileReader();
                  reader.onload = function(event) {
                    $("#preview_photo").removeAttr("src");
                    $("#preview_photo").attr("src", event.target.result);
                  };
                  reader.readAsDataURL(file);
                }
        })
       
        
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