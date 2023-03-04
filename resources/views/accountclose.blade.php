@extends('rides.layouts.app')
@section('title','Close Account')
@section('content')
<style>
  section.dash-details .close-h1 {
    font-size: 32px;
    font-weight: 800;
    color: #000;
    margin-bottom: 30px;
  }

  .text-medium {
    font-size: 16px;
    line-height: 24px;
    color: #4C4C4C;
  }

  .close-text {
    font-weight: 600;
  }

  a.link-grey.underline {
    text-decoration: underline;
    color: #4C4C4C;
  }

  .divider.short.light {
    max-width: 60px;
  }

  .m-spacer {
    height: 40px;
    clear: both;
  }

  .s-spacer {
    height: 20px;
    clear: both;
  }

  textarea#id_reason {
    background: #ececec;
    border-radius: 15px;
    border: none;
    color: #565a5c;
    height: 150px;
    font-size: 15px;
    padding: 15px;
  }

  .account-close1 {
    font-weight: 500;
  }

  input#id_goodbye {
    background: #ececec;
    border-radius: 15px;
    border: none;
    color: #565a5c;
    margin: 10px 0px 5px 0px;
    padding: 16px;
    width: 250px;
  }
  input#account-btn {
    padding: 13px 26px;
    font-size: 14px;
}
.alert.alert-danger {
    text-align: center;
}
</style>

<section class="dash-details">
    <div class="container">
      <div class="row">
        @include('account.sidebar')
        <div class="col-sm-9 full-width-mobile">
          <div class="s-spacer show-on-mobile"></div>
          <h1 class="close-h1">Close account</h1>
          <div class="m-spacer"></div>
          <div class="close-text">
            We'll be sad to see you leave :(
          </div>
          <div class="xs-spacer"></div>
          <div class="text-medium">
            If you have any questions before you decide to close your account, feel free to <a href="/help/contact"
              class="link-grey underline">contact us</a>
          </div>
          <div class="m-spacer"></div>
          <div class="divider short light"></div>
          <div class="m-spacer"></div>

          <div class="text-medium semi-strong">
            How can we improve? (Optional)
          </div>
          <div class="xs-spacer"></div>
          <form method="post" action="{{route('deactive')}}">
              @csrf
            <input type="hidden" name="csrfmiddlewaretoken"
              value="tybVjIeUQ1KMHtZZkaUZb5tCtCpF1ZA6siNB4f2BteXL1vrUqtDsmbXwF3EF4gb8">
            <textarea name="reason" cols="80" rows="10" placeholder="Be honest, we can take it." maxlength="1024"
              id="id_reason"></textarea>

            <div class="s-spacer"></div>
            <div class="account-close1">
              Type GOODBYE in the box below to confirm you'd like to close your account
            </div>
            <div class="xxs-spacer"></div>
            <input type="text" name="goodbye" placeholder="Type GOODBYE" class="goodbye" maxlength="32" required=""
              id="id_goodbye">

            <div class="s-spacer"></div>
            <input type="submit" value="Close my account" class="button darkgrey button-fixed-bottom" id="account-btn">
          </form>
        </div>
      </div>
    </div>
  
</section>

@endsection