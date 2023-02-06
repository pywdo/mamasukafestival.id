<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateProfileInformationController extends Controller
{
    public function edit()
    {
        return view('users.edit');
    }
    
    public function update(Request $request)
    {
        
        $request->validate([
            'name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255'],
            'wanumber'=>['required', 'string', 'wanumber', 'max:255'],

        ],config('global.validator'));

        auth()->user()->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'wanumber'=>$request->wanumber,
        ]);

        return back()->with('message','Your profile has been updated');


        
    }
}
