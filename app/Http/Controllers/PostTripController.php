<?php

namespace App\Http\Controllers;

use App\Models\PostTrip;
use App\Models\VehicleModel;
use App\Models\CarBrand;
use App\Models\BrandType;
use App\Models\Color;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Booking;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\XPath\Extension\HtmlExtension;

class PostTripController extends Controller
{

  public function index(Request $request)
  {
    // if ($request->ajax()) {
    //   $car =  CarBrand::where('brand_name', 'LIKE', $request->name . '%')->get();
    //   $output = '';
    //   if (count($car) > 0) {
    //     $output = '<ul class="list-group" style="display:block, postiton:relative; z-index ">';
    //     foreach ($car as $list) {
    //       $output .= '<li class="list-group-item">' . $list->brand_name . '</li>';
    //     }
    //     $output .= '</ul>';
    //   } else {
    //     $output .= '<li class="list-group-item">No Data Found</li>';
    //   }
    //   return $output;
    // }
    $car1 = BrandType::all();
    $car2 = Color::all();
    // dd(Auth::user()->id);
    $trips = PostTrip::where("user_id", Auth::user()->id)->get();
    $trip_count = PostTrip::where("user_id", Auth::user()->id)->count();
    if (Auth::check()) {
      if (isset(Auth::user()->id)) {
        $vehicle = VehicleModel::where('user_id', Auth::user()->id)->where('status', '!=', 'deleted')->first();
        return view('rides.posttrip', ['arr1' => $car1, 'arr2' => $car2, 'car_details' => $vehicle, 'trips' => $trips, 'trip_count' => $trip_count]);
      }
      return view('rides.posttrip', ['arr1' => $car1, 'arr2' => $car2]);
    } else {
      return redirect('home')->with('error', 'Please log in to create a booking.');
    }
  }
  public function store(Request $request)
  {
     if($request->skip_vehicle != '1'){
    if ($request->car_id == null || "") {
      //return $request->all();
      $car = new VehicleModel();
      $car->user_id = Auth::user()->id;
      $car->brand = $request->car_brand;
      $car->model = $request->car_model_names;
      $car->type = $request->type;
      $car->color = $request->color;
      $car->year = $request->year;
      
      if($request->img){
        $img = $request->file('img');
        $img_name = time().'_'.rand(1,9999).$img->getClientOriginalName();
        $img->move(public_path('images/vehicle'),$img_name);
        $car->img = "images/vehicle/".$img_name;
    }
      $car->licence_no = $request->licence;
      $car->save();
    }
    }

    //trip detail save
    $data = new PostTrip();
    $data->origin = $request->origin;
    $data->user_id = Auth::user()->id;
     if($request->skip_vehicle != '1'){
    if ($request->car_id != null || "") {
      $data->vehicle_id = $request->car_id;
    } else {
      $data->vehicle_id = $car->id;
    }
     }
    $data->destination = $request->destination;
    $data->start_date =  $request->date;
    if($request->stops){
            $stop = json_encode($request->stops);
            $data->stop =  $stop;
    }
    
    $data->return_date = $request->rdate;
    $data->start_time = $request->time;
    $data->return_time = $request->rtime;
    $data->luggage = $request->luggage;
    $data->back_row_seat = $request->back_sitting;
    $data->other = json_encode($request->other);
    $data->seats = $request->seat;
    $data->pricing = $request->price;
    $data->description = $request->description;
    $data->save();

    $request->session()->flash('msg', "Your trip was successfully created!");
    return redirect('dashboard');
  }
  public function edit($id)
  {
    $data = PostTrip::find($id);
    $cardata = VehicleModel::where('user_id', Auth::user()->id)->first();
    return view('rides.edittrip', ['datas' => $data, 'car' => $cardata]);
  }
  public function update($id, Request $request)
  {
    $trip = PostTrip::find($id);
    $vehicle = VehicleModel::where('user_id', Auth::user()->id)->first();

    DB::table('post_trips')->where('id', $id)->update([
      'start_date' => $request->date,
      'start_time' => $request->time,
      'return_date' => $request->rdate,
      'return_time' => $request->rtime,
      'description' => $request->description, 
      'back_row_seat' => $request->back_sitting,
      'luggage' => $request->luggage,
      'other' => json_encode($request->others)
    ]);
    DB::table('vehicle_models')->where('user_id', Auth::user()->id)->update([
      'model' => $request->model,
      'type' => $request->type
    ]);
    return redirect()->route('tripdetail', $trip->id)->with('msg', 'Changes to trip saved.');
  }
  public function request_trip()
  {
    $bookings = Booking::select('bookings.id','post_trips.id as trip_id','bookings.posted_by','bookings.status','bookings.applied_by','bookings.trip_id','bookings.created_at','bookings.origin','bookings.destination','bookings.seats','bookings.message','bookings.amount')->join('post_trips','bookings.trip_id','post_trips.id')->where('bookings.posted_by',Auth::user()->id)->where('bookings.status','pending')->get();
    $bookings_archive = Booking::select('bookings.id','post_trips.id as trip_id','bookings.posted_by','bookings.status','bookings.applied_by','bookings.trip_id','bookings.created_at','bookings.origin','bookings.destination','bookings.seats','bookings.message','bookings.amount')->join('post_trips','bookings.trip_id','post_trips.id')->where('bookings.posted_by',Auth::user()->id)->where('bookings.status','!=','pending')->get();
    //dd( $bookings);
    return view('rides.request-trip',compact('bookings','bookings_archive'));
  }
  public function cancel_trip($id)
  {
    $cancel = PostTrip::find($id);
    return view('rides.cancel-trip', compact('cancel'));
  }
  public function confirm_trip($id)
  {
    $confrim_trip = PostTrip::where('id', $id)->update([
      'status' => 'cancel'
    ]);
    return redirect('tripdetail/' . $id)->with('success', 'Your trip was successfully cancelled');
  }


  public function get_trip_details(Request $request)
  {
    try {
      $id = $request->id;
      if ($id) {
        $trip = PostTrip::where("id", $id)->first();
        $origin = City::where('id',$trip->origin)->first();
        $destination = City::where('id',$trip->destination)->first();
        return response()->json(['data' => $trip, 'destination'=>$destination,'origin'=>$origin, 'status' => 'success']);
      } else {
        return response()->json(['data' => "no record found", 'status' => 'failed']);
      }
    } catch (\Exception $e) {
      throw new HtmlExtension(500, $e->getMessage());
    }
  }



  public function search_stops(Request $request)
  {
    try {
      $city = $request->city;
      $stops = City::where('name', 'LIKE', '%'.$city.'%')->get();
      if ($stops) {
        return response()->json(['data' => $stops, 'status' => 'success']);
      } else {
        return response()->json(['data' => "no record found", 'status' => 'failed']);
      }
    } catch (\Exception $e) {
      throw new HtmlExtension(500, $e->getMessage());
    }
  }
}
