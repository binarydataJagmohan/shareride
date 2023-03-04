<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\PostTrip;
use App\Models\TripRequest;
use App\Models\VehicleModel;
use App\Models\User;
use Auth;
use DB;
use Carbon\Carbon;
use Symfony\Component\CssSelector\XPath\Extension\HtmlExtension;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = PostTrip::all();
        // Filter the bookings by the user ID
        $user_bookings = $bookings->where('user_id', Auth::user()->id)->where('status', '!=', 'cancel');
        $request = TripRequest::all();
        $user_request = $request->where('user_id', Auth::user()->id)->where('status', '!=', 'deleted');
        return view('rides/dashboard', ['bookings' => $user_bookings, 'requests' => $user_request]);
    }
    public function choose()
    {
        return view('rides.choose');
    }
    public function instruction()
    {
        return view('rides.instruction');
    }
    public function request()
    {
        return view('rides.postrequest');
    }
    public function find(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $date = $request->input('date');
        $trips = PostTrip::where('origin', $origin)
            ->where('destination', $destination)
            ->get();
        return view('find', ['trip' => $trips]);
    }
    public function tripdetail($id)
    {
        $user = Auth::user();
        $vehicle = VehicleModel::where('user_id', $user->id)->where('status','!=','deleted')->first();
        $trip =    PostTrip::where('id', $id)->get();
        return view('rides.tripdetails', ['vehicls' => $vehicle, 'trips' => $trip]);
    }

    public function single_request(Request $request, $id)
    {
        $data = TripRequest::where('id', $id)->where('user_id', Auth::user()->id)->get();
        return view('rides.single-request', compact('data'));
    }
    public function change_password()
    {
        return view('change-password');
    }
    public function save_password()
    {
        return view('change-password');
    }


    public function find_trip(Request $request)
    {
        try {
            $origin = $request->input('origin');
            $destination = $request->input('destination');
            $origin_name = City::where('id',$origin)->first();
            $destination_name = City::where('id',$destination)->first();
            $date = $request->input('date');
            $currentDate = Carbon::now();
            $date = date('Y-m-d');
            
            $trips = [];
            $all_trips = PostTrip::all();
            
            foreach ($all_trips as $trip) {
                
                $stops = json_decode($trip->stop);
                if ($trip->origin == $origin && $trip->destination == $destination) {
                    if ($trip->start_date >=  $date) {
                array_push($trips, $trip);
            }
                }
                if($trip->stop != null){
                    if($trip->origin == $origin && in_array($destination, $stops)){
                    if ($trip->start_date >=  $date) {
                  array_push($trips, $trip);
            }
                    }
                    
                    elseif($trip->destination == $destination && in_array($origin, $stops)){
                        if ($trip->start_date >=  $date) {
                array_push($trips, $trip);
            }
                    } else {
                    $stops = json_decode($trip->stop);
                    if (in_array($origin, $stops) && in_array($destination, $stops) ) {
                        if ($trip->start_date >=  $date) {
                array_push($trips, $trip);
            }
                    }
                }
                }
                               
                
            }
            
            if($trips != null){
                $request->session()->put('origin', $origin);
                $request->session()->put('destination', $destination);
            }
            return view('find', ['trip' => $trips,'origin'=>$origin_name,'destination'=>$destination_name]);
        } catch (\Exception $e) {
            throw new HtmlExtension(500, $e->getMessage());
        }
    }
}
