<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Shere Ride</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">
       <link rel="stylesheet" href="{{asset('public/css/custom.css')}}">
     <link rel="shortcut icon" href="{{ url('public/images/fav.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   
    <style>
    .error{
     color: #FF0000; 
    }
    
  </style>
</head>

<body>
   @if (Auth::check())
   @include('rides.layouts.header')
   @else
   @include('layouts.header')
   @endif
   @yield('content')
   @include('rides.layouts.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

     <script>
    //   document.getElementById("file-box").addEventListener("click", function () {
    //          document.getElementById("file-input").click();
    //         });

            // function data(type,val){
            //   if(type == 'origin'){
            //     $('.textclass').text('Enter a Orgin');
            //     $('#type_data').val(type);
            //   }else {
            //     $('#type_data').val(type);
            //     $('.textclass').text('Enter a Destination');
            //   }
            //   $('#modal_val').val('')
            //   $('#exampleModal5').modal('show'); 
            // }

            // function save(value){
            //   if($('#type_data').val() == 'origin' ){
            //     $('#origin').val(value);
            //   }else {
            //      $('#destination').val(value)
            //   }
            //   $('#exampleModal5').modal('hide');
            // }
            $(document).ready(function(){
                $('#name').on('keyup',function(){
                    var val = $(this).val();
                    $.ajax 
                    ({
                        url: "{{route('offer')}}",
                        type: "GET",
                        data: {name:val},
                        success:function(data){
                            $('#product_list').html(data);
                        }
                    });
                });
                $(document).on('click','li',function(){
                  var value = $(this).text();
                  $('#name').val(value);
                  $('#product_list').html('');
                });

            });

        $(document).ready(function() {
        $("#toggle").change(function() {
         if(this.checked) {
        $("#target").hide();
        } else {
         $("#target").show();
        }
       });
      });
      
 
$(document).ready(function() {
  // Hide the notification dropdown menu initially
  $(".ul-width").hide();
  $("#bell-id").click(function(event) {
    event.stopPropagation(); 
    $(".ul-width").toggle();
  });
  $(document).click(function() {
    $(".ul-width").hide();
  });
});







 
 
 

</script>
</body>

</html>