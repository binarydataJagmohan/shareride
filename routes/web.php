<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\FacebookSocialiteController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostTripController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TripRequestController;
use App\Http\Controllers\BookTripController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PayPalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/privacy-policy', function () {
    return view('privacy');
});
Route::get('/terms', function () {
    return view('terms');
});


Route::get('/home', function () {
    switch (true) {
        case (Auth::user()->verify_email == 1):
            return redirect('welcome/phone');
            break;
        case (Auth::user()->status == 'active'):
            return redirect('/dashboard');
            break;
         case ((Auth::user()->mobile_no == '') && (Auth::user()->status == 'pending')):
            return redirect('welcome/phone');
            break;
        case ((Auth::user()->dob == '') && (Auth::user()->status == 'pending')):
            return redirect('/details');
            break;
        case ((Auth::user()->img == '') && (Auth::user()->status == 'pending')):
            return redirect('/profile-upload');
            break;
         case ((Auth::user()->description == '') && (Auth::user()->status == 'pending')):
            return redirect('/description');
            break;
        case (Auth::user()->status == 'pending'):
            return redirect('/welcome/email');
            break;
        default:
        return redirect('/login');
            break;
    }
})->middleware('auth');

Auth::routes();

Route::get('/trip/choose',[DashboardController::class,'choose'])->name('choose')->middleware('auth');
Route::get('/trip/instruction',[DashboardController::class,'instruction'])->name('instruction')->middleware('auth');;
Route::get('/trip/request',[DashboardController::class,'request'])->name('request')->middleware('auth');;
Route::get('/find',[DashboardController::class,'find'])->name('find');
Route::post('/find-trip',[DashboardController::class,'find_trip']);
Route::get('/tripdetail/{id}',[DashboardController::class,'tripdetail'])->name('tripdetail')->middleware('auth');;
Route::get('/account',[AccountController::class,'account'])->name('account')->middleware('auth');;
Route::post('/update-account',[AccountController::class,'update_account'])->middleware('auth');;
Route::get('/update-vehicle',[AccountController::class,'vehicle'])->middleware('auth');;
Route::get('/edit-vehicle',[AccountController::class,'edit_vehicle']);
Route::post('/delete-vehicle/{id}',[AccountController::class,'delete_vehicle'])->middleware('auth');;
Route::post('/update-vehicle',[AccountController::class,'update_vehicle'])->middleware('auth');;
Route::get('/language',[AccountController::class,'language'])->middleware('auth');;
Route::post('/language',[AccountController::class,'update_language'])->middleware('auth');;
Route::get('account/notifications',[AccountController::class,'account_notification'])->name('notification')->middleware('auth');;
Route::get('/account/security',[AccountController::class,'security'])->name('security')->middleware('auth');;
Route::get('/account/verification',[AccountController::class,'verification'])->name('verification')->middleware('auth');;
Route::get('/payment',[AccountController::class,'payment'])->name('payment')->middleware('auth');;
Route::get('/payout',[AccountController::class,'payout'])->name('payout');
Route::get('/help/start',[AccountController::class,'help'])->name('help');
Route::get('/account/social/connection',[AccountController::class,'socialaccount'])->name('social');
Route::get('/password/change',[AccountController::class,'changepassword'])->name('changepassword');

// Facebook Login URL
Route::get('auth/facebook', [FacebookSocialiteController::class, 'redirectToFB']);
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleCallback']);

