<?php

namespace App\Http\Controllers;

use App\CustomerInfo;
use App\SecurityPin;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SecurityPinController extends Controller
{
    function createSecurityPin()
    {
        return view('SecutiryPin.createSecurityPin');
    }
    function saveNewSecurityPin($digit,$generate)
    {
        if ($digit == null || $digit == 0) {
            $digit=12;
        }
        if ($generate == null || $generate == 0) {
            $generate=20;
        }
        //generating pin
        function getName($digit) {
            // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU,VWXYZ/\!@#$%&*()_-=`~.?|';
            // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*_-=~?';
            $characters = '0123456789';
            $randomString = '';

            for ($i = 0; $i < $digit; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }

            return $randomString;
            }
            //collect all pin and push on a array
            $data = SecurityPin::all('pin');
            $a=array();
            foreach ($data as $key => $value) {
                array_push($a,$value->pin);
            }
            // print_r($a);
            // if (in_array("2eT#IuDgV90_", $a)){
            //     echo "Match";
            // }
            $counter = 0;
            for ($i=0; $i < $generate; $i++) {
                $pin = getName($digit);
                echo "<b>".$pin."</b>"."<br><br>";
                //if the pin does not exists the pin will be inserted
                if (!in_array($pin, $a)){
                    $checkCounter = SecurityPin::insert([
                        'pin' => $pin,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    if ($checkCounter) {
                        $counter++;
                    }
                }
        }

        return back()->with('greenStatus',$counter.' Pin Created Successfully');
    }
    function unusedPin()
    {
        $unUsedPin = SecurityPin::where('registered_status',0)->paginate(10);
        return view('SecutiryPin.unusedPin',compact('unUsedPin'));
    }
    function removePin($pinId){
        SecurityPin::findOrFail($pinId)->delete();
        return back()->with('greenStatus','Pin Removed');
    }
    function userRegisteredPin()
    {
        $registeredPin = SecurityPin::where('registered_status',1)->paginate(20);
        return view("SecutiryPin.userRegisteredPin",compact('registeredPin'));
    }
    function UserInformation()
    {
        $UserInformation = CustomerInfo::paginate(20);
        return view("SecutiryPin.userInformation",compact('UserInformation'));
    }
}
