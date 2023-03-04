@extends('rides.layouts.app')
@section('title','Notification')
@section('content')

<section class="dash-details">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <div class="dash-details-menu-left">
          <div class="tab-group-title">Profile</div>
           <ul class="left-dash-menu">
             <li><a href="#">Personal details</a></li>
             <li><a href="#">Preferences</a></li>
             <li><a href="#">Language</a></li>
             <li><a href="#">Vehicles</a></li>
             <li class="active"><a href="#">Notifications</a></li>
           </ul>

           <div class="tab-group-title">Money</div>
           <ul class="left-dash-menu"> 
             <li><a href="#">Payment settings</a></li>
             <li><a href="#">Payout settings</a></li>
           </ul>

           <div class="tab-group-title">Security</div>
           <ul class="left-dash-menu"> 
             <li><a href="#">Email addresses</a></li>
             <li><a href="#">Password</a></li>
             <li><a href="#">ID verification</a></li>
             <li><a href="#">Social accounts</a></li>
             <li><a href="#">Close account</a></li> 
           </ul>

        </div>
      </div>
      <div class="col-sm-9">
        <div class="page-details">
          <h1>Email Addresses</h1><br><br>
          <p>The following e-mail addresses are associated with your account:</p>
   <div class="row">
    <div class="col-sm-6">
        <div class="form-check mt-5">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label m-0" for="exampleRadios1">
                sk3645797@gmail.com
            </label>
          </div>

      <div class="mt-5">
        <span class="same1">Make Primary</span>
        <span class="same1 bgchnde">Re-send Verification</span>
        <span class="same1 delete">Delete</span>
      </div>

      <div class="mt-5">
        <a href="#"  style="text-decoration:underline ;color: #777777;"><b>Add another email address</b></a>
      </div>
    </div>
    <div class="col-sm-6">
  <span class="same">Verified</span>
  <span class="same bgchnde">Primary</span>
    </div>
   </div>
        </div>
      </div>
    </div>
  </div>
</section>
  @endsection