<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function profile()
    {
        return view('customer.deshboard/profile');
    }
}
