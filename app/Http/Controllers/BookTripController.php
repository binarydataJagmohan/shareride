<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\PostTrip;
use Auth;
use App\Models\Notification;
use App\Models\TripPayment;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
    return view('book-trip', compact('trip'));
  }
  public function getseatprice(Request $request)
  {
    $trip = PostTrip::find($request->seats);
    $seat = $trip->seats;
    $price = $trip->pricing;
    $total_price = $price * $seat;
    return response()->json(['total_price' => $total_price]);
  }

  public function save_booking(Request $request)
  {
    try {
      Stripe::setApiKey(env('STRIPE_SECRET'));
      $amount = $request->price * 100;
      $customer = Customer::create([
        'name' => Auth::user()->name,
        'email' => Auth::user()->email
      ]);

      $token = \Stripe\Token::create([
        'card' => [
          'name' => request('cardholder_name'),
          'number' => request('card_number'),
          'exp_month' => request('exp_month'),
          'exp_year' => request('exp_year'),
          'cvc' => request('cvc')
        ],
      ]);
      $customer->sources->create(['source' => $token->id]);

      $charge = Charge::create([
        'amount' => $amount,
        'currency' => 'usd',
        'customer' => $customer->id,
        'source' => $customer->default_source
      ]);

      if ($charge) {
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

        $bookings = new TripPayment();
        $bookings->booking_id = $booking->id;
        $bookings->user_id = Auth::user()->id;
        $bookings->amount = $request->price;
        $bookings->transaction_id = $charge->id;
        $bookings->payment_method   = $charge->status;
        $bookings->save();

        $notify = new Notification();
        $notify->trip_id = $request->trip_id;
        $notify->notify_by  = Auth::user()->id;
        $notify->notify_to   = $request->user_id;
        $notify->booking_id   = $booking->id;
        $notify->notification_type   = 'Booking';
        $notify->notification_desc = $request->message;
        $notify->save();
        return redirect('dashboard')->withSuccess("Trip booked successfully");
      } else {
        return redirect('dashboard')->withSuccess("Trip booked unsuccessfully");
      }
    } catch (\Exception $e) {
      throw new HttpException(500, $e->getMessage());
    }
  }

  public function my_booking()
  {
    $booked_trips = Booking::all();
    $user_bookings =  $booked_trips->where('applied_by', Auth::user()->id);

    return view('My_booking', compact('user_bookings'));
  }
}
