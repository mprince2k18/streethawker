<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function profile()
    {
        return view('customer.deshboard/profile');
    }

    function aboutus()
    {
        return view('about');
    }

    function contact()
    {
        return view('contact');
    }
}
