<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
   
    public function index(){

        return User::all();
    }

    public function store(Request $request){

    $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    try{

        $admin['name'] = $request->name;
        $admin['email'] = $request->email;
        $admin['password']= Hash::make($request['password']);

        $result = User::create($admin);

        if($result){
            return 1;
        }else{
            return 0;
        }

    }catch (Exception $ex){
        return $ex;
    }
}

//================== update Admin =======================

public function update(Request $request){

    $request->validate([
        'id' => 'required',
        'name' => 'required',
        'email' => 'required',
    ]);

    try{

    $id = $request->id;
    $name = $request->name;
    $email =$request->email;

    $admin_save = User::where('id',$id)
                                 ->update(['name'=>$name,
                                          'email' => $email,
        ]);

    if($admin_save){
        return 1;
    }else{
        return 0;
    }

    }catch(Exception $e){
        return $e;
    }

}

// =============== Delete User =======================

public function destroy(Request $request){

    $request->validate([
        'id' => 'required'
    ]);


    try{

    $user = User::find($request->id);
       
    $delete = User::where('id', $request->id)->update(['deleted' => '1']);


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

