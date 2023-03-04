<div class="col-sm-3">
    <div class="dash-details-menu-left">
      <div class="tab-group-title">Profile</div>
       <ul class="left-dash-menu">
         <li class="list-group-item {{ (request()->is('account')) ? 'active' : '' }}"><a href="{{route('account')}}">Personal details</a></li>
         <!--<li><a href="#">Preferences</a></li>-->
         <!--<li class="list-group-item {{ (request()->is('language')) ? 'active' : '' }}"><a href="{{ url('language') }}">Language</a></li>-->
         <li class="list-group-item {{ (request()->is('update-vehicle')) ? 'active' : '' }}"><a href="{{ url('update-vehicle') }}">Vehicles</a></li>
         <!--<li class="active"><a href="#">Contact details</a></li>-->
       </ul>

       <div class="tab-group-title">Money</div>
       <ul class="left-dash-menu"> 
         <li><a href="{{url('/payment-setting')}}">Payment settings</a></li>
         <li><a href="{{url('/payouts-setting')}}">Payout settings</a></li>
       </ul>

       <div class="tab-group-title">Security</div>
       <ul class="left-dash-menu"> 
         <!--<li><a href="#">Email addresses</a></li>-->
         <li class="list-group-item {{ (request()->is('password/change')) ? 'active' : '' }}"><a href="{{url('password/change')}}">Password</a></li>
         <!--<li><a href="#">ID verification</a></li>-->
         <li class="list-group-item {{ (request()->is('account/social/connection')) ? 'active' : '' }}"><a href="{{route('social')}}">Social accounts</a></li>
         <li class="list-group-item {{ (request()->is('account/close')) ? 'active' : '' }}"><a href="{{route('account_close')}}">Close account</a></li> 
       </ul>

    </div>
  </div>
  
  