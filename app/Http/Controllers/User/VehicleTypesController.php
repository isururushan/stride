<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle_Types;

class VehicleTypesController extends Controller
{
    public function index(){

        return Vehicle_Types::where('deleted','=',0)->get();
    } 

   // ==================== add vehicle_typess ===================================
   public function store (Request $request){

        $request->validate([

        'name' =>'required',
        'base_rate'=>'required',
        'additional_rate'=>'required'

        ]);

    try{

        $vehicle_types['name'] = $request->name;
        $vehicle_types['base_rate'] = $request->base_rate;
        $vehicle_types['additional_rate'] = $request->additional_rate;

        $result = Vehicle_Types::create($vehicle_types);

        if($result){
            return 1;
        }else{
            return 0;
        }

    }catch (Exception $ex){
        return $ex;
    }
    }

//================== update vehicle_typess =======================

public function update(Request $request){

        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'base_rate'=>'required',
            'additional_rate'=>'required'
        ]);

        try{

        $id = $request->id;
        $name = $request->name;
        $base_rate= $request->base_rate;
        $additional_rate= $request->additional_rate;
        $active = $request->active;

        $vehicle_types_save = Vehicle_Types::where('id',$id)
                                            ->update([
                                            'name'=>$name,
                                            'base_rate'=>$base_rate,
                                            'additional_rate'=>$additional_rate,
                                            'active' => $active,
                                            ]);

        if($vehicle_types_save){
            return 1;
        }else{
            return 0;
        }

        }catch(Exception $e){
            return $e;
        }

        }

        // =============== Delete vehicle_types =======================

        public function destroy(Request $request){

        $request->validate([
            'id' => 'required'
        ]);


        try{

        $vehicle_type = Vehicle_Types::find($request->id);
        
        $delete = vehicle_Types::where('id', $request->id)->update(['deleted' => '1']);


        if($delete){
            return 1;
        }else{
            return 0;
        }


        }catch(Exception $e){
            return $e;
        }
            
        }
}
