<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerInfo;
use App\vendorInfo;
use App\Rules\checkPin;
use App\Rules\pinUseAble;
use App\SecurityPin;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class vendorManberRegisterController extends Controller
{
  function vendorRegister(){
    return view('auth.vendorRegister');
  }
  function vendorRegisterPost(Request $request){
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'company_or_industry' => ['required', 'string', 'max:255'],
      'address' => ['required', 'string', 'max:255'],
      'zip' => ['required', 'integer'],
      'phone' => ['required', 'string', 'max:255'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'securityPin' => ['required', new checkPin, new pinUseAble],
      'fathersName' => ['required', 'string', 'max:255'],
      'mothersName' => ['required', 'string', 'max:255'],
      'NID' => ['required', 'string', 'max:255'],
      'dateOfBirth' => ['required', 'date'],
      'nomenyName' => ['required', 'string', 'max:255'],
      'nomenyRelation' => ['required', 'string', 'max:255'],
    ]);

    // inserting the user information after validating



    $id =  User::insertGetId([
        'name' => $request->name ,
        'email' => $request->email ,
        'company_or_industry' => $request->company_or_industry ,
        'role' => 2 ,
        'password' => Hash::make($request->password ),
        ]); // Get current user id

    $securityPinUpdate = SecurityPin::where('pin',$request->securityPin)->update([
            'registered_user_id' => $id,
            'registered_status' => 1,
            'updated_at' => Carbon::now(),
        ]);
    $customerInfoUpdate = CustomerInfo::insert([
            'userId' => $id,
            'address' => $request->address,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    $vendorData = vendorInfo::insert([
            'userId' => $id,
            'fathersName' => $request->fathersName,
            'mothersName' => $request->mothersName,
            'NID' => $request->NID,
            'dateOfBirth' => $request->dateOfBirth,
            'nomenyName' => $request->nomenyName,
            'nomenyRelation' => $request->nomenyRelation,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        return redirect('/login')->with('greenStatus','Account Created Please Login');


  }
  function memberRegisterPost(Request $request){
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'company_or_industry' => ['required', 'string', 'max:255'],
      'address' => ['required', 'string', 'max:255'],
      'zip' => ['required', 'integer'],
      'phone' => ['required', 'string', 'max:255'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);




    $id =  User::insertGetId([
        'name' => $request->name,
        'email' => $request->email,
        'company_or_industry' => $request->company_or_industry,
        'role' => 4,
        'password' => Hash::make($request->password),
        ]);


        CustomerInfo::insert([
            'userId' => $id,
            'address' => $request->address,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ]);
        return redirect('/login')->with('greenStatus','Account Created Please Login');


  }
  function joinOrRegister(){
    return view('auth.joinOrRegister');
  }
  function mamberRegister(){
    return view('auth.mamberRegister');
  }
}
