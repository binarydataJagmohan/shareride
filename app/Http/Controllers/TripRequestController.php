<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripRequest;
use App\Models\PostTrip;
use Auth;
use DB;

class TripRequestController extends Controller
{
   public function store(Request $request)
   {
      $data = new TripRequest();
      $data->user_id = Auth::user()->id;
      $data->pickup_location = $request->origin;
      $data->drop_location = $request->destination;
      $data->leaving = $request->date;
      $data->seat = $request->seat;
      $data->description = $request->description;
      $data->save();

      if($data)
      {
         $request->session()->flash('msg','Got it, we"ll notify you when a relevant trip is posted!');
         return redirect('dashboard');
      }
      else
      {
         $request->session()->flash('error','Some error');
         return redirect('request/add');
      }

   }
     public function edit($id)
  {
      $data  = TripRequest::find($id);
      return view('rides.editrequest',['datas'=>$data]);
  }
  public function update(Request $request, $id)
  {
      $trip = TripRequest::find($id);
      $trip->user_id = Auth::user()->id;
      $trip->pickup_location = $request->origin;
      $trip->drop_location = $request->destination;
      $trip->leaving = $request->date;
      $trip->seat = $request->seat;
      $trip->description = $request->description;
      $trip->save();
  
      return redirect('request-trip?#profile-tab/'.$id)->with('success','We'.' ve updated your request'.'s details!');
  }
     public function request_delete($id)
  {
     
      $data  = TripRequest::where('id',$id)->update([
          'status' => 'deleted'
          ]);
     return redirect('dashboard')->with('success','Your request was deleted.');
  }
  
}