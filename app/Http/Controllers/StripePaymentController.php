<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Auth;
use App\billingOrderDetails;
use App\orderedCarts;
use App\orders;
use App\product;
use Carbon\Carbon;
use App\Cart;
use Mail;
use App\Mail\MailOrderInvoice;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $request->tot * 100,
            "currency" => "BDT",
            "source" => $request->stripeToken,
            "description" => "Payment from ".Auth::user()->email."."
        ]);

        //Billing Data Saving Code Start Here..........................

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
            orderedCarts::insert([
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
        // return redirect('/')->with('greenStatus', 'Your Order Has Been Placed ! Please Check Email and Order List');
        // return redirect('/thanksForOrdering')->with('orderTrackingId', $orderTrackingId);
    }
}
