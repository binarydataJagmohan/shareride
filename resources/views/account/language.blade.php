
@extends('rides.layouts.app')
@section('title','Language')
@section('content')
<style>
    a.button.darkgrey.edit_btn.col-sm-12{
        font-size:12px;
    }
    
    .dtl_btn{
        font-size:12px;
    }
</style>

<section class="dash-details">
    
  <div class="container">
    <div class="row">
      @include('account.sidebar')
      <div class="col-sm-9">
        <h1>Language</h1><br>
        <p>We'll send emails and other communications to you in this language.
        </p>
        <div class="col-sm-12">
            <div class="row col-sm-4 mt-3">
                <form method="post" action="{{ url('language') }}">
                    @csrf
                <select class="form-select" name="language" required>
                    @php
                    $languages = DB::table('languages')->get();
                    @endphp
                    @foreach($languages as $language)
                    <option <?php if(Auth::user()->language == $language->name){ echo "selected"; } ?> vlaue="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                  </select>
            </div>
            <div class="row col-sm-4 mt-3">
                <button type="submit" class="button darkgrey mt-3" id="trip-post-button">Save</button>
            </div>  
            </form>
        </div>
      </div>
      
  </div>
  
  



</section>


@endsection