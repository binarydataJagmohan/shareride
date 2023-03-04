@extends('rides.layouts.app')
@section('title','Dashboard')
@section('content')
<style>
    a.button.darkgrey.edit_btn.col-sm-12{
        font-size:12px;
    }
    
    .dtl_btn{
        font-size:12px;
    }

    span.icon img {
    width: 25px;
}
</style>

<section class="dash-details">
    
  <div class="container">
    <div class="row">
      @include('account.sidebar')
      <div class="col-sm-9">
        <h1>Vehicles</h1><br>
        <div class="col-sm-12">
            @if($vehicle)
            <div class="card" style="padding: unset; height:350px;">
                <div class="card-header">
                  <div class="row">
                    <div class="col-sm-6">
                        <span class="btn btn-dark" style="padding: 2px 8px; font-size: 11px; border-radius:20px;">Primary vehicle</span>
                    </div>
                    <!--<div class="col-sm-6">-->
                    <!--   <div class="d-flex justify-content-end">-->
                    <!--    <a href="{{ url('edit-vehicle') }}" style="font-size: 12px; color:rgb(26, 24, 24);">Edit</a>&nbsp;<span>|</span>&nbsp;-->
                    <!--    <a data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer; font-size: 12px; color:rgb(26, 24, 24);">Delete</a>-->
                    <!--   </div>-->
                    <!--</div>-->
                  </div>
                </div>
                
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-sm-6">
                        @if(isset($vehicle))
                        @if($vehicle->img != null)
                        <img src="{{ asset('public/'.$vehicle->img) }}" style="height: 250px;width: 100%;object-fit: cover;" alt="">
                        @else
                        <img src="{{ asset('public/images/icon-vehicle-add.fc6fe73ed22b.png') }}" class="w-100" alt="">
                        @endif
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <h4><b>{{ $vehicle->brand ?? "" }}  </b>{{ $vehicle->model ?? "" }}</h4>
                        <p><b>Year:</b> {{ $vehicle->year ?? "" }}</p>
                        <p><b>Color:</b> {{ $vehicle->color ?? "" }}</p>
                        <div class="row">
                            <hr class="mt-2 mb-2">

                            
                              <p class="pt-1 col-sm-6"><span class="icon" style="margin-right: 10px"><img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_snowsports.a87ecbb5a4d5.png" alt=""></span>{{ $vehicle->luggage }} luggage <b>ok</b></p>                                      
                            
                              @php
                              $other = json_decode($vehicle->others);
                              @endphp
                            
                        <p class="pt-1 col-sm-6"><span class="icon" style="margin-right: 10px"><img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_winter_tires.f88d4674a84d.png" alt=""></span>@if(is_array($other) && (in_array('Winter tires',$other))) {{ 'has Winter tires' }} @else {{ 'Winter tires No' }} @endif</p>
                            
                            
                            <p class="pt-1 col-sm-6"><span class="icon" style="margin-right: 10px"><img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_bike.30c39bc8ff90.png" alt=""></span>@if(is_array($other) && (in_array('Bikes',$other))) {{ 'Bikes ok' }} @else {{ 'Bikes No'}} @endif</p>                                      
                            
                            
                            <p class="pt-1 col-sm-6"><span class="icon" style="margin-right: 10px"><img src="http://localhost/Laravel/share-ride/public/images/icon_vehicle_pets.4424314fa4c3.png" alt=""></span>@if(is_array($other) && in_array('Pets',$other))) {{ 'Pets ok'}} @else {{'Pets No'}} @endif </p>
                            
                        
                        
                        </div>
                        <div class="row justify-content-around mt-4">
                            <div class="col-sm-6">
                            <a href="{{ url('edit-vehicle') }}"  class="button darkgrey edit_btn col-sm-12">Edit</a>

                            </div>
                            <div class="col-sm-6">
                                <button class="button darkgrey dtl_btn col-sm-12" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">Delete</button>

                            </div>
                            
                        </div>
                    </div>
                  </div>
                 
                  
                  </div>
                  
              </div>
               @else
               <p>Looks like you have no vehicles, yet.</p>
                 <a href="{{ url("edit-vehicle") }}" class="button darkgrey mt-5" id="trip-post-button">Add Vehicle</a>
              @endif
        </div>
      </div>
      
  </div>
  
  


<!-- Modal -->
@if(isset($vehicle))
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>Are you sure to delete this vehicle ?</h4>
      </div>
      <div class="modal-footer">
        <form method="POST" action="{{ url('delete-vehicle', $vehicle->id) }}">
          @csrf
              <input type="hidden" name="vehicle_id" value="{{ $vehicle->id ?? '' }}">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="button darkgrey dtl_btn">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endif
  

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    document.getElementById("select_photo").addEventListener("click", function () {
             document.getElementById("photo").click();
            });
    $(document).ready(function(){
        $("#photo").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#preview_photo").removeAttr("src");
                            $("#preview_photo").attr("src",event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
    });
</script>


@endsection