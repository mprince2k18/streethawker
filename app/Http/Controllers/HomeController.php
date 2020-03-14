<?php

namespace App\Http\Controllers;

use App\Brand;
use App\category;
use App\product;
use App\SalerRegisterBrand;
use App\sub_category;
use App\Manage_promotional_cateogry;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth' => 'verified']);
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('userapproval');
        $this->middleware('userrestriction');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allProduct = product::all();
        return view('home',compact('allProduct'));
    }
    // function notApproved()
    // {
    //     return view('notApproved');
    // }

    function deshboard()
    {
        return view('deshboard.index');
    }
    // Category.............................................................
    function manage_categories()
    {
        $allCaregories = category::all();
        return view('deshboard.manage_categories',compact('allCaregories'));
    }
    function manage_sub_categories()
    {
        $allCaregories = category::all();
        $allSubCaregories = sub_category::all();
        return view('deshboard.manage_sub_categories',compact('allCaregories','allSubCaregories'));
    }
    function saveNewCategory(Request $request)
    {
        // print_r($request->all());
        $request->validate([
            'category_name' => 'required',
            'activation' => 'required|numeric',
            'aditional_information' => 'required',
            'category_photo' => 'required',
            'category_big_photo' => 'required',
        ]);

        $lastId = category::insertGetId([
            'category_name' => $request->category_name,
            'activation' => $request->activation,
            'aditional_information' => $request->aditional_information,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('category_photo')) {
            $photo = $request->category_photo;
            $photoName = $lastId . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(20, 20)->save(base_path("public/frontEnd/img/vertical-menu/" . $photoName), 100);
            // Image::make($photo)->resize(20, 20)->save(base_path("public/frontEnd/img/" . $photoName), 100);
            category::findOrFail($lastId)->update([
                'category_photo' => $photoName,
            ]);
            // echo $photoName;
        }
        if ($request->hasFile('category_big_photo')) {
            $photo = $request->category_big_photo;
            $photoName = $lastId . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(224, 359)->save(base_path("public/frontEnd/img/categories/" . $photoName), 100);
            // Image::make($photo)->resize(20, 20)->save(base_path("public/frontEnd/img/" . $photoName), 100);
            category::findOrFail($lastId)->update([
                'category_big_photo' => $photoName,
            ]);
            // echo $photoName;
        }

        return back()->with('greenStatus','New Category Added 👍');
    }
    function Manage_promotional_cateogry(){
      $allproitonalCateogry = Manage_promotional_cateogry::all();
      return view('deshboard.Manage_promotional_cateogry',compact('allproitonalCateogry'));
    }
    function new_promotional_cateogry(Request $request){
      $request->validate([
        'category' => 'required',
      ]);
      $count = Manage_promotional_cateogry::count();
      if($count >= 5){
        return back()->with('yellowStatus','You can not add more than 5 please delete one');
      }else{
      Manage_promotional_cateogry::insert([
        'category_id' => $request->category,
      ]);
      return back()->with('greenStatus','Promoitonal Category Added');
     }

    }
    function removePromotionalCategory($id){
      $photo=category::findOrFail(Manage_promotional_cateogry::findOrFail($id)->category_id)->category_big_photo;
      // if($photo != 'defaultBig.png'){
      //   unlink(base_path("public/frontEnd/img/categories/".$photo));
      // }
      Manage_promotional_cateogry::findOrFail($id)->delete();
      return back()->with('greenStatus','Promoitonal Category Removed');
    }
    function getCategorySearch(Request $request){
      $stringToSend = "";
      // $allcity = stock::find('stockid')->all();
      $allcity = category::where('category_name','like', $request->searchData.'%')->get();
      foreach ($allcity as $value) {
      // array_push($stringToSend, $value->buingPrice, $value->sellingPrice);
        if($value->activation == 1){
          $stringToSend .= "<option value='" . $value->id . "'>".$value->category_name."</option>";
        }
      }
      echo($stringToSend);
    }
    function saveNewSubCategory(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'sub_category_name' => 'required',
        ]);
        $test = sub_category::insert([
            'sub_category_name'=> $request->sub_category_name,
            'categoryId' => $request->category,
            'activation' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('greenStatus','Sub Category Added 👍');
    }
    function deleteCategory($id)
    {
        category::findOrFail($id)->delete();
        return back()->with('greenStatus','Category Deleted Successfully');
    }
    function changeCategoryActivation($id,$activation)
    {
        if ($activation == 1) {
            category::findOrFail($id)->update([
                'activation' => 0
            ]);
        }
        else {
            category::findOrFail($id)->update([
                'activation' => 1
            ]);
        }
        return back()->with('greenStatus','Category Updated Successfully');
    }
    function editcategory($id)
    {
        $category = category::findOrFail($id);
        // echo $category;
        // print_r($category->all());
        return view('deshboard.editcategory',compact('category','id'));
    }
    function updateCategory(Request $request)
    {
        // print_r($request->all());
        $request->validate([
            'category_name' => 'required',
            'activation' => 'required|numeric',
            'aditional_information' => 'required',
        ]);

        category::findOrFail($request->id)->update([
            'category_name' => $request->category_name,
            'activation' => $request->activation,
            'aditional_information' => $request->aditional_information,
            'updated_at' => Carbon::now(),
            ]);

        return back()->with('greenStatus','Category Updated Successfully 👍');
    }
    //Product..............................................................................
    function manage_product()
    {
        $allcategory = category::all();
        $allproduct = product::where('user_id',Auth::user()->id)->paginate(5);
        $registeredBrands = SalerRegisterBrand::where('saler_id',Auth::user()->id)->where('approval_status',1)->get();
        // $allproduct = product::all();
        return view('deshboard.manage_product',compact('allcategory','allproduct','registeredBrands'));
    }
    function saveNewProduct(Request $request)
    {

        // print_r($request->all());
        // echo $request->photo;
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|numeric|min:5',
            'category' => 'required|numeric',
            'subcategory' => 'required|numeric',
            'activation' => 'required|numeric',
            'brand' => 'required|numeric',
            'description' => 'required',
            'point' => 'required|numeric|max:100|min:0',
            // 'photo' => 'required',
        ]);

        $lastId = product::insertGetId([
            'user_id' => Auth::user()->id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'quantity' => $request->product_quantity,
            'category' => $request->category,
            'sub_category' => $request->subcategory,
            'activation' => $request->activation,
            'brand' => $request->brand,
            'description' => $request->description,
            'point' => $request->point,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if(Auth::user()->role == 3){
            product::findOrFail($lastId)->update([
                'approval' => 1,
                'approvedby' => Auth::user()->id,
            ]);
        }
        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $photoName = $lastId.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(400, 450)->save(base_path( "public/uploads/product/" . $photoName),100);
            product::findOrFail($lastId)->update([
                'photo' => $photoName,
                ]);
        }

            // $makeUrl = url('/') . 'product/view/' . $lastId.'';
            // return back()->with('greenStatus','Product Added Successfully 👍');
            return redirect('manage_product')->with('greenStatus','Product Added Successfully 👍');
            // return redirect('manage_product')->with('greenStatus', $makeUrl);
    }

    function changeProductActivation($id,$activation)
    {
        if ($activation == 1) {
            product::findOrFail($id)->update([
                    'activation' => 0
            ]);
        }
        else {
            product::findOrFail($id)->update([
                'activation' => 1
            ]);
            }
        return back()->with('greenStatus','Product Activation Changed');
    }
    function deleteproduct($id)
    {
        if (product::findOrFail($id)->photo == 'default.png') {
            product::findOrFail($id)->delete();
            return back()->with('greenStatus','Product Deleted');
        }
        else {
            // echo "real Photo";
            $photo = product::findOrFail($id)->photo;
            // echo $photo;
            unlink(base_path("public/uploads/product/".$photo));
            product::findOrFail($id)->delete();
            return back()->with('greenStatus','Product Deleted');
        }
    }
    function editProduct ($productId)
    {
        // echo $productId;
        $productInfo = product::findOrFail($productId);
        $allcategory = category::all();
        // echo $productInfo;
        return view('deshboard.editProduct',compact('allcategory','productInfo'));
    }
    function updateProduct(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|numeric|min:5',
            'category' => 'required|numeric',
            'activation' => 'required|numeric',
            'description' => 'required',
            'point' => 'required|numeric|min:1|max:100',
        ]);
        product::findOrFail($request->id)->update([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'quantity' => $request->product_quantity,
            'category' => $request->category,
            'activation' => $request->activation,
            'description' => $request->description,
            'point' => $request->point,
            'updated_at' => Carbon::now(),
        ]);
        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $photoName = $request->id.'.'.$photo->getClientOriginalExtension();
            if (product::findOrFail($request->id)->photo == 'default.png') {
                Image::make($photo)->resize(400, 450)->save(base_path( "public/uploads/product/" . $photoName),100);
                product::findOrFail($request->id)->update([
                    'photo' => $photoName,
                ]);
            }
            else {
                unlink(base_path("public/uploads/product/".$photoName));
                Image::make($photo)->resize(400, 450)->save(base_path( "public/uploads/product/" . $photoName),100);
            }
        }
        return back()->with('greenStatus','Product Updated');
    }
    ////.......Saler......................................................
    function mysaler()
    {
        $allSler = User::where('role',2)->get();
        return view('deshboard.mysaler',compact('allSler'));
    }
    function addNewSaler(Request $request)
    {
        // print_r($request->all());
        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'approval' => 'required|integer',
            'company_or_industry' => 'required',
        ]);

        User::insert([
            'name' =>$request->user_name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
            'role' => 2,
            'company_or_industry' => $request->company_or_industry,
            'approval' =>$request->approval,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('greenStatus','New saler Added');
    }
    function salerApproval($id,$approavl)
    {
        User::findOrFail($id)->update([
            'approval'=>$approavl,
        ]);
        return back();
        // if ($approavl == 0) {
        //     User::findOrFail($id)->update([
        //         'approval'=>$approavl,
        //     ]);
        // }
        // elseif ($approavl == 1) {
        //     User::findOrFail($id)->update([

        //     ]);
        // }
        // else {

        // }
    }
    function deleteSaler($userId)
    {
        User::findOrFail($userId)->delete();
        return back();
    }
    function allSalerProduct()
    {
        $allproduct = product::where('user_id','!=',Auth::user()->id)->paginate(20);
        // echo $allproduct;
        return view('deshboard.allSalerProduct',compact('allproduct'));
    }
    function allAdmins()
    {
        // $allAdmins = User::where('role',3)->where('id','!=',Auth::user()->id)->get();
        $allAdmins = User::where('role',3)->get();
        // echo $allAdmins;
        return view('deshboard.allAdmins',compact('allAdmins'));
    }
    function addNewAdmin(Request $request)
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'approval' => 'required|integer',
        ]);

        User::insert([
            'name' =>$request->user_name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
            'role' => 3,
            'approval' =>$request->approval,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('greenStatus','New Admin Added');
    }
    function allBrand()
    {
        $allBrands = Brand::all();
        return view('deshboard.allBrand',compact('allBrands'));
    }
    function saveNewBrand(Request $request)
    {
        // print_r($request->all());
        $request->validate([
            'brand_name' => 'required',
            'activation' => 'required',
            'photo' => 'required',
        ]);
        $lastId = Brand::insertGetId([
            'brand_name' => $request->brand_name,
            'activation' => $request->activation,
            'request' => 1,
            'approvedby' => Auth::user()->id,
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
            return back()->with('greenStatus','Brand Added Successfully 👍');

    }
    function brandRequest()
    {
        $allBrands = Brand::Where('request',0)->get();
        return view('deshboard.brandRequest',compact('allBrands'));
    }
    function brandRequestChange($id,$status)
    {
        Brand::findOrFail($id)->update([
            'request' => 1,
            'approvedby' => Auth::user()->id,

        ]);
        return redirect('allBrand');
    }
    function brandActivation($id,$status)
    {
        if ($status == 1) {
            Brand::findOrFail($id)->update([
                'activation' => 1,
                ]);
                return back();
        }
        else {
            Brand::findOrFail($id)->update([
                'activation' => 0,
            ]);
            return back();
        }
    }
    function getBrandSearch(Request $request)
    {
        // echo $request->searchData;
        $stringToSend = "";
        // $allcity = stock::find('stockid')->all();
        $allcity = Brand::where('brand_name','like', $request->searchData.'%')->get();
        foreach ($allcity as $value) {
        // array_push($stringToSend, $value->buingPrice, $value->sellingPrice);
        if($value->request != 0 && $value->activation != 0){
            $stringToSend .= "<option value='" . $value->id . "'>".$value->brand_name."</option>";
        }
        }
        echo($stringToSend);
    }
    function salerRegisterBrands()
    {
        $registerBrands = SalerRegisterBrand::all();
        return view('deshboard.salerRegisterBrands',compact('registerBrands'));
    }
    function brandRegisterApprove($id,$status)
    {
        if ($id == null and $status==null) {
            return back()->with('yellowStatus','Wrong brtand information');
        } else {
            SalerRegisterBrand::findOrFail($id)->update([
            'approval_status' =>1,
            'aproved_by' => Auth::user()->id,
            ]);
        }
        return back()->with('greenStatus','Brand Registration Approved');

    }
    function productApprovalChange($id,$status)
    {
        if ($status == 1) {
            product::findOrFail($id)->update([
                'approval' => 1,
                'approvedby' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            product::findOrFail($id)->update([
                'approval' => 0,
                'approvedby' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
        }
        return back();
    }
    function getSubCategory(Request $request)
    {
        $data="";
       $allData=sub_category::where('categoryId',$request->categoryId)->get();
       foreach ($allData as $value) {
            $data.="<option value=".$value->id.">".$value->sub_category_name."</option>";
       }
       echo $data;
    }



    //last bracket here
}
