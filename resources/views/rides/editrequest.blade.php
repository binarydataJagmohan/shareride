@extends('rides.layouts.app')
@section('title','Trip Request')
@section('content')

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
            
        <form method="POST" action="{{route('updaterequest',$datas->id)}}" id="product-add"> 
          @csrf
        <div class="row align-items-center pt-4">
            <div class="col-md-3">
              <div class="left-text">
                <p>Origin</p>
              </div>
            </div>
            <div class="col-md-4 position-relative location">
              <i class="fa-solid fa-location-dot"></i>
              <input type="text" class="form-control" value="{{$datas->pickup_location}}" placeholder="Form" name="origin" id="origin">
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
              <input type="text" class="form-control" value="{{$datas->drop_location}}" placeholder="to" name="destination" id="destination">
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
              <input type="date" class="form-control" placeholder="Pick a date" min="{{date('Y-m-d')}}" name="date"  id="date" value="{{$datas->leaving}}">
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
                  <option selected>0</option>
                  <option value="1"{{ $datas->seat == '1' ? 'selected' : '' }}>1</option>
                  <option value="2"{{ $datas->seat == '2' ? 'selected' : '' }}>2</option>
                  <option value="3"{{ $datas->seat == '3' ? 'selected' : '' }}>3</option>
                  <option value="4"{{ $datas->seat == '4' ? 'selected' : '' }}>4</option>
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
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="description" required="" value="{{$datas->description}}">{{$datas->description}} </textarea>
                <!--   <label for="floatingTextarea">Tell drivers about your ride (this helps to get accepted on trips)
                  </label> -->
                </div>
                <div class="trip-submit-button button-loader mt-5">
                    <input type="submit" value="Update trip" class="button darkgrey" submitted-value="Posting..." id="trip-post-button">
                </div>
            </div>
          </div>
          </form>
        
        </div>
    </div>
    
</section>
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