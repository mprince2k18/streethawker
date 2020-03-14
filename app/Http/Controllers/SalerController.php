<?php

namespace App\Http\Controllers;

use App\Brand;
use App\SalerRegisterBrand;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class SalerController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth' => 'verified']);
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('userapproval');
        $this->middleware('userrestriction');
    }
    function salerbrand()
    {
        $registerBrands = SalerRegisterBrand::where('saler_id',Auth::user()->id)->get();
        $requestBrands = Brand::where('Requestby',Auth::user()->id)->get();
        return view('saler.salerbrand',compact('registerBrands','requestBrands'));
    }
    function addNewBrand(Request $request){
        $request->validate([
            'brand' => 'required',
        ]);
        $alBrand = SalerRegisterBrand::all();
        $myid =Auth::user()->id;
        foreach ($alBrand as  $value) {
            if ($value->saler_id == $myid && $value->brand_id == $request->brand) {
                return back()->with('yellowStatus','This brand has already added');
            }
        }
        SalerRegisterBrand::insert([
            'brand_id' => $request->brand,
            'saler_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('greesStatus','Brand added and is in waiting');
    }
    function requestNewBrand(Request $request)
    {
        // print_r($request->all());
                // print_r($request->all());
                $request->validate([
                    'brand_name' => 'required',
                    // 'activation' => 'required',
                    'photo' => 'required',
                ]);
                $lastId = Brand::insertGetId([
                    'brand_name' => $request->brand_name,
                    'activation' => 1,
                    'request' => 0,
                    'requestby' => Auth::user()->id,
                    'approvedby' => 0,
                    'created_at' => Carbon::now(),
                ]);

                if ($request->hasFile('photo')) {
                    $photo = $request->photo;
                    $photoName = $lastId.'.'.$photo->getClientOriginalExtension();
                    Image::make($photo)->resize(400, 450)->save(base_path( "public/uploads/brand/" . $photoName),100);
                    Brand::findOrFail($lastId)->update([
                        'photo' => $photoName,
                        ]);
                    }

                    // return back()->with('greenStatus','Product Added Successfully 👍');
                    return back()->with('greenStatus','Brand Request Sent ❤');
    }


}
