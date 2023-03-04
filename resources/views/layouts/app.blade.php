<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | ShareRide</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('public/asset/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
   <link rel="stylesheet" href="{{asset('public/css/custom.css')}}">
  <link rel="shortcut icon" href="{{url('public/images/fav.png') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
  @if (Auth::check())
   @include('rides.layouts.header')
   @else
   @include('layouts.header')
   @endif

  @yield('content')

  @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js">
  </script>

  <script>
    $(document).ready(function () {
      $("#testimonial-slider").owlCarousel({
        items: 1,
        itemsDesktop: [1000, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [767, 1],
        pagination: true,
        navigation: false,
        navigationText: ["", ""],
        slideSpeed: 1000,
        singleItem: true,
        transitionStyle: "fade",
        autoPlay: true
      });


       $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var siteUrl = jQuery('meta[name="site-url"]').attr('content');
    $(function() {
      $(".trip_detail").click(function() {
        var id = $(this).attr("data-id");
        $.ajax({
          type: "POST",
          url: siteUrl + "/get-trip-details",
          data: {
            id: id
          },
          success: function(response) {
            if (response.status == "success") {
              var trip = response.data;
              console.log(trip);
              $('#origin').val(`${response.origin.name} , ${response.origin.state} , ${response.origin.country} , ${response.origin.pin_code}`);
              $('#destination').val(`${response.destination.name} , ${response.destination.state} , ${response.destination.country} , ${response.destination.pin_code}`);
              $('#origin_value').val(response.origin.id);
              $('#destination_value').val(response.destination.id);
              $('#date').val(trip.start_date);
              $('#time').val(trip.start_time);
              $('#rtimes').val(trip.rtimes);
              $('.luggage[value="' + trip.luggage + '"]').attr("checked", 'checked');
              $('.back_sitting[value="' + trip.back_row_seat + '"]').attr("checked", 'checked');
              $(".trip_copied").removeClass('d-none');
              $(".accordion-collapse").collapse("hide");
            }
          },
        });
      });
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
                } else {
                  $("#stops_list").html(html);
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
  });
  </script>
</body>
</html>