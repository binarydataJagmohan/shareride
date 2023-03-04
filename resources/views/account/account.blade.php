@extends('rides.layouts.app')
@section('title','Account')
@section('content')
<style>
    img#preview_photo {
    width: 120px !important;
     height: 120px !important;
    border-radius: 100px !important;
    margin-top: -54px;
}
#upload-image{
    position:relative;
}
#upload-image i.fas.fa-image{
    position: absolute;
    left: 21%;
    top: 12%;
    color: black;
    display: block !important;
}
    input#first_acc {
    padding: 20px 15px 20px 20px;

}
    input#last_acc {
    padding: 20px 15px 20px 20px;

}
</style>
<section class="dash-details">
    
  <div class="container">
    <div class="row">
      @include('account.sidebar')
      <div class="col-sm-9">
        <div class="page-details">
          <h1>Personal details</h1><br>
           <div class="detaill">
               <div class="row">
                   <div class="col-md-8">
                        <p>Phone number</p><br>
                        <p>{{ $user->mobile_no ?? "not registered" }} <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration:underline ;"> Change</a> </p>
                   </div>
                   <div class="col-md-4">
                       <div class="update_img" id="upload-image">
                           @if(Auth::user()->img != null || "")
                            <img class="w-100" style=" border-radius: 20%; cursor: pointer;" id="preview_photo" src="{{ url('public/'.Auth::user()->img) }}" title="Upload Image">
                            @else
                            <img class="w-100  img-box" style=" border-radius: 50%; cursor: pointer;" id="preview_photo" src="{{ url('public/images/img-place-2.png') }}">
                            @endif
                         
                            <i class="fas fa-image" style="display: none;"></i>
                           
                             <form method="post" id="profile_form" enctype="multipart/form-data" action="{{ url('profile-upload') }}">
                                 @csrf
                            <input type="file" class="d-none" name="profile_photo" id="file_input"/>
                            
                          </form>
                        </div>
                   </div>
               </div>
          </div>
          <hr class="hr-line">
           <form method="post" action="{{ url('update-account') }}" id="accform">
            @csrf
           <div class="col-md-4 position-relative location">
            <label for="">First Name</label>
            
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="" data-bs-toggle="modal"
              data-bs-target="#exampleModal4" id="first_acc" required maxlength="21">
              <div id="error-message" style="color: red;"></div>
          </div>
          <div class="col-md-4 position-relative location">
            <label for="">Last Name</label>
            <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" placeholder="" data-bs-toggle="modal"
              data-bs-target="#exampleModal4" id="last_acc"  required maxlength="21">
              <div id="error-message1" style="color: red;"></div>
          </div>
          @php
            $dob_month = $newDate = date('m', strtotime($user->dob));
            $dob_date = $newDate = date('d', strtotime($user->dob));
            $dob_year = $newDate = date('Y', strtotime($user->dob));
          @endphp
          <div class="row" id="selectclass">
            <label for="">Date of birth</label>
            <div class="col-sm-2">
                <select class="form-select" name="dob_month" aria-label="Default select example">
                  <option selected disabled>Select Month</option>
                   
                      @for($i=1; $i<=12; $i++)
                      @php
                          $month_name = date('F', mktime(0, 0, 0, $i, 10)); 
                          $month = date('m', mktime(0, 0, 0, $i, 10));
                          @endphp
                          <option value="{{$month}}" <?php if($dob_month == $month) { echo "selected"; } ?>>{{$month_name}}</option>
                      @endfor
                </select>
              </div>
              <div class="col-sm-2">
                <select class="form-select" name="dob_date" aria-label="Default select example">
                  <option selected disabled>Select Date</option>
                  @foreach(range(1, 31) as $date)
                    <option value="{{$date}}" <?php if($dob_date == $date) { echo "selected"; } ?>>{{$date}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-2">
                <select class="form-select" name="dob_year" aria-label="Default select example">
                  <option selected>Select Year</option>
                  @foreach(range(1950, date('Y')) as $year)
                    <option value="{{$year}}" <?php if($dob_year == $year) { echo "selected"; } ?>>{{$year}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="col-sm-10">
            <label for="">Description</label>
            <div class="form-floating">
              <textarea class="form-control"  name="description" placeholder="Leave a comment here" id="floatingTextarea" maxlength="100">{{ $user->description }}</textarea>
              <div id="error-message2" style="color: red;"></div>
            </div>
          </div>
          <div class="row" id="selectclass">
            <div class="col-sm-2">
                <select class="form-select" name="gender" aria-label="Default select example">
                  <option disabled selected>Select gender</option>
                  <option value="male" <?php if($user->gender == "male") { echo "selected"; } ?>>Male</option>
                  <option value="female" <?php if($user->gender == "female") { echo "selected"; } ?>>Female</option>
                  <option value="other" <?php if($user->gender == "other") { echo "selected"; } ?>>Others</option>
                </select>
              </div>
          </div>
           <div class="row mt-5">
             <div class="col-sm-2">
              <span>I'm a driver</span>
              <label class="switch">
                <input type="checkbox" name="is_driver" value="1" <?php if ($user->is_driver == true) { echo "checked"; } ?>>
                <span class="slider round"></span>
              </label>
             </div>
           </div>
           <div class="mt-5">
            <button type="submit" class="button darkgrey" id="trip-post-button">Update profile</button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change your phone number
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="{{url('update-phone')}}">
          @csrf
      <div class="modal-body" style="padding: 18px;" id="accform">
        <p>Please enter your phone number with a valid country code</p>
        <div class="row mt-5 mb-5">
          <div class="col-sm-6">
            <input type="number" name="number" value="{{ $user->mobile_no ?? "" }}" class="form-control" placeholder="3655646565846" id="number" onKeyPress="if(this.value.length==21) return false;">
              <div id="error-message4" style="color: red;"></div>
          </div>
          <div class="col-sm-6">
            <button type="submit" class="button darkgrey" id="trip-post-button" style="margin-top: 0px;">Update</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
  
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
      document.getElementById("upload-image").addEventListener("click", function () {
             document.getElementById("file_input").click();
            });
            
    $(document).ready(function () {
        $('#number').on('input', function(){
            var number = $('#number').val();
            if(number.length > 20){
                $('#error-message4').text('Maximum length is 20 numbers.');
            }
        })
        $(".trip-post-button").click(function(){
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
                  
                  $("#profile_form").submit();
                  reader.readAsDataURL(file);
                }
        })
});
    
    </script>
    <script>
    $(document).ready(function() {
        $('#first_acc').on('input', function() {
    var inputValue = $('#first_acc').val();
    if (inputValue.length > 20) {
      $('#error-message').text('Maximum length is 20 characters.');
    }
  });
       $('#last_acc').on('input', function() {
    var inputValue1 = $('#last_acc').val();
    if (inputValue1.length > 20) {
      $('#error-message1').text('Maximum length is 20 characters.');
    }
  });
        $('#floatingTextarea').on('input', function() {
    var inputValue2 = $(this).val();
    if (inputValue2.length > 100) {
      $('#error-message2').text('Maximum length is 100 characters.');
    }
  });
  $("#accform").validate({
    rules: {
      first_acc: {
        required: true,
      },
       last_acc: {
        required: true,
      },
      floatingTextarea: {
        required: true,
      },
    },
    messages: {
      first_acc: {
        required: "Please enter your name",
      },
      last_acc:{
          required: "Please enter last name",
      },
      floatingTextarea: {
        required: 'Please enter  the description',
      },
    },
  });
    });
</script>

@endsection