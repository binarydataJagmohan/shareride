@extends('rides.layouts.app')
@section('title','Social Account')
@section('content')
<style>
  p.social-icon1 {
    font-weight: 500 !important;
    font-size: 19px;
    line-height: 24px !important;
  }
  p.social-icon {
    font-size: 18px;
    line-height: 26px;
    padding-top: 12px;
  }
.facebook-icon img {
    width: 20px;
}
.facebook-icon span {
    padding-left: 52px;
    color: #333333;
}
.facebook-icon {
    border: 1px solid #dfdbdb;
    width: 30%;
    padding: 18px 10px;
}
</style>
 <section class="dash-details">
    <div class="container">
      <div class="row">
         @include('account.sidebar')
        <div class="col-sm-9">
          <div class="page-details">
            <h1>Social Accounts</h1><br><br>
            <p class="social-icon1">The following e-mail addresses are associated with your account:</p>
            <p class="social-icon">Connect a new social account:</p>
            <div class="row">
              <div class="col-md-12">
                <div class="facebook-icon mb-3 mt-4">
                  <a href="https://simranautomobiles.com/2023/share-ride/auth/facebook" >
                    <img
                      src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-social-facebook.76512ffeaf2e.png"
                      alt="">
                    <span>facebook</span>
                  </a>
                </div>
              </div>
              <div class="col-md-12">
                <div class="facebook-icon">
                  <a href="https://simranautomobiles.com/2023/share-ride/authorized/google">
                    <img
                      src="https://cdn.poparide.com/static/pop/webui/common/images/icons/icon-social-google.1446d6483197.png"
                      alt="" >
                    <span>Google</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>


@endsection