@extends('rides.layouts.app')
@section('title','Dashboard')
@section('content')

<section class="dash-details">
    
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <div class="dash-details-menu-left">
          <div class="tab-group-title">Profile</div>
           <ul class="left-dash-menu">
             <li ><a href="{{route('account')}}">Personal details</a></li>
             <li><a href="#">Preferences</a></li>
             <li><a href="#">Language</a></li>
             <li><a href="#">Vehicles</a></li>
             <li class="active"><a href="#">Contact details</a></li>
           </ul>

           <div class="tab-group-title">Money</div>
           <ul class="left-dash-menu"> 
             <li><a href="#">Payment settings</a></li>
             <li><a href="#">Payout settings</a></li>
           </ul>

           <div class="tab-group-title">Security</div>
           <ul class="left-dash-menu"> 
             <li><a href="#">Email addresses</a></li>
             <li><a href="#">Password1</a></li>
             <li><a href="#">ID verification</a></li>
             <li><a href="#">Social accounts</a></li>
             <li><a href="#">Close account</a></li> 
           </ul>

        </div>
      </div>
      <div class="col-sm-9">
        <div class="page-details">
          <h1>Contact details</h1><br>
          <p>Phone number</p><br>
          <p>+91 90563 43091 <a href="#" style="text-decoration:underline ;"> Change</a> </p>
          <hr class="hr-line">
          <!-- <div class="notification-label-recommended">Recommended</div> -->
          <div class="top"><strong> Please note:</strong>  you can verify your name by <a href="#"  style="text-decoration:underline ;color: #777777;">uploading a piece of Offline ID.</a> Being verified makes you more trustworthy and appealing to other users as both a driver and passenger!</div>
<br>
          <p><b>Push notifications</b><br>For all activity: bookings, messages, reviews...</p>
          <p>Install the Poparide app on <a href="#">iOS</a> or <a href="#">Android</a> to get push notifications</p>
           <hr class="hr-line">
           <div class="col-md-4 position-relative location">
            <label for="">First Name</label>
            <input type="text" class="form-control" placeholder="" data-bs-toggle="modal"
              data-bs-target="#exampleModal4">
          </div>
          <div class="col-md-4 position-relative location">
            <label for="">Last Name</label>
            <input type="text" class="form-control" placeholder="" data-bs-toggle="modal"
              data-bs-target="#exampleModal4">
          </div>
          <div class="row" id="selectclass">
            <label for="">Date of birth</label>
            <div class="col-sm-2">
                <select class="form-select" aria-label="Default select example">
                  <option selected>aug</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-sm-2">
                <select class="form-select" aria-label="Default select example">
                  <option selected>02</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-sm-2">
                <select class="form-select" aria-label="Default select example">
                  <option selected>1995</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
          </div>
          <div class="col-sm-10">
            <label for="">Description</label>
            <div class="form-floating">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
              <label for="floatingTextarea">welcome</label>
            </div>
          </div>
          <div class="row" id="selectclass">
            <div class="col-sm-2">
                <select class="form-select" aria-label="Default select example">
                  <option selected>1995</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
          </div>
           <div class="row mt-5">
             <div class="col-sm-2">
                <p>Type of user</p>
               <label class="switch">
                <input type="checkbox" name="is_driver">
                <span class="slider round"></span>
              </label>
             </div>
             <div class="col-sm-2">
              <span>I'm a driver</span>
             </div>
           </div>
           <div class="mt-5">
            <a href="" class="button darkgrey" id="trip-post-button">Update profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection