@extends('rides.layouts.app')
@section('title','Trip Request')
@section('content')
<style>
      i.fa-solid.fa-location-dot {
    font-size: 22px;
  }

  input.stop_name.col-sm-10:focus {
    border: none;
    outline: none;
    margin-left: 15px;
    padding: 6px 0;
  }
</style>
<section class="dash-details">

	<!--@if($errors->any())-->
 <!-- <ul>-->
 <!--   @foreach($errors->all() as $error)-->
 <!--   <li>{{$error}}</li>-->
 <!--   @endforeach-->
 <!-- </ul>-->
 <!-- @endif-->
  
<div class="container">
    <div class="row mt-5">
        <h6 class="h3 mb-5">Rules when posting a trip</h6>
        <form method="POST" action="{{route('triprequest')}}" id="product-add"> 
          @csrf
        <div class="row align-items-center pt-4">
            <div class="col-md-3">
              <div class="left-text">
                <p>Origin</p>
              </div>
            </div>
            <div class="col-md-4 position-relative location">
              <i class="fa-solid fa-location-dot"></i>
              <input type="text" class="form-control" readonly placeholder="Enter an Origin" data-bs-toggle="modal" data-bs-target="#addOrigin" id="origin" required="">
             <input type="hidden" name="origin" id="origin_value">
            </div>
          </div>
          
          <div class="row align-items-center pt-4">
            <div class="col-md-3">
              <div class="left-text">
                <p>Destination
                </p>
              </div>
            </div>
            <div class="col-md-4 position-relative location">
              <i class="fa-solid fa-location-dot"></i>
              <input type="text" class="form-control" readonly placeholder="Enter a destination" data-bs-toggle="modal" data-bs-target="#addDestination" id="destination" required="">
                <input type="hidden" name="destination" id="destination_value">
            </div>
          </div>
          <div class="row align-items-center pt-4">
            <div class="col-md-3">
              <div class="left-text">
                <p>Leaving</p>
              </div>
            </div>
            <div class="col-md-4 position-relative location toolip">
              <!--<i class="fa-regular fa-calendar"></i>-->
              <input type="date" class="form-control" placeholder="Pick a date" min="{{date('Y-m-d')}}" name="date"  id="date">
              <!-- <li class="tootip">Enter a date</li> -->
            </div>
           
          </div>

          <div class="row align-items-center pt-4 mb-5">
            <div class="col-md-3">
              <div class="left-text">
                <p>Seats required</p>
              </div>
            </div>
          <div class="col-md-2">
            <div class="input-group mb-3">
                <select class="form-select" id="inputGroupSelect02" name="seat"  id="seat">
                  <option selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
                <label class="input-group-text" for="inputGroupSelect02">seat</label>
              </div>
        </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <p>Description</p>
            </div>
            <div class="col-sm-9">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="description" required="">
                  </textarea>
                <!--   <label for="floatingTextarea">Tell drivers about your ride (this helps to get accepted on trips)
                  </label> -->
                </div>
                <div class="trip-submit-button button-loader mt-5">
                    <input type="submit" value="Post trip" class="button darkgrey" submitted-value="Posting..." id="trip-post-button">
                </div>
            </div>
          </div>
          </form>
        </div>
    </div>
    
     {{-- select origin model  --}}
        <div class="modal fade" id="addOrigin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter a stop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="input-container col-sm-12">
                  <i class="fa-solid fa-location-dot"></i>
                  <input type="text" class="stop_name col-sm-10 search_stop" data-type="origin" placeholder="" style="border: none;">
                  <hr>
                </div>
                <p class="mt-4">Enter at least three characters to get started.</p>
                <div class="mt-3">
                  <div class="row">
                    <ul class="list-unstyled" id="origin_list"></ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- end origin model  --}}
        {{-- select DESTINATION model  --}}
        <div class="modal fade" id="addDestination" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter a stop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="input-container col-sm-12">
                  <i class="fa-solid fa-location-dot"></i>
                  <input type="text" class="stop_name col-sm-10 search_stop" data-type="destination" placeholder="" style="border: none;">
                  <hr>
                </div>
                <p class="mt-4">Enter at least three characters to get started.</p>
                <div class="mt-3">
                  <div class="row">
                    <ul class="list-unstyled" id="destination_list"></ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- end DESTINATION model  --}}
    
</section>
<script>
$(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var siteUrl = jQuery('meta[name="site-url"]').attr('content');
         
         $(".search_stop").on("input", function() {
        var city = $(this).val();
        var type = $(this).attr('data-type');
        // alert(type);
        // alert(city);
        $.ajax({
          type: "POST",
          data: {
            city: city
          },
          url: siteUrl + "/search-stops",
          success: function(response) {
            if (response.status == "success") {
              var stops = response.data;
              var html = " ";
              stops.forEach(stop => {
                html += `<li style="cursor:pointer;" data-id="${stop.id}" data-type="${type}" data-name="${stop.name}" data-state="${stop.state}" data-country="${stop.country}" data-pin="${stop.pin_code}" class="stop">
			<p style="font-weight: 600;font-size:16px;">${stop.name}</p>
			<p>${stop.state} , ${stop.country}</p>
			<hr>
		</li>`
              });
              console.log(html);
              if (html.length > 0) {
                if (type == 'origin') {
                  $("#origin_list").html(html);
                } else if (type == 'destination') {
                  $("#destination_list").html(html);
                }
              }
            }
          },
        });
      });
            $(document).on("click", '.stop', function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var state = $(this).attr('data-state');
        var country = $(this).attr('data-country');
        var pin = $(this).attr('data-pin');
        var type = $(this).attr('data-type');
        if (type == 'origin') {
          $("#origin").val(`${name} , ${state} , ${country} , ${pin}`);
          $("#origin_value").val(`${name}`);
          $('#addOrigin').modal('hide');
        } else if (type == 'destination') {
          $("#destination").val(`${name} , ${state} , ${country} , ${pin}`);
          $("#destination_value").val(`${name}`);
          $('#addDestination').modal('hide');
        } else {
          var html = `<div class="mt-2">
									      <i class="fa-solid fa-location-dot" style="top:unset !important;margin-top: 20px;"></i>
                        <input type="text" class="form-control"  value="${name} , ${state} , ${country} , ${pin}"  id="destination" required="">
                        <input type="hidden" class="form-control" placeholder="Enter a destination" name="stops[]" value="${name}"  id="destination" required="">
                     </div>`;
          $(html).insertBefore("#insert_before");
          $('#addStopsModal').modal('hide');
        }
        
      });
});
</script>
     
     <script>
     $(document).ready(function() {
      //validation for form 
        $("#product-add").validate({
 
            rules: {
                origin: {
                    required: true,
                    maxlength: 50,
                },
 
                destination: {
                    required: true,
                },
 
                date: {
                    required: true,
                },
                time: {
                    required: true,
                },
                seat: {
                    required: true,
                },
            },
            messages: {
 
                origin: {
                    required: "Please enter start Origin Point",
                },
                destination: {
                    required: "Please enter valid destination",
                },
                 date: {
                    required: "Please enter date",
                },
                time: {
                    required : "Please enter time",
                },
                seat: {
                    required: 'please select the seat',
                },
              
            },
        });
 });
</script>

@endsection