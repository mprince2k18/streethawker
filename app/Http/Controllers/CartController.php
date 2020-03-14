<?php

namespace App\Http\Controllers;

use App\billingOrderDetails;
use App\Cart;
use App\HotDealCart;
use App\CustomerInfo;
use App\Country;
use App\orderedCarts;
use App\orders;
use App\product;
use App\State;
use App\category;
use Carbon\Carbon;
use App\Coupon;
use App\Brand;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Mail\MailOrderInvoice;

class CartController extends Controller
{
    function home()
    {
        // $this
        // $this-
        // $this->middleware('userapproval');
        // $this->middleware('userrestriction');
        if (Auth::user()->role == 3) {
            return view('deshboard.index');
        }
        elseif (Auth::user()->role == 2) {
            echo "Page not Created Yet";
        }
        else{
            return view('customer.deshboard/home');
        }
    }
    function cart()
    {
        $all_my_carts = Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->get();
        return view('customer.cart',compact('all_my_carts'));
    }

    function cartWithCoupon($coupon)
    {

      if(Coupon::where('coupon',$coupon)->exists()){
        $couponDetail = Coupon::where('coupon',$coupon)->first();
        if($couponDetail->status != 1){
          return redirect('cart')->with('redStatus',"Invalid Coupon");
        }else{
          if($couponDetail->expiryDate >= Carbon::now()){
            // Copon apply code here
            $dis = $couponDetail->discount;
            $all_my_carts = Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->get();
            return view('customer.cartWithCoupon',compact('all_my_carts','dis'))->with('greenStatus',"Coupon Applied");
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
    function addtocart($product_id)
    {
        $thisQuantity = product::findOrFail($product_id)->quantity;

        $ip = $_SERVER['REMOTE_ADDR'];
        if (product::findOrFail($product_id)->exists()) {

            if (Cart::where('customer_ip',$ip)->where('product_id',$product_id)->exists()) {
              if($thisQuantity > Cart::where('customer_ip',$ip)->where('product_id',$product_id)->first('product_quantity')->product_quantity + 1){

                $product = Cart::where('customer_ip',$ip)->where('product_id',$product_id)->increment('product_quantity');
                return back()->with('greenStatus','Product added to cart 👍');
                // $quantity = $product;
              }else{
                return back()->with('yellowStatus','We do not have much stock');
              }
                // echo $quantity;
            } else {
              if($thisQuantity < 1){
                return back()->with('yellowStatus','We do not have much stock');
              }else{
                Cart::insert([
                  'product_id' => $product_id,
                  'customer_ip' => $ip,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
                ]);
                return back()->with('greenStatus','Product added to cart 👍');
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
    function clearCart()
    {
        // echo $_SERVER['REMOTE_ADDR'];
        $check = Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->delete();
        if ($check) {
            return back()->with('greenStatus','Your Cart Cleared');
        }
        else {
            return back()->with('yellowStatus','Nothing To Clear');
        }
    }
    function deleteCart($cartId)
    {
        Cart::findOrFail($cartId)->delete();
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
    function getCityName(Request $request){
        $allState = State::where('country_id',$request->country_id)->get();
        $dataToSend = null;
        foreach ($allState as $key => $value) {
            $dataToSend .= "<option value='".$value->id."'>".$value->name."</option>";
        }
        echo $dataToSend;
    }
    function placeOrder(Request $request)
    {
        print_r($request->all());
    }
    function getSubCategory()
    {
        $sub_category = App\sub_category::all();
        $data='m';
        foreach ($sub_category as $key => $value) {
            $data="gg";
        }
        echo $data;
    }
    function productview($product_id)
    {
        $product=product::findOrFail($product_id);
        return view('customer.productView',compact('product'));
    }

    function searchFromMenu(Request $request)
    {
        $searchData = $request->search;
        $sub_category = $request->poscats;
        if ($sub_category == "0") {
            $afterSearch = product::where('product_name', 'LIKE', "%" . $searchData . "%")->get();
            $sub_category = false;

            if(product::where('product_name', 'LIKE', "%" . $searchData . "%")->count()){
              $sub_category = $afterSearch[0]->sub_category;
              // echo $afterSearch;
            }
            return view('customer.searchView', compact('afterSearch','sub_category'));
        } else {
            $afterSearch = product::where('sub_category', $sub_category)->where('product_name', 'LIKE', "%" . $searchData . "%")->get();
            return view('customer.searchView', compact('afterSearch','sub_category'));
        }
    }
    function shopcategory($id){
      $afterSearch = product::where('category', $id)->get();
      $sub_category = false;

      if(product::where('category', $id)->count()){
        $sub_category = $afterSearch[0]->sub_category;
        // echo $afterSearch;
      }
      return view('customer.searchView', compact('afterSearch','sub_category'));
    }
    function shopsub_category($id){
      $afterSearch = product::where('sub_category', $id)->get();
      $sub_category = $id;
      return view('customer.searchView', compact('afterSearch','sub_category'));
    }

    function saveProfile(Request $request)
    {
        $request->validate([
            'address'=>'required',
            'phone'=>'required',
            'zip'=>'required',
        ]);
        if (CustomerInfo::where('userId',Auth::user()->id)->exists()) {
            CustomerInfo::where('userId',Auth::user()->id)->update([
                'address'=>$request->address,
                'phone'=>$request->phone,
                'zip'=>$request->zip,
                'updated_at'=>Carbon::now(),
            ]);
            return back()->with('greenStatus','Profile Updated');
        }
        else {
            CustomerInfo::insert([
                'userId'=>Auth::user()->id,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'zip'=>$request->zip,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
            return back()->with('greenStatus','Your Profile Saved');
        }
    }
    function profile()
    {
        // $profileInfo = CustomerInfo::where('userId',Auth::user()->id)->first();
        // return view('customer.deshboard/profile',compact('profileInfo'));
        return view('customer.deshboard/profile');
    }
    function checkOutBillingDetails(Request $request)
    {
        if ($request->paymentType == 1) {
          $orderAmount = orders::count();
          $year = Carbon::now()->year;
          $orderTrackingId = "SH".$year."0".($orderAmount+1);
            $orderId = orders::insertGetId([
                'userId' => Auth::user()->id,
                'orderTrackingId' => $orderTrackingId,
                'totalAmount' => $request->tot,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            billingOrderDetails::insert([
                'userId' => Auth::user()->id,
                'order_id' => $orderId,
                'orderTrackingId' => $orderTrackingId,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'userName' => $request->userName,
                'companyName' => $request->companyName,
                'address' => $request->address,
                'zip' => $request->zip,
                'email' => $request->email,
                'phone' => $request->phone,
                'orderNote' => $request->orderNote,
                'paymentType' => $request->paymentType,
                'dis' => $request->dis,
                'ship' => $request->ship,
                'sub' => $request->sub,
                'tot' => $request->tot,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $allYourCart = Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->get();
            foreach ($allYourCart as $value) {
                $checkO = orderedCarts::insert([
                    'product_id' => $value->product_id,
                    'customer_ip' => $value->customer_ip,
                    'product_quantity' => $value->product_quantity,
                    'userID' => Auth::user()->id,
                    'orderID' => $orderId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $thisQuantity = product::findOrFail($value->product_id)->quantity;
                $updatedQ = $thisQuantity - $value->product_quantity;
                product::findOrFail($value->product_id)->update([
                  'quantity' => $updatedQ,
                ]);
                $value->delete();
            }

            $cartToMail = orderedCarts::where('orderID',$orderId)->get();
            $order_idToMail = $orderId;
            $userNameToMail = $request->userName;
            $addressToMail = $request->address;
            $emailToMail = $request->email;
            $phoneToMail = $request->phone;
            $orderNoteToMail = $request->orderNote;
            $paymentTypeToMail = $request->paymentType;
            $shipToMail = $request->ship;
            $subToMail = $request->sub;
            $userNameToMail = $request->userName;
            $addressToMail = $request->address;
            $emailToMail = $request->email;
            $phoneToMail = $request->phone;
            $orderNoteToMail = $request->orderNote;
            $paymentTypeToMail = $request->paymentType;
            $shipToMail = $request->ship;
            $subToMail = $request->sub;
            $totToMail = $request->tot;
            $dataToMail = Carbon::now();

              Mail::to($request->email)->send(new MailOrderInvoice(
              $cartToMail,
              $order_idToMail,
              $userNameToMail,
              $addressToMail,
              $emailToMail,
              $phoneToMail,
              $orderNoteToMail,
              $paymentTypeToMail,
              $shipToMail,
              $subToMail,
              $totToMail,
              $dataToMail,
              $orderTrackingId
            ));
            return redirect('/thanksForOrdering')->with('orderTrackingId', $orderTrackingId);
        } else {
                $userId = Auth::user()->id;
                $country_id = $request->country_id;
                $city_id = $request->city_id;
                $userName = $request->userName;
                $companyName = $request->companyName;
                $address = $request->address;
                $zip = $request->zip;
                $email = $request->email;
                $phone = $request->phone;
                $orderNote = $request->orderNote;
                $paymentType = $request->paymentType;
                $dis = $request->dis;
                $ship = $request->ship;
                $sub = $request->sub;
                $tot = $request->tot;
                return view('stripe',compact('userId','country_id','city_id','userName','companyName','address','zip','email','phone','orderNote','paymentType','dis','ship','sub','tot'));
        }
    }
    // function showInv(){
    //   return view('customer.');
    // }
    function thanksForOrdering(){
      return view('customer.thanksForOrdering');
    }
    function myOrders()
    {
        $myOrders = orders::where('userId', Auth::user()->id)->get();
        // print_r($myOrders->all());
        return view('customer.deshboard.myOrder',compact('myOrders'));
    }
    function myorderdetails($orderId)
    {
        $allBills=billingOrderDetails::where('order_id', $orderId)->get();
        return view('customer.deshboard.myOrderDetails', compact('allBills', 'orderId'));
    }
    function showproducts($id)
    {
        $allCart=orderedCarts::where('orderID',$id)->get();
        return view('customer.deshboard.myOrderedProducts', compact('allCart'));
    }
    function getBrandJson(){
      $brands = Brand::all();
      // return Response::json($brands);
      return $brands;
    }

    function searchByBrand($id){
      $afterSearch = product::where('brand', $id)->get();
      $sub_category = false;

      if(product::all()->count()){
        $sub_category = $afterSearch[0]->sub_category;
        // echo $afterSearch;
      }
      return view('customer.searchView', compact('afterSearch','sub_category'));
    }







    // End

}