Route::get('authorized/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::middleware(['auth'])->group(function () {
   Route::get('/welcome/email', [App\Http\Controllers\Auth\UserController::class, 'index']);
   Route::post('/verify-email', [App\Http\Controllers\Auth\UserController::class, 'store']);
    Route::get('/welcome/phone', [App\Http\Controllers\Auth\UserController::class, 'verify_phone']);
    Route::post('/save-phone', [App\Http\Controllers\Auth\UserController::class, 'save_verify_phone']);
    Route::get('/details', [App\Http\Controllers\Auth\UserController::class, 'details']);
    Route::post('/save-details', [App\Http\Controllers\Auth\UserController::class, 'save_details']);
    Route::get('/profile-upload', [App\Http\Controllers\Auth\UserController::class, 'profile_upload']);
    Route::post('/profile-upload', [App\Http\Controllers\Auth\UserController::class, 'save_profile']);
    Route::get('/description', [App\Http\Controllers\Auth\UserController::class, 'description']);
    Route::post('/description', [App\Http\Controllers\Auth\UserController::class, 'save_description']);
    Route::post('/toc', [App\Http\Controllers\Auth\UserController::class, 't_and_c']);
    
    Route::get('/password/reset/done', [App\Http\Controllers\Auth\UserController::class, 'password_reset']);
    Route::get('/account/close',[AccountController::class,'close'])->name('account_close');
    Route::post('account/close',[Accountcontroller::class,'deactive'])->name('deactive');
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dash');
    Route::get('/request-trip', 'App\Http\Controllers\PostTripController@request_trip');
    Route::get('/cancel-trip/{id}', 'App\Http\Controllers\PostTripController@cancel_trip');
    Route::post('/confirm-trip/{id}', 'App\Http\Controllers\PostTripController@confirm_trip');
    
    Route::get('/request-view/{id}', 'App\Http\Controllers\DashboardController@single_request');
    Route::post('/request-delete/{id}', 'App\Http\Controllers\TripRequestController@request_delete');
    Route::get('request/edit/{id}',[TripRequestController::class,'edit']);
    Route::post('request/update/{id}',[TripRequestController::class,'update'])->name('updaterequest');

    Route::get('/password/change',[DashboardController::class,'change_password']);
    Route::post('/password/change',[DashboardController::class,'save_password']);
    
    Route::post('/update-phone',[AccountController::class,'update_phoneNo']);

    Route::get('/payment-setting',[AccountController::class,'payment_setting']);
    Route::post('/payment-store',[AccountController::class,'payment_store']);

    Route::get('/payouts-setting',[AccountController::class,'payouts_setting']);
    Route::get('/payouts-method',[AccountController::class,'payouts_method']);

    Route::get('/payment',[PayPalController::class,'payment'])->name('payment');
    Route::get('/cancel',[PayPalController::class,'cancel'])->name('payment.cancel');
    Route::get('/payment/success',[PayPalController::class,'success'])->name('payment.success');

    });

    Route::get('notification',[AccountController::class,'notification'])->middleware('auth');
    Route::get('confirm-booking/{id}',[AccountController::class,'confirm_booking'])->middleware('auth');
    Route::get('cancel-booking/{id}',[AccountController::class,'cancel_booking'])->middleware('auth');
    Route::get('trip/offer',[PostTripController::class,'index'])->name('offer')->middleware('auth');
    Route::post('trip/post',[PostTripController::class,'store'])->name('posttrip')->middleware('auth');
    Route::post('get-trip-details',[PostTripController::class,'get_trip_details'])->middleware('auth');
    Route::post('request/add',[TripRequestController::class,'store'])->name('triprequest');
    Route::get('edit/{id}',[PostTripController::class,'edit'])->name('edit')->middleware('auth');
    Route::post('search-stops',[PostTripController::class,'search_stops']);
    //Route::get('travel',[DashboardController::class,'search'])->name('travels');
   Route::get('book/trip/{id}',[BookTripController::class,'index'])->name('booktrip')->middleware('auth');
   Route::get('booking/{id}',[BookTripController::class,'booking'])->name('booking')->middleware(['auth','ptb']);
   Route::post('getseatprice',[BookTripController::class,'getseatprice'])->name('gsp')->middleware('auth');
   Route::post('save-booking',[BookTripController::class,'save_booking'])->middleware('auth');
   Route::put('trip/update/{id}',[PostTripController::class,'update'])->name('updatetrip');
   Route::get('my_booking',[BookTripController::class,'my_booking'])->name('my_booking');

   Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
   Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
   Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
   Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

