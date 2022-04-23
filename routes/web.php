<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();




//! --------------Front End Routes Begin----------------

Route::get('/', 'App\Http\Controllers\HomeController@index');

//! --------------Front End Routes End----------------











//! --------------Back End Routes Begin----------------



//? --------------Admin Routes Begin----------------

// Route::group( ['middleware' => ['admin']], function ($router){


//             Route::prefix('/admin')->name('admin.')->group(function () {

                 /** This is the fallback route */
                // Route::get('/{any?}', [App\Http\Controllers\Admin\AdminController::class, 'index']);
                /** This is the fallback route */

//         });
// });

//? --------------Admin Routes End----------------




//? --------------User Routes Begin----------------

Route::group( ['middleware' => ['auth']], function ($router){

        Route::prefix('/user')->name('user.')->group(function () {

            /** This is the fallback route */
                Route::get('/{any?}', [App\Http\Controllers\User\UserController::class, 'index']);
            /** This is the fallback route */
            Route::get('/fetch/admin',[App\Http\Controllers\User\AdminController::class, 'index']);
            Route::post('/create/admin',[App\Http\Controllers\User\AdminController::class, 'store']);
            Route::put('/update/admin', [App\Http\Controllers\User\AdminController::class, 'update']);
            Route::post('/destroy/admin', [App\Http\Controllers\User\AdminController::class, 'destroy']);
          
            Route::get('/fetch/vehicleTypes',[App\Http\Controllers\User\VehicleTypesController::class, 'index']);
            Route::post('/create/vehicleTypes',[App\Http\Controllers\User\VehicleTypesController::class, 'store']);
            Route::put('/update/vehicleTypes', [App\Http\Controllers\User\VehicleTypesController::class, 'update']);
            Route::post('/destroy/vehicleTypes', [App\Http\Controllers\User\VehicleTypesController::class, 'destroy']);

            Route::get('/fetch/drivers',[App\Http\Controllers\User\UserController::class, 'fetchDrivers']);
            Route::get('/fetch/driver-ratings',[App\Http\Controllers\User\UserController::class, 'fetchDriverratings']);
            Route::get('/fetch/bookings',[App\Http\Controllers\User\UserController::class, 'fetchBookings']);
            Route::get('/fetch/trips',[App\Http\Controllers\User\UserController::class, 'fetchTrips']);
            
            // Route::post('/create/vehicles',[App\Http\Controllers\User\VehiclesController::class, 'store']);
            // Route::put('/update/vehicles', [App\Http\Controllers\User\VehiclesController::class, 'update']);
            // Route::post('/destroy/vehicles', [App\Http\Controllers\User\VehiclesController::class, 'destroy']);
            // Route::get('/fetch/vehicleTypes',[App\Http\Controllers\User\VehiclesController::class, 'fetchVehicleTypes']);
          
        });
});


//? --------------User Routes End----------------






//? --------------routes multi authentication----------------

// Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm');
// Route::get('/register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegisterForm');


// Route::post('/login/admin', 'App\Http\Controllers\Auth\LoginController@adminLogin');
// Route::post('/register/admin', 'App\Http\Controllers\Auth\RegisterController@createAdmin');


//? --------------routes for multi authentication----------------




//! --------------Back End Routes End----------------
