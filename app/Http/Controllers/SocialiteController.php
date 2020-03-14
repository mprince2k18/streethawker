<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{
  function redirectToGoogle(){
    return Socialite::driver('google')->redirect();
  }
  function handleGoogleCallback(){
          try {

          $user = Socialite::driver('google')->user();

          $finduser = User::where('email', $user->email)->first();
          // print_r($user);
          if($finduser){

              Auth::login($finduser);

              return redirect('/');

          }else{
            $nowDate = Carbon::now();
              $newUser = User::create([
                  'name' => $user->name,
                  'email' => $user->email,
                  // 'email_verified_at'=>'2020-01-06 00:00:00',
                  'password' => Hash::make($user->email),
                  'created_at'=> $nowDate,
                  'updated_at'=>$nowDate,
              ]);

              Auth::login($newUser);

              return redirect('/');
          }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
  }
}
