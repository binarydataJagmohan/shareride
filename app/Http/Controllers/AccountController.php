<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\PostTrip;
use Mail;
use App\Models\Notification;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function account()
    {
        try {
            $user = User::findOrFail(Auth::user()->id);
            return view('account.account', compact('user'));
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    public function update_account(Request $request)
    {
        try {
            $dob = Carbon::createFromFormat('Y-m-d', $request->dob_year . '-' . $request->dob_month . '-' . $request->dob_date);
            User::where('id', Auth::user()->id)->update(['name' => $request->name, 'is_driver' => $request->is_driver, 'last_name' => $request->last_name, 'description' => $request->description, 'dob' => $dob, 'gender' => $request->gender]);
            return redirect('account')->withSuccess("Account successfully updated");
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    public function update_phoneNo(Request $request)
    {
        try {
            User::where('id', Auth::user()->id)->update(['mobile_no' => $request->number]);
            return redirect()->back()->withSuccess("Mobile No successfully updated");
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }


    public function vehicle()
    {
        try {
            $vehicle = VehicleModel::where('user_id', Auth::user()->id)->where('status', '!=', 'deleted')->first();
            return view('account.vehicle', compact('vehicle'));
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function update_vehicle(Request $request)
    {
        try {
            $other = json_encode($request->others);
            //  return $other;
            if ($request->img) {
                $img = $request->file('img');
                $img_name = time() . '_' . rand(1, 9999) . $img->getClientOriginalName();
                $img->move(public_path('images/vehicle'), $img_name);
            }

            if ($request->vehicle_id != null || "") {
                if ($request->img) {
                    $vehicle = VehicleModel::where('id', $request->vehicle_id)->update([
                        'brand' => $request->car_brand,
                        'model' => $request->car_model_name,
                        'type' => $request->type,
                        'color' => $request->color,
                        'year' => $request->year,
                        'licence_no' => $request->licence,
                        // 'luggage'=>$request->luggage,
                        //  'back_row_seat'=>$request->back_sitting,
                        // 'others'=>$other,
                        'img' => 'images/vehicle/' . $img_name
                    ]);
                } else {
                    $vehicle = VehicleModel::where('id', $request->vehicle_id)->update([
                        'brand' => $request->car_brand,
                        'model' => $request->car_model_name,
                        'type' => $request->type,
                        'color' => $request->color,
                        'year' => $request->year,
                        'licence_no' => $request->licence,
                        //'luggage'=>$request->luggage,
                        //'back_row_seat'=>$request->back_sitting,
                        //'others'=>$other
                    ]);
                }
            } else {
                $vehicle = new VehicleModel;
                $vehicle->user_id = Auth::user()->id;
                $vehicle->brand = $request->car_brand;
                $vehicle->model = $request->car_model_name;
                $vehicle->type = $request->type;
                $vehicle->color = $request->color;
                $vehicle->year = $request->year;
                //$vehicle->licence_no = $request->licence;
                //$vehicle->luggage = $request->luggage;
                //$vehicle->back_row_seat = $request->back_sitting;
                $vehicle->img = 'images/vehicle/' . $img_name;
                //$vehicle->others = $other;
                $vehicle->save();
            }
            return redirect('update-vehicle');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function edit_vehicle()
    {
        try {
            $vehicle = VehicleModel::where('user_id', Auth::user()->id)->where('status', '!=', 'deleted')->first();
            return view('account.edit-vehicle', compact('vehicle'));
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    //   public function delete_vehicle(Request $request)
    //   {
    //       try{
    //           $vehicle = VehicleModel::where('id',$request->vehicle_id)->first();
    //           $vehicle->delete();
    //           return redirect('update-vehicle');
    //       } catch (\Exception $e) {
    //          throw new HttpException(500, $e->getMessage());
    //      }
    //   }
    public function delete_vehicle(Request $request, $id)
    {
        try {
            $postTrips = PostTrip::where('vehicle_id', $request->vehicle_id)->get();
            if ($postTrips->isNotEmpty()) {
                foreach ($postTrips as $postTrip) {
                    $postTrip->vehicle_id = null;
                    $postTrip->save();
                    //  $postTrip->update(['status' => 'cancel']);
                }
            }
            $vehicleModel  = VehicleModel::where('id', $id)->update([
                'status' => 'deleted'
            ]);
            return redirect('update-vehicle');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }


    public function language()
    {
        return view('account.language');
    }


    public function update_language(Request $request)
    {
        //   return $request->all();
        User::where('id', Auth::user()->id)->update(['language' => $request->language]);
        return redirect()->back()->withSuccess('language successfully updated');
    }
    public function notification()
    {
        $notification = Notification::where('notify_to', Auth::user()->id)->latest();
        $count = $notification->count();
        $notifications = $notification->get();
        $notify = Notification::where('notify_to', Auth::user()->id)->update([
            'status' => 'seen'
        ]);
        //   dd($notifications);
        return view('rides.notification', compact('notifications', 'count'));
    }

    public function account_notification()
    {
        return view('notification');
    }

    public function confirm_booking($id)
    {
        $booking = Booking::find($id);
        $notification = Booking::where('posted_by', Auth::user()->id);
        $trip = PostTrip::where('id', $booking->trip_id)->first();
        $total_seats = $trip->seats;
        $notif_to = User::find($booking->applied_by);
        if ($total_seats < $booking->seats) {
            return redirect()->back()->withError('No seats available');
        } else {
            $seat = $total_seats - $booking->seats;
            Booking::where('id', $id)->update(['status' => 'approvered']);
            $notify = new Notification();
            $notify->trip_id = $booking->trip_id;
            $notify->notify_by  = Auth::user()->id;
            $notify->booking_id   = $booking->id;
            $notify->notify_to   = $notif_to->id;
            $notify->notification_type   = 'confirmation';
            $notify->notification_desc = "your booking confirmed";
            $notify->save();

            $trip = PostTrip::where('id', $booking->trip_id)->update(['seats' => $seat]);
        }

        //   $email = $data->email;
        $name = Auth::user()->name;
        $data = [
            'email' => $notif_to->email,
            'name' => Auth::user()->name,
            'origin' => $booking->origin,
            'destination' => $booking->destination
        ];
        Mail::send('confirmBookingMail', ['data1' => $data], function ($message) use ($data) {
            $message->from('demo93119@gmail.com', "Share Ride");
            $message->subject('Welcome to Share-ride, ' . $data['name'] . '!');
            $message->to($data['email']);
        });
        return redirect()->back()->withSuccess('Booking successfully approved');
    }
    public function cancel_booking($id)
    {
        $booking = Booking::find($id);
        $notif_to = User::find($booking->applied_by);
        Booking::where('id', $id)->update(['status' => 'cancelled']);
        $notify = new Notification();
        $notify->trip_id = $booking->trip_id;
        $notify->notify_by  = Auth::user()->id;
        $notify->booking_id   = $booking->id;
        $notify->notify_to   = $notif_to->id;
        $notify->notification_type   = 'cancelled';
        $notify->notification_desc = "your booking cancelled";
        $notify->save();
        $data = [
            'email' => $notif_to->email,
            'name' => Auth::user()->name,
            'origin' => $booking->origin,
            'destination' => $booking->destination
        ];
        Mail::send('cancelBookingMail', ['data1' => $data], function ($message) use ($data) {
            $message->from('demo93119@gmail.com', "Share Ride");
            $message->subject('Welcome to Share-ride, ' . $data['name'] . '!');
            $message->to($data['email']);
        });
        return redirect()->back()->withSuccess('Booking successfully cancelled');
    }
    public function security()
    {
        return view('security');
    }
    public function verification()
    {
        return view('verification');
    }
    public function payment()
    {
        return view('payments');
    }
    public function payout()
    {
        return view('payouts');
    }
    public function help()
    {
        return view('help');
    }
    public function socialaccount()
    {
        return view('account.socialaccount');
    }
    public function close()
    {
        return view('accountclose');
    }
    public function deactive(Request $request)
    {
        $user = Auth::user();
        $user->status = 'deleted';
        $user->save();

        // Log out the user
        Auth::logout();
        return redirect('/login')->with('error', 'Uh oh, something isn' . 't quite right! See errors below');
    }
    public function changepassword()
    {
        return view('account.change-password');
    }
    public function payment_setting()
    {
        try {
            return view('payment-setting');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    public function payment_store(Request $request)
    {
        try {
            $user = User::where('id', Auth::user()->id)->update([
                'cardholder_name' => $request->cardholder_name,
                'card_number' => $request->card_number,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year
            ]);
            return redirect()->back()->with('success', 'Card detial stored successfully');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    public function payouts_setting()
    {
        try {
            return view('payout-settings');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    public function payouts_method()
    {
        try {
            return view('payout-method');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
}
