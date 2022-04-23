<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//====================================== Driver route =============================================
Route::get('/get-vehicletype',[App\Http\Controllers\ApiController\DriversController::class, 'fetchVehicleType']);
Route::post('/create-driver',[App\Http\Controllers\ApiController\DriversController::class, 'driverRegister']);
Route::post('/driver-login', [App\Http\Controllers\ApiController\DriverLoginController::class, 'login']);
Route::get('/fetch-Trips',[App\Http\Controllers\ApiController\DriversController::class, 'fetchDriverTrips']);
Route::get('/fetchDriverVehicleDetaile', [App\Http\Controllers\ApiController\DriversController::class, 'fetchVehicleDetailes']);
Route::post('/updateDriverVehicleDetaile', [App\Http\Controllers\ApiController\DriversController::class, 'updateDriverVehicleDetails']);
Route::get('/fetch-driver',[App\Http\Controllers\ApiController\DriversController::class, 'fetchDriver']);
Route::post('/update-driver', [App\Http\Controllers\ApiController\DriversController::class, 'updateDriver']);
Route::post('/update-password', [App\Http\Controllers\ApiController\DriversController::class, 'updatePassword']);
Route::get('/fetch-bookings',[App\Http\Controllers\ApiController\DriversController::class, 'Bookings']);



//===================================== passenger route =============================================
Route::post('/create-passenger',[App\Http\Controllers\ApiController\PassengersController::class, 'passengersRegister']);
Route::post('/passengerlogin', [App\Http\Controllers\ApiController\PassengersController::class, 'passengerslogin']);
Route::get('/fetch-passenger',[App\Http\Controllers\ApiController\PassengersController::class, 'fetchPassenger']);
Route::post('/update-passenger', [App\Http\Controllers\ApiController\PassengersController::class, 'updatepassenger']);
// Route::get('/fetch-BookingsAndTrips',[App\Http\Controllers\ApiController\PassengersController::class, 'fetchPassengerTrips']);
Route::post('/update-password', [App\Http\Controllers\ApiController\PassengersController::class, 'updatePassword']);
