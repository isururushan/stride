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
use App\Models\Passengers;
use App\Models\Trips;
use App\Models\Bookings;
use App\Models\Documents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;


class DriversController extends Controller
{
    
    public function index(){

        return User::all();
    }

    public function fetchVehicleType(Request $request)
    {
        try
        {
            $vehicleType = Vehicle_Types::where('active', 1)->where('deleted', 0)->get();

            return response()->json([
                ['response' => $vehicleType]
            ], 200);

        }
        catch(Exception $ex)
        {
            return response()->json([
                ['response' => 'error']
            ], 500);
        } 
    }
//==================================================================================

    public function driverRegister(Request $request){

        {
            try
            {
                $request->validate([
                    'name' => 'required',
                    'make' => 'required',
                    'model'=> 'required',
                    'plate_number'=> 'required',
                    'vehicle_types_id' =>'required',
                    'first_name' => 'required',
                    'last_name'=> 'required',
                    'email' => 'required|email|unique:email',
                    'address' => 'required',
                    'birthday' => 'required',
                    'telephone' => 'required',
                    'password' => 'required',
                    'type' => 'required',
                    // 'document' => 'required',

                ]);
    
                    $driver_vehicle_name = $request->name;
                    $driver_vehicle_make = $request->make;
                    $driver_vehicle_model = $request->model;
                    $driver_vehicle_plate_number = $request->plate_number;
                    $driver_vehicle_types_id =$request->vehicle_types_id;

                    $driver_first_name = $request->first_name;
                    $driver_last_name = $request->last_name;
                    $driver_email = $request->email;
                    $driver_address = $request->address;
                    $driver_birthday = $request->birthday;
                    $driver_telephone = $request->telephone;
                    $driver_image = $request->image;
                    $driver_password=$request->password;

                    $driver_type =$request->type;
                    // $document    =[];
                        
                    $vehicles['name'] = $driver_vehicle_name;
                    $vehicles['make'] = $driver_vehicle_make;
                    $vehicles['model'] = $driver_vehicle_model;
                    $vehicles['plate_number'] = $driver_vehicle_plate_number;
                    $vehicles['vehicle_types_id'] = $driver_vehicle_types_id;

                    $result1 = Vehicles::create($vehicles);

                    $vehicles_id = $result1->id;

                    $imageData = $driver_image;
                    $data = substr($imageData, strpos($imageData, ',') + 1);
                    $data = base64_decode($data);
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                    Storage::disk('public')->put("/drivers/".$fileName , $data);
    
                
                    $drivers['first_name'] = $driver_first_name;
                    $drivers['last_name'] = $driver_last_name;
                    $drivers['email'] = $driver_email;
                    $drivers['address'] = $driver_address;
                    $drivers['birthday'] = $driver_birthday;
                    $drivers['telephone'] = $driver_telephone;
                    $drivers['image'] = $fileName;
                    $drivers['password'] = Hash::make($driver_password);
                    $drivers['vehicles_id'] =$vehicles_id; 

                    $result2 = Drivers::create($drivers);
                
                    $drivers_id = $result2->id;

                    // for($i =0; $i< $document.count(); $i++)

                    // $documentData = $document[$i];
                    // $data = substr($documentData, strpos($documentData, ',') + 1);
                    // $data = base64_decode($data);
                    // $fileName1 = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($documentData, 0, strpos($documentData, ';')))[1])[1];
                    // Storage::disk('public')->put("/documents/".$fileName1 , $data);

                    $documents['type'] = $driver_type;
                    $documents['document'] ="125.pdf";
                    $documents['drivers_id']= $drivers_id;

                    $result3 = Documents::create($documents);              

                if($result1)
                {
                    return response()->json([
                        ['response' => 'Driver Register successfully']
                    ], 201);
                }
                else
                {
                    return response()->json([
                        ['response' => 'Driver Register Not Successfully']
                    ], 501);
                }
            }
            catch (Exception $ex)
            {
                return response()->json([
                    ['response' => $ex]
                ], 500);
            }
        }
    }

//=========================================================================================

