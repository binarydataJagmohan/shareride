<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Mail;
use Carbon\Carbon;
use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $email = Auth::user()->email;
            Session::flash('success',"Confirmation e-mail sent to ".$email."."); 
            return view('auth.user.welcome',compact('email'));
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->verify_email = $request->email;
            Mail::send('VerifyMail', [], function ($message) use ($request) {
                $message->from('demo93119@gmail.com', "Share Ride");
                $message->subject("Please verify your email address");
                $message->to($request->email);
            });

            $user->save();
            return redirect()->back();
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function verify_phone()
    {
        try {
            return view('auth.user.phone');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function save_verify_phone(Request $request)
    {
        try {
            // $mobile = User::where("mobile_no",$request->mobile_no)->count();
            // if($mobile > 0){
            //     return redirect()->back()->with('error','phone number already in use.');
            // }
            User::where('id',Auth::user()->id)->update(['mobile_no'=>$request->mobile_no]);
            return redirect('/details')->with('success','Your phone number is verified.');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    public function profile_upload(){
        try{
            return view("auth.user.profile-upload");
        }catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    public function save_profile(Request $request){
        try{
            $img = $request->file('profile_photo');
            $imgName = time().'_'.rand(1,9999).$img->getClientOriginalName();
            $result = $img->move(public_path('images/profile'),$imgName);
            if($result){
                User::where('id',Auth::user()->id)->update(['img'=>'images/profile/'.$imgName]);
            }
            return redirect()->back()->withSuccess('Profile photo successfully updated');
        }catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function details()
    {
        try {
            return view('auth.user.detail');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    public function description()
    {
        try {
            return view('auth.user.description');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    public function save_description(Request $request)
    {
        try {
            if($request->description != null || ""){
                User::where('id',Auth::user()->id)->update(['description'=>$request->description,'status'=>'active']);
                return view('auth.user.toc');
            }else{
                return redirect()->back()->withError('Description required');
            }
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    public function t_and_c(Request $request)
    {
        try {
            // return $request->all();
            if($request->toc){
                User::where('id',Auth::user()->id)->update(['term_condition'=>$request->toc]);
                return redirect('dashboard')->withSuccess('Your account successfully created');
            }else{
                return redirect()->back()->withSuccess('Your account successfully created');
            }
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function save_details(Request $request)
    {
        try {
            if($request->is_driver){
                $is_driver = 1;
            }else{
                $is_driver = 0;
            }
            $dob = Carbon::createFromFormat('Y-m-d', $request->year.'-'.$request->month.'-'.$request->day);
            User::where('id',Auth::user()->id)->update(['is_driver'=>$is_driver,'dob'=>$dob,'gender'=>$request->gender]);
              return redirect('profile-upload')->with('success','Your details successfully stored.');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
     public function password_reset()
    {
        try {
            return view('auth.user.password-reset');
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
}
