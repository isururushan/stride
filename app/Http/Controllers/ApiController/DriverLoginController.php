<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Drivers;
use App\Models\Trips;
use App\Models\Passengers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class DriverLoginController extends Controller
{
    function login(Request $request)
    {
        $fields = $request->validate([
        'email' => 'required',
        'password' => 'required'
      ]);
      //Check email
      $driver = Drivers::where('email', $fields['email'])->first();
        
      //Check password
      if(!$driver || !Hash::check($fields['password'], $driver->password))
        {
            return response([
            'message' => 'Bad Credentials'
            ], 401);
        }     
      $response = [
        'driver' => $driver,
      ];

      return response($response, 201);
    }

}

