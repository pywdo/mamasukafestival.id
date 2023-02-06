<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{


    public function edit()
    {
        return view('password.edit');
    }
    
    public function update(Request $request)
    {
      
       
        $request->validate([
           
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'current_password' => ['required', 'string', 'min:8', 'confirmed'],
        ],config('global.validator'));
    

        if(Hash::check($request->current_password,auth()->user()->password)){

           auth()->user()->update(['password'=>Hash::make($request->password)]);
            return back()->with('message','Your password has been updated');
            
                 }
            throw ValidationException::withMessages([

                 'current_password'=>'Your current password does not match with our record',
                ]);
     
    }
}
