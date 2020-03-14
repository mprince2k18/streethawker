<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HotDealCart;
use App\product;
use Carbon\Carbon;
use App\HotDeal;

class HotDealCartController extends Controller
{
  function hotDealCart()
  {
      $all_my_carts = HotDealCart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->get();
      return view('customer.hotDealCart',compact('all_my_carts'));
      // echo $all_my_carts;
  }
  function addtohotDealCart($product_id)
  {
      $thisQuantity = product::findOrFail(HotDeal::findOrFail($product_id)->product)->quantity;

      $ip = $_SERVER['REMOTE_ADDR'];
      if (product::findOrFail(HotDeal::findOrFail($product_id)->product)->exists()) {

          if (HotDealCart::where('customer_ip',$ip)->where('hotdeal_id',$product_id)->exists()) {
            if($thisQuantity > HotDealCart::where('customer_ip',$ip)->where('hotdeal_id',$product_id)->first('product_quantity')->product_quantity + 1 &&
                HotDeal::findOrFail($product_id)->stock > HotDealCart::where('customer_ip',$ip)->where('hotdeal_id',$product_id)->first('product_quantity')->product_quantity + 1 ){

              HotDealCart::where('customer_ip',$ip)->where('hotdeal_id',$product_id)->increment('product_quantity');
              return back()->with('greenStatus','Added to Hot Deal cart 👍');
              // $quantity = $product;
            }else{
              return back()->with('yellowStatus','We do not have much stock');
            }
              // echo $quantity;
          } else {
            if($thisQuantity < 1){
              return back()->with('yellowStatus','We do not have much stock');
            }else{
              HotDealCart::insert([
                'hotdeal_id' => $product_id,
                'customer_ip' => $ip,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
              ]);
              return back()->with('greenStatus','Added to Hot Deal cart 👍');
            }
          }

      } else {
          return view(abort(404));
      }
  }
  function updateCart(Request $request)
  {
      // // print_r($request->cartQuantity);
      foreach ($request->cartQuantity as $key => $value) {
          // echo "P id:".$request->productId[$key]."  quan:".$value."<br>";
          if ($value>0) {
              if (product::find($request->productId[$key])->quantity < $value) {
                  return back()->with('redStatus', "We don't have this much stock of ".product::find($request->productId[$key])->product_name." ,Please reduse quantity");
                  // echo "We don't have enough stock";
              }
              else {
                  Cart::where('product_id', $request->productId[$key])->where('customer_ip',$_SERVER[ 'REMOTE_ADDR'])->update([
                      'product_quantity' => $value,
                  ]);
              }
          }
          else {
              return back()->with('yellowStatus','Quantity must be at list 1');
          }
      }
      // echo "Your Cart Updated";
      return back()->with('greenStatus','Your Cart Updated👍');
  }
  function clearHotDealCart()
  {
      // echo $_SERVER['REMOTE_ADDR'];
      $check = HotDealCart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->delete();
      if ($check) {
          return back()->with('greenStatus','Your Cart Cleared');
      }
      else {
          return back()->with('yellowStatus','Nothing To Clear');
      }
  }
  function deletehotDealCart($cartId)
  {
      HotDealCart::findOrFail($cartId)->delete();
      return back()->with('greenStatus','Cart Removed');
  }
  function checkOut(Request $request){

      if (CustomerInfo::where('userId',Auth::user()->id)->exists()) {
          if (isset($_POST['checkOutBtn'])) {
              $sub = $request->sub;
              $ship = $request->ship;
              $dis = $request->dis;
              $tot = $request->tot;
              $allCounry = Country::all();
              $allState = State::all();
              $customerInfo=CustomerInfo::where('userId',Auth::user()->id)->first();
              // print_r($allCounry->all());
              // echo $allState;
              return view('customer.checkOut',compact('allCounry','sub','ship','dis','tot','customerInfo'));
          }
          else {
              return back();
          }
      }
      else {
          return back()->with('yellowStatus','Please full up your Profile');
      }

  }
}
