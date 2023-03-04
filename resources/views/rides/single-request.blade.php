@extends('rides.layouts.app')
@section('title','Request View')
@section('content')
<style>
    .s-spacer {
    height: 20px;
    clear: both;
}
#modal-popup-there a.btn.btn-secondary {
    padding: 10px 50px;
    border: 2px solid #dfdbdb;
    background: transparent;
    color: #000;
    font-size: 14px;
}
a.btn.btn-secondary.red {
    color: red !important;
}
a.btn.btn-secondary.green {
    color: green !important;
    
}
.delete-popup .modal-body {
    padding: 0px 30px 0px;
}
.delete-popup .modal-footer {
    display: inline-block;
    padding-left: 24px;
}
.delete-popup a:focus, a:hover ul.link-menu li{
    padding:0px;
}
.modal-backdrop.show{
    opacity:0 !important;
}
#modal-popup-there button.btn.btn-secondary.green {
    padding: 10px 50px;
    border: 2px solid #dfdbdb;
    background: transparent;
    color: green;
    font-size: 14px;
}
</style>
<section>
    <div class="dashboard-two">
      <div class="container">
        <div class="row" id="bordr-pdeng">
          <div class="col-sm-12 text-end" id="images-seting">
            <div class="right-setting" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <img src="{{url('public/images/icon-settings-grey.83e4cbfd8a1d.png')}}" alt="">
              <span>settings</span>
            </div>
          </div>
        </div>
        <div class="route-text">
            @foreach ($data as $datarequest)
          <div class="row mt-4">
            <div class="col-md-5">
              <h1 class="mt-4" style="color:#0099ff;">{{ucfirst($datarequest->pickup_location)}} to {{ucfirst($datarequest->drop_location)}}</h1>
              <h3>{{\Carbon\Carbon::parse($datarequest->leaving)->format('l , F d ')}}</h3>
            <p>{{Auth::user()->name}} needs {{$datarequest->seat}} seats</p>
            <div class="s-spacer"></div>
            <p>"{{$datarequest->description}}"</p>
            </div>
          </div>
          @endforeach

        <!-- Modal -->
        <div class="modal fade class-cahnge-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Request settings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="col-sm-12" id="checkbox-id">
                  <div class="divider light no-margin"></div>
                  <a href="{{url('request/edit',$datarequest->id)}}" class="modal-list-item">Edit request</a>
                  <div class="divider light no-margin"></div>
                  <a href="{{url('/request-delete',$datarequest->id)}}" class="modal-list-item color-red" data-bs-toggle="modal" data-bs-target="#exampleModal12">Delete request</a> 
                  <div class="divider light no-margin"></div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
      <div class="modal fade class-cahnge-popup delete-popup" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
              <form method="post" action="{{url('request-delete',$datarequest->id)}}">
                  @csrf
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="col-sm-12" id="checkbox-id">
                  <h4 class="" style="font-weight: 600;">{{$datarequest->pickup_location}} to {{$datarequest->drop_location}}</h4>
                    <p style="font-weight: 400; font-size:16px;">{{\Carbon\Carbon::parse($datarequest->leaving)->format('l , F d')}}</p>
                    <br>
                    <br>
                    <h6>Are you Sure You want to Delete this request</h6>
                </div>
              </div>
              <div class="modal-footer border-0" id="modal-popup-there">
                <a href="" class="btn btn-secondary red"  data-bs-dismiss="modal" aria-label="Close">NO</a>
                <button type="submit" class="btn btn-secondary green">YES</button>
              </div>
            </div>
            </form>
          </div>
        </div>
  
  <div class="container-fluid py-5">
    <!--<div class="row py-5" id="color-norivfacation">-->
    <!--    <div class="col-sm-3"></div>-->
    <!--    <div class="col-sm-9">-->
    <!--      <img src="images/bell.png" alt="">  We'll send you a notification when a new trip matches your request-->
    <!--    </div>-->
    <!--  </div>-->
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.5447316468667!2d76.68998501558927!3d30.703083081647566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390feef45533cde3%3A0x6492bea79120e89a!2sBinary%20Data%20Private%20Limited!5e0!3m2!1sen!2sin!4v1676017642175!5m2!1sen!2sin"
      width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
  </script>
  <script>
    document.getElementById("file-box").addEventListener("click", function () {
      document.getElementById("file-input").click();
    });
  </script>

  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>




@endsection