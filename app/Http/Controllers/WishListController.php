<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WishList;
use Carbon\Carbon;

class WishListController extends Controller
{
    function wishlist(){
      $ip = $_SERVER['REMOTE_ADDR'];
      $allWishList = WishList::where('customer_ip',$ip)->get();
      return view('customer.wishList',compact('allWishList'));
    }
    function addtowishlist($id){
        $checkIfExists = WishList::where('product_id',$id)->first();
        if($checkIfExists){
          return back()->with('yellowStatus','This product has already been added to wish list');
        }else{
        $ip = $_SERVER['REMOTE_ADDR'];
        WishList::insert([
            'product_id' => $id,
            'customer_ip' => $ip,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
          return back()->with('greenStatus','Product added to wish list 👍');
        }
    }
    function removefromwishlist($id){
      $check = WishList::findOrFail($id)->delete();
      if($check){
        return back()->with('greenStatus','Removed Form Wish List');
      }else{
        return back()->with('yellowStatus','Something Went Wrong');
      }
    }
}
