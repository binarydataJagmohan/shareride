<style>
    .main-menu a.main-logo {
    width: 230px;
}
</style>
<header class="main-header border-0">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-4 hide">
        <ul class="link-menu">
          <li class="btn-li  hide-mobile border-0 hide"><a href="{{route('find')}}" class="border-0"><i class="fa-solid fa-magnifying-glass"></i> Find a ride</a></li>
          <li class="btn-li  hide-mobile border-0 hide"><a href="{{route('choose')}}" class="border-0"><i class="fa-solid fa-plus"></i> Post a trip</a></li>
        </ul>
      </div>
      <div class="col-md-4 text-center col-6 main-menu">
        <a href="{{url('/')}}" class="main-logo"><img src="{{asset('public/images/logo1.png')}}" alt="logo"></a>
      </div>
      <div class="col-md-4 col-6 text-lg-0  text-end">
        <ul class="link-menu">
          <li class="btn-li  hide-mobile border-0 hide"><a href="#" class="border-0"> <img src="https://cdn.poparide.com/static/pop/webui/common/images/icons/menu-how.939b0f7d15da.svg"> How its works</a></li>
          <li class="btn-li  hide-mobile border-0 hide"><a href="{{url('home')}}" class="border-0"><i class="fa-solid fa-arrow-right"></i> Sign in</a></li>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>