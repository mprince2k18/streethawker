<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo;
use Intervention\Image\Facades\Image;
use App\Banner_popup;
use App\Slider_background;
use App\Brand_banner;

class UIController extends Controller
{
    //All the constructor intructor must me required
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('userapproval');
        $this->middleware('userrestriction');
    }

    //Theme Setting Url Return (GET) Links Function

    function logo()
    {
        $allLogo = Logo::all();
        return view("frontEnd.logo_setting",compact('allLogo'));
    }
    function banner_popup()
    {
        $allBrandPopup = Banner_popup::all();
        return view("frontEnd.banner_popup_setting",compact('allBrandPopup'));
    }
    function slider_background()
    {
        $allLogo = Slider_background::all();
        return view("frontEnd.slider_background_setting",compact('allLogo'));
    }
    function brand_banner()
    {
        $allLogo = Brand_banner::all();
        return view("frontEnd.brand_banner_setting",compact('allLogo'));
    }



    //All Theme Setting save (POST) Link functions

    function saveNewLogo(Request $request)
    {
        $request->validate([
            "logo" => "required",
            "activation" => "required",
        ]);

        if ($request->activation == 1) {
            $allLogos = Logo::all();
            foreach ($allLogos as$value) {
             $value->activation = 0;
             $value->save();
            }
        }
            $check = Logo::insertGetId([
                "activation" => $request->activation,
            ]);
            if ($request->hasFile('logo')) {
                $photo = $request->logo;
                $photoName = $check . '.' . $photo->getClientOriginalExtension();
                Image::make($photo)->resize(214, 58)->save(base_path("public/frontEnd/img/logo/" . $photoName), 100);
                // Image::make($photo)->resize(20, 20)->save(base_path("public/frontEnd/img/" . $photoName), 100);
                Logo::findOrFail($check)->update([
                    'logo' => $photoName,
                ]);
            }

            if ($check) {
                return back()->with("greenStatus", "Logo Added");
            } else {
                return back()->with("yellowStatus", "Try Again ! Something Wrong");
            }



    }
    function saveNewBanner_popup(Request $request)
    {
        $request->validate([
            "banner_popup" => "required",
            "activation" => "required",
        ]);

        if($request->activation == 1){
          $allBanner = Banner_popup::all();
          foreach($allBanner as $banner){
            $banner->activation = 0;
            $banner->save();
          }
        }
        $check = Banner_popup::insertGetId([
            "activation" => $request->activation,
        ]);
        if ($request->hasFile('banner_popup')) {
            $photo = $request->banner_popup;
            $photoName = $check . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(1920, 150)->save(base_path("public/frontEnd/img/banner_popup/" . $photoName), 100);
            // Image::make($photo)->resize(20, 20)->save(base_path("public/frontEnd/img/" . $photoName), 100);
            Banner_popup::findOrFail($check)->update([
                'banner_popup' => $photoName,
            ]);
        }

        if ($check) {
            return back()->with("greenStatus", "New banner_popup Added");
        } else {
            return back()->with("yellowStatus", "Try Again ! Something Wrong");
        }
    }
    function saveNewSlider(Request $request)
    {
        $request->validate([
            "slider_background" => "required",
            // "activation" => "required",
        ]);
        $check = Slider_background::insertGetId([
            "activation" => $request->activation,
        ]);
        if ($request->hasFile('slider_background')) {
            $photo = $request->slider_background;
            $photoName = $check . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(899, 409)->save(base_path("public/frontEnd/img/slider/" . $photoName), 100);
            // Image::make($photo)->resize(20, 20)->save(base_path("public/frontEnd/img/" . $photoName), 100);
            Slider_background::findOrFail($check)->update([
                'slider_background' => $photoName,
            ]);
        }

        if ($check) {
            return back()->with("greenStatus", "New slider background Added");
        } else {
            return back()->with("yellowStatus", "Try Again ! Something Wrong");
        }
    }
    function saveNewBrandBbanner(Request $request)
    {
        $request->validate([
            "brand_banner" => "required",
            // "activation" => "required",
        ]);
        if ($request->activation == 1) {
            $allLogos = Brand_banner::all();
            foreach ($allLogos as$value) {
             $value->activation = 0;
             $value->save();
            }
        }
        $check = Brand_banner::insertGetId([
            "activation" => $request->activation,
        ]);
        if ($request->hasFile('brand_banner')) {
            $photo = $request->brand_banner;
            $photoName = $check . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(1169, 60)->save(base_path("public/frontEnd/img/brand_banner/" . $photoName), 100);
            // Image::make($photo)->resize(20, 20)->save(base_path("public/frontEnd/img/" . $photoName), 100);
            Brand_banner::findOrFail($check)->update([
                'brand_banner' => $photoName,
            ]);
        }

        if ($check) {
            return back()->with("greenStatus", "New Banner Added");
        } else {
            return back()->with("yellowStatus", "Try Again ! Something Wrong");
        }
    }

    //Change Activation URL's
    function changeLogoActivation($id,$activation)
    {
        if ($activation == 0) {
            $logos = Logo::all();
            foreach ($logos as $value) {
                $value->activation = 0;
                $value->save();
            }
            $check=Logo::findOrFail($id)->update([
                'activation' => 1
            ]);
            if ($check) {
                return back()->with('greenStatus',"Updated");
            } else {
                return back()->with('yellowStatus', "Something Wrong !");
            }
        }else {
            return back()->with('yellowStatus', "Already Activated !");
        }


    }
    function changebrand_bannerActivation($id,$activation)
    {
        if ($activation == 0) {
            $logos = Brand_banner::all();
            foreach ($logos as $value) {
                $value->activation = 0;
                $value->save();
            }
            $check=Brand_banner::findOrFail($id)->update([
                'activation' => 1
            ]);
            if ($check) {
                return back()->with('greenStatus',"Updated");
            } else {
                return back()->with('yellowStatus', "Something Wrong !");
            }
        }else {
            return back()->with('yellowStatus', "Already Activated !");
        }


    }
    function changeBanner_popupActivation($id,$activation)
    {
        if ($activation == 0) {
            $logos = Banner_popup::all();
            foreach ($logos as $value) {
                $value->activation = 0;
                $value->save();
            }
            $check=Banner_popup::findOrFail($id)->update([
                'activation' => 1
            ]);
            if ($check) {
                return back()->with('greenStatus',"Updated");
            } else {
                return back()->with('yellowStatus', "Something Wrong !");
            }
        }else {
            return back()->with('yellowStatus', "Already Activated !");
        }


    }
    function changesliderActivation($id,$activation)
    {
        if ($activation == 0) {

            $check=Slider_background::findOrFail($id)->update([
                'activation' => 1
            ]);
            if ($check) {
                return back()->with('greenStatus',"Updated");
            } else {
                return back()->with('yellowStatus', "Something Wrong !");
            }
        }else {
          $check=Slider_background::findOrFail($id)->update([
              'activation' => 0
          ]);
          if ($check) {
              return back()->with('greenStatus',"Updated");
          } else {
              return back()->with('yellowStatus', "Something Wrong !");
          }
        }


    }

    //All Delete URL's
    function changeLogodelete($id){
      $check  = Logo::findOrFail($id)->delete();
      if ($check) {
          return back()->with("greenStatus", "Deleted");
      } else {
          return back()->with("yellowStatus", "Try Again ! Something Wrong");
      }
    }
    function changeBanner_popupdelete($id){
      $check  = Banner_popup::findOrFail($id)->delete();
      if ($check) {
          return back()->with("greenStatus", "Deleted");
      } else {
          return back()->with("yellowStatus", "Try Again ! Something Wrong");
      }
    }
    function changesliderdelete($id){
      $check  = Slider_background::findOrFail($id)->delete();
      if ($check) {
          return back()->with("greenStatus", "Deleted");
      } else {
          return back()->with("yellowStatus", "Try Again ! Something Wrong");
      }
    }
    function changebrand_bannerdelete($id){
      $check  = Brand_banner::findOrFail($id)->delete();
      if ($check) {
          return back()->with("greenStatus", "Deleted");
      } else {
          return back()->with("yellowStatus", "Try Again ! Something Wrong");
      }
    }
}
