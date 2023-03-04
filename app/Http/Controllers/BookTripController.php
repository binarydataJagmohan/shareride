<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\VehicleModel;
use App\Models\PostTrip;
use App\Models\Trip_Payment;
use App\Models\User;
use Auth;
use DB;
use App\Models\Notification;

class BookTripController extends Controller
{
  public function index($id)
  {
      
    $trip =    PostTrip::where('id', $id)->get();
    return view('booking', ['trips' => $trip]);
    
  }

  public function booking($id)
  {
    $trip = PostTrip::where('id', $id)->first();
    //dd($trip);
     return view('book-trip', compact('trip'));
    
  }
  public function getseatprice(Request $request)
  {
    $trip = PostTrip::find($request->seats);
    //dd($trip);
    $seat = $trip->seats;
    $price = $trip->pricing;
    $total_price = $price * $seat;
    return response()->json(['total_price' => $total_price]);
  }

  public function save_booking(Request $request)
  {
     //return $request->all();
    $booking = new Booking();
    $booking->trip_id = $request->trip_id;
    $booking->seats = $request->seat;
    $booking->amount = $request->price;
    $booking->message   = $request->message;
    $booking->origin   = $request->session()->get('origin');
    $booking->destination   = $request->session()->get('destination');
    $booking->posted_by = $request->user_id;
    $booking->applied_by   = Auth::user()->id;
    $booking->save();
    $request->session()->forget('origin');
    $request->session()->forget('destinatiHelpon');
    $request->session()->put('booking', $booking);
    
    $notify = new Notification();
    $notify->trip_id = $request->trip_id;
    $notify->notify_by  = Auth::user()->id;
    $notify->notify_to   = $request->user_id;
    $notify->booking_id   = $booking->id;
    $notify->notification_type   = 'Booking';
    $notify->notification_desc =$request->message;
    $notify->save();
    
    return redirect('dashboard')->withSuccess("Trip booked successfully");
  }
  
  public function my_booking()
  {
        
        $booked_trips = Booking::all();
        $user_bookings =  $booked_trips->where('applied_by', Auth::user()->id);
      
       return view('My_booking',compact('user_bookings'));
  }

  public function review($id)
   {
        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = [];

        $reviews = DB::table('review_table')->where('review_to',$id)->orderBy('id', 'desc')->get();
        //echo "<pre>";
        //print_r($reviews );
        //die;

        foreach ($reviews as $review) {
            $review_content[] = [
                'user_name' => $review->user_name,
                'user_review' => $review->user_review,
                'rating' => $review->user_rating,
                //'datetime' => date('l jS, F Y h:i:s A', $review->datetime)
            ];

            if ($review->user_rating == '5') {
                $five_star_review++;
            }

            if ($review->user_rating == '4') {
                $four_star_review++;
            }

            if ($review->user_rating == '3') {
                $three_star_review++;
            }

            if ($review->user_rating == '2') {
                $two_star_review++;
            }

            if ($review->user_rating == '1') {
                $one_star_review++;
            }

            $total_review++;

            $total_user_rating = $total_user_rating + $review->user_rating;
        }

        if ($total_review > 0) {
        $average_rating = $total_user_rating / $total_review;
        }     
        else 
        {
       $average_rating = 0;
}

        $output = [
            'average_rating' => number_format($average_rating, 1),
            'total_review' => $total_review,
            'five_star_review' => $five_star_review,
            'four_star_review' => $four_star_review,
            'three_star_review' => $three_star_review,
            'two_star_review' => $two_star_review,
            'one_star_review' => $one_star_review,
            'review_data' => $review_content
        ];
        
        $data['output'] = $output;
        return view('review',$data);
    }
    
  
  public function review_Save(Request $request)
  {
    $user_id = $request->input('user_id');
    $reviewed_user_id = Auth::id();
    $existing_review = DB::table('review_table')
                    ->where('review_by', $reviewed_user_id)
                    ->where('review_to',$user_id)
                    ->first();
     //dd($existing_review);
      if ($existing_review ) 
      {
      return "You have already rated this user.";
      }
     else
     {
             $data = [
            'user_name' =>  $request->input('user_name'),
            'review_by' =>  Auth::id(),
            'review_to' =>  $request->input('user_id'),
            'avg_rating' => $request->input('avg_rating'),
            'user_rating' => $request->input('rating_data'),
            'user_review' => $request->input('user_review'),
            
        ];

           DB::table('review_table')->insert($data);

        return "Your Review & Rating Successfully Submitted";
       }
     }
  }

