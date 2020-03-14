<?php

namespace App\Http\Controllers\Auth;

use App\CustomerInfo;
use App\Http\Controllers\Controller;
use App\Rules\checkPin;
use App\Rules\pinUseAble;
use App\SecurityPin;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company_or_industry' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'integer'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'securityPin' => ['required', new checkPin, new pinUseAble],
            // 'fathersName' => ['required', 'string', 'max:255'],
            // 'mothersName' => ['required', 'string', 'max:255'],
            // 'NID' => ['required', 'string', 'max:255'],
            // 'dateOfBirth' => ['required', 'date'],
            // 'nomenyName' => ['required', 'string', 'max:255'],
            // 'nomenyRelation' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'company_or_industry' => $data['company_or_industry'],
            'password' => Hash::make($data['password']),
            ]);
            $id= $user->id; // Get current user id

            // SecurityPin::where('pin',$data['securityPin'])->update([
            //     'registered_user_id' => $id,
            //     'registered_status' => 1,
            //     'updated_at' => Carbon::now(),
            // ]);
            CustomerInfo::insert([
                'userId' => $id,
                'address' => $data['address'],
                'zip' => $data['zip'],
                'phone' => $data['phone'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            // CustomerInfo::insert([
            //     'userId' => $id,
            //     'fathersName' => $data['fathersName'],
            //     'mothersName' => $data['mothersName'],
            //     'NID' => $data['NID'],
            //     'dateOfBirth' => $data['dateOfBirth'],
            //     'nomenyName' => $data['nomenyName'],
            //     'nomenyRelation' => $data['nomenyRelation'],
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ]);
        return $user;
    }
}
