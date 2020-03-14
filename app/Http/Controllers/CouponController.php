<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    function allCoupon(){
      $allCoupon = Coupon::all();
      // return view('customer.deshboard.allCoupon');
      return view('deshboard.allCoupon',compact('allCoupon'));
    }
    function saveNewCoupon(Request $request){
      $request->validate([
        'coupon' => 'required|',
        'discount' => 'required|integer',
        'status' => 'required|integer',
        'expiryDate' => 'required|date',
        'time' => 'required'
      ]);
      if(Coupon::where('coupon',$request->coupon)->exists()){
        return back()->with('yellowStatus','This coupon already exists');
      }
      Coupon::insert([
        'coupon' => $request->coupon,
        'discount' => $request->discount,
        'status' => $request->status,
        'expiryDate' => $request->expiryDate." ".$request->time,
      ]);
      return back()->with('greenStatus','New Coupon Added');
    }
    function couponActivation($id,$ac){
      $coupon = Coupon::findOrFail($id);
      $coupon->status = $ac;
      $coupon->save();
      return back()->with('greenStatus','Coupon status changed');
    }
    function couponDelete($id){
      Coupon::findOrFail($id)->delete();
      return back()->with('greenStatus','Coupon Deleted');
    }



    function applyCoupon(Request $request){
      $coupon = $request->coupon;
      if(Coupon::where('coupon',$coupon)->exists()){
        $couponDetail = Coupon::where('coupon',$coupon)->first();
        if($couponDetail->status != 1){
          return redirect('cart')->with('redStatus',"Invalid Coupon");
        }else{
          if($couponDetail->expiryDate >= Carbon::now()){
            // Copon apply code here
            return redirect("cart/$coupon")->with('greenStatus',"Coupon Applied");
          }
          else{
            return redirect('cart')->with('redStatus',"Coupon Has Expired");
          }
        }
      }
      else{
        return redirect('cart')->with('redStatus',"Coupon Does Not Exists");
      }
    }
}
