<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Bookings;
use App\Models\Documents;
use App\Models\Drivers;
use App\Models\Driver_ratings;
use App\Models\Passengers;
use App\Models\Trips;
use App\Models\Vehicles;
use App\Models\Vehicle_types;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;



class UserController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function fetchDrivers(){
        
        $drivers= Drivers::where('deleted',0)->get();

        foreach($drivers as $driver)
            {
                $driver_vehicle= Vehicles::where('id',$driver['vehicles_id'])->first();
                $driver ['vehicle_name'] =$driver_vehicle['name'];
                $driver ['vehicle_make'] =$driver_vehicle['make'];
                $driver ['vehicle_model'] =$driver_vehicle['model'];
                $driver ['vehicle_plate_number'] =$driver_vehicle['plate_number'];
            
                $driver_vehicle_type = Vehicle_types::where('id', $driver_vehicle['vehicle_types_id'])->first();
                $driver ['vehicle_type_name'] = $driver_vehicle_type['name'];
            
                $documents = Documents::where('id',$driver['id'])->first();
                $driver['driver_document'] = $documents['document'];
            }
        return $drivers;

    }

    public function fetchDriverratings(){

        $driverRatings =Driver_ratings::where('deleted',0)->get();

        foreach($driverRatings as $driverRating)
            {
                $drivers = Drivers::where('id', $driverRating['drivers_id'])->first();
                $driverRating['driver_first_name']= $drivers['first_name'];
                $driverRating['driver_last_name']= $drivers['last_name'];
               
                $passengers = Passengers::where('id', $driverRating['passengers_id'])->first();
                $driverRating['passenger_first_name']= $passengers['first_name'];
                $driverRating['passenger_last_name']= $passengers['last_name'];
               
            }
        return $driverRatings;
    }

    public function fetchBookings(){

        $bookings= Bookings::where('deleted','=',0)->get();

        foreach($bookings as $booking)
        {
                $drivers = Drivers::where('id', $booking['drivers_id'])->first();
                $booking['driver_first_name']= $drivers['first_name'];
                $booking['driver_last_name']= $drivers['last_name'];
            
                $passengers = Passengers::where('id', $booking['passengers_id'])->first();
                $booking['passenger_first_name']= $passengers['first_name'];
                $booking['passenger_last_name']= $passengers['last_name'];
           
            
        }
        return $bookings;
 
    }

    public function fetchTrips(){

        $trips = Trips::where('deleted',0)->get();

        foreach($trips as $trip)
        {
                $drivers = Drivers::where('id', $trip['drivers_id'])->first();
                $trip['driver_first_name']= $drivers['first_name'];
                $trip['driver_last_name']= $drivers['last_name'];
            
                $passengers = Passengers::where('id', $trip['passengers_id'])->first();
                $trip['passenger_first_name']= $passengers['first_name'];
                $trip['passenger_last_name']= $passengers['last_name'];
        }

        return $trips;
    }



    public function index()
    {
         return view('Backend.Template.User.backend_user_home');
    }

}
