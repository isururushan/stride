<?php

namespace App\Http\Controllers\ApiController;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle_types;
use App\Models\Vehicles;
use App\Models\Drivers;
use App\Models\Bookings;
use App\Models\Trips;
use App\Models\Passengers;
use App\Models\Documents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PassengersController extends Controller
{

    public function passengersRegister(Request $request)
    {
        {
            try
            {
                $request->validate([
                    'first_name' => 'required',
                    'last_name'=> 'required',
                    'email' => 'required|email|unique:email',
                    'address' => 'required',
                    'telephone' => 'required',
                    'password' => 'required',

                ]);

                $passenger_first_name = $request->first_name;
                $passenger_last_name = $request->last_name;
                $passenger_email = $request->email;
                $passenger_password=$request->password;
                $passenger_telephone = $request->telephone;
                 
                $passengers['first_name'] = $passenger_first_name;
                $passengers['last_name'] = $passenger_last_name;
                $passengers['email'] = $passenger_email;
                $passengers['telephone'] = $passenger_telephone;
                $passengers['password'] = Hash::make($passenger_password);

                $result = Passengers::create($passengers);

                if($result)
                {
                    return response([
                        ['response' => 'success']
                    ], 201);
                }
                else
                {
                    return response([
                        ['response' => 'error']
                    ], 500);
                }
            }

            catch (Exception $ex)
            {
                return response([
                    ['response' => $ex]
                ], 500);
            }
        }

    }
    
//========================================================================================

    public function passengerslogin(Request $request)
    {
        $fields = $request->validate([
        'email' => 'required',
        'password' => 'required'
      ]);
        
      //Check email
      $passenger = Passengers::where('email', $fields['email'])->first();
        
      //Check password
      if(!$passenger || !Hash::check($fields['password'], $passenger->password))
        {
            return response([
            'message' => 'Bad Credentials'
            ], 401);
        }
        
      $response = [
        'passenger' => $passenger,
      
      ];
        
      return response($response, 201);
    }

//==================================================================================
    public function fetchPassenger(Request $request)
    {
        try
        {   
            $passenger_id = $request->passenger_id;
            
            $passengers = Passengers::where('deleted', 0)->where('id',$passenger_id)->get();

            return response()->json([
                ['response' => $passengers]
            ], 200);

        }
        catch(Exception $ex)
        {
            return response()->json([
                ['response' => 'error']
            ], 500);
        } 
    }
//=========================================================================================
    public function updatepassenger(Request $request){

        $request->validate([
            'first_name'=>'required',
            'last_name'=> 'required',
            'email'=>'required|email|unique:email',
            'address'=>'required'
            
        ]);

        try{

            $id =$request->id;
            $first_name =$request->first_name;
            $last_name =$request->last_name;
            $email=$request->email;
            $address=$request->address;

            $passengers_update = passengers::where('id',$id)
                                        ->update([
                                            'first_name'=>$first_name,
                                            'last_name'=>$last_name,
                                            'email'=>$email,
                                            'address'=>$address,
                                        ]);

            if($passengers_update)
            {
                return response()->json([
                    ['response' => 'passenger Update Successfully..!']
                ], 201);
            }
            else
            {
                return response()->json([
                    ['response' => 'Invalid records']
                ], 500);
            } 

        }
        catch(Exception $ex)
        {
            return response()->json([
                ['response' => 'error']
            ], 500);
        }
    }

//=========================================================================================

    public function updatePassword(Request $request)
    {
        $old_password = $request->old_password;       
        $new_password = $request->new_password;

        $passenger = Passengers::find($request->id);
        // dd(Hash::make($old_password));

            if (!Hash::check($old_password, $passenger->password))
            {
                return response()->json([
                    ['response' => 'The old password does not match our records.']
                ], 500);
            }
            else
            {
                $passengers_password_update = $passenger->update(['password' => Hash::make($new_password)]);

                if($passengers_password_update)
                {
                    return response()->json([
                        ['response' => 'Password Updated Sucessfully']
                    ], 201);
                }
                else
                {
                    return response()->json([
                        ['response' => 'Password not updated.']
                    ], 500);
                } 
            }
        }

        public function fetchPassengerTrips(Request $request){
        
            try
            {
                $passenger_id = $request->passenger_id;
        
                $trips = Trips::where('deleted',0)->where('id','=',$passenger_id)->get();
                $bookings = Bookings::where('deleted',0)->where('id','=',$passenger_id)->get();

        
                return response()->json([
                    ['response' => $trips,$bookings]
                ], 200);
        
            }
                catch(Exception $ex)
                {
                    return response()->json([
                        ['response' => 'error']
                    ], 500);
                } 
                        
            }
}