    public function fetchDriverTrips(Request $request){
        
    try
    {
        $driver_id = $request->driver_id;

        $trips = Trips::where('deleted',0)->where('id','=',$driver_id)->get();

        return response()->json([
            ['response' => $trips]
        ], 200);

    }
        catch(Exception $ex)
        {
            return rresponse()->json([
                ['response' => 'error']
            ], 500);
        } 
                
    }

//====================================================================================================

    public function fetchVehicleDetailes(Request $request){

        try{
            $driver_id = $request->driver_id;

            $driverVehicleDetailes =Drivers::where('id',$driver_id)->where('deleted',0)->get();

            foreach($driverVehicleDetailes as $driverVehicleDetaile){

                $vehicles = Vehicles::where('id',$driverVehicleDetaile['vehicles_id'])->first();
                $driverVehicleDetaile['name']=$vehicles['name'];
                $driverVehicleDetaile['make']=$vehicles['make'];
                $driverVehicleDetaile['model']=$vehicles['model'];
                $driverVehicleDetaile['plate_number']=$vehicles['plate_number'];
               
            }
            return response()->json([
                ['response' => $driverVehicleDetailes]
            ], 200);

        }
        catch(Exception $ex)
        {
            return response()->json([
                ['response' => 'error']
            ], 500);
        }      
    }

//==========================================================================================================

    public function updateDriverVehicleDetails(Request $request){

        $request->validate([
            'id' =>'required',
            'name'=>'required',
            'make'=> 'required',
            'model'=>'required'
        ]);

        try{
            $id =$request->id;
            $name =$request->name;
            $make =$request->make;
            $model=$request->model;

            $vehicles_update = Vehicles::where('id',$id)
                                        ->update([
                                            'name'=>$name,
                                            'make'=>$make,
                                            'model'=>$model,
                                        ]);

            if($vehicles_update)
            {
                return response()->json([
                    ['response' => 'Vehicle Details Update Successfully']
                ], 201);
            }
            else
            {
                return response()->json([
                    ['response' => 'Invalid Details']
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

//===================================================================================================

    public function fetchDriver(Request $request)
    {
        try
        {   
            $driver_id = $request->driver_id;
            
            $drivers = Drivers::where('deleted', 0)->where('id',$driver_id)->get();

            return response()->json([
                ['response' => $drivers]
            ], 200);

        }
        catch(Exception $ex)
        {
            return response()->json([
                ['response' => 'error']
            ], 500);
        } 
    }

//=================================================================================================

    public function updateDriver(Request $request){

        $request->validate([
            'first_name'=>'required',
            'last_name'=> 'required',
            'email'=>'required',
            'address'=>'required'
            
        ]);

        try{

            $id =$request->id;
            $first_name =$request->first_name;
            $last_name =$request->last_name;
            $email=$request->email;
            $address=$request->address;

            // dd($email);
            $Drivers_update = Drivers::where('id',$id)
                                        ->update([
                                            'first_name'=>$first_name,
                                            'last_name'=>$last_name,
                                            'email'=>$email,
                                            'address'=>$address,
                                        ]);

            if($Drivers_update)
            {
                return response()->json([
                    ['response' => 'Driver Update Successfully..!']
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

//=====================================================================================================

    public function updatePassword(Request $request)
    {
        $old_password = $request->old_password;       
        $new_password = $request->new_password;

        $driver = Drivers::find($request->id);
        // dd(Hash::make($old_password));

            if (!Hash::check($old_password, $driver->password))
            {
                return response()->json([
                    ['response' => 'The old password does not match our records.']
                ], 500);
            }
            else
            {
                $drivers_password_update = $driver->update(['password' => Hash::make($new_password)]);

                if($drivers_password_update)
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

//====================================================================================================

    public function Bookings(Request $request){

    try
        {
            $driver_id = $request->diver_id;

            $bookings= Bookings::where('deleted',0)->where('id',$driver_id)->get();

            return response()->json([
                ['response' => $bookings]
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
