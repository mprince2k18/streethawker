<?php

namespace App\Http\Controllers;

use App\Brand;
use App\category;
use App\product;
use App\HotDeal;
use App\SalerRegisterBrand;
use App\sub_category;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Auth;

class HotDealController extends Controller
{
    function manageHotDeal()
    {
        $allHotDeal = HotDeal::all();
        return view('deshboard.manageHotDeal',compact('allHotDeal'));
    }





    function runHotdealChecker(){
      $allDeals = HotDeal::all();
      foreach ($allDeals as $value) {
          $date = $value->deadline;
          $deadlinetime = $value->deadlinetime;

          $currentDate = Carbon::now()->format('Y-m-d');
          $currenttime = Carbon::now()->format('h:m');
          $databaseDate = $date.' '.$deadlinetime.':00';

          if ($date <= $currentDate) {
              if ($date == $currentDate) {
                  // if ($deadlinetime >= $currenttime) {
                      // echo "valid | d : $deadlinetime c: $currenttime \n";
                      if ($databaseDate <= Carbon::now()) {
                      // echo " EX , Dat : ".$databaseDate."\n";
                      // echo "Now : ".Carbon::now()."\n";
                      // echo " \n";
                      //Write Delete Code Here
                      $dataToDelete = HotDeal::where('deadline', $date)->where('deadlinetime', $deadlinetime)->delete();
                      echo "Deleted"."\n";
                      }
                      else {
                      // echo " Va Dat : " . $databaseDate . "\n";
                      // echo "Now : " . Carbon::now() . "\n";
                      // echo " \n";
                      }
                  // }
              }
              else{
                  // echo "Expired | d : $deadlinetime c: $currenttime \n";
                  //Write Delete Code Here
                  HotDeal::where('deadline', $date)->where('deadlinetime', $deadlinetime)->delete();
                  echo "Deleted \n";
              }
          }


      }
    }






    function hotDealDelete($id){
      HotDeal::findOrFail($id)->delete();
      return back()->with('greenStatus','Deleted');
    }
    function addNewHotDeal(Request $request)
    {
        // print_r($request->all());
        // product
        // rate
        // stock
        // deadline
        // deadlinetime

        $request->validate([
            'product' => 'required',
            'rate' => 'required|numeric',
            'stock' => 'required|numeric',
            'deadline' => 'required',
            'deadlinetime' => 'required',
            'newInfo' => 'required',
        ]);

        $lastId = HotDeal::insertGetId([
            'product' => $request->product,
            'rate' => $request->rate,
            'stock' => $request->stock,
            'deadline' => $request->deadline,
            'deadlinetime' => $request->deadlinetime,
            'newInfo' => $request->newInfo,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return back()->with("greenStatus","Hot Deal Added");
    }
    function getProductSearch(Request $request)
    {
        $stringToSend = "";
        // $allcity = stock::find('stockid')->all();
        $allcity = product::where('product_name', 'like', $request->searchData . '%')->get();
        foreach ($allcity as $value) {
            // array_push($stringToSend, $value->buingPrice, $value->sellingPrice);
            if ($value->approval != 0 && $value->activation != 0) {
                $stringToSend .= "<option value='" . $value->id . "'>" . $value->product_name . "</option>";
            }
        }
        echo ($stringToSend);
    }
}
