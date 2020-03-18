<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $allProduct = App\product::all();
    // $category = App\category::all();
    // $sub_category = App\sub_category::all();
    // return view('welcome',compact('allProduct','category','sub_category'));
    $sliders = App\Slider_background::where('activation',1)->get();
    if (!$sliders) {
        $sliders = "default.jpg";
    }
    $brand_banner = App\Brand_banner::where('activation', 1)->first()->brand_banner;
    if (!$brand_banner) {
        $brand_banner = "default.jpg";
    }
    $managepromotionalcateogry = App\Manage_promotional_cateogry::all();
    $brands = App\Brand::all();




    $allOrderCart = App\orderedCarts::all();
    $topQ = array();
    $topPId = array();
    $loop = 1;
    foreach($allOrderCart as $single){
      if ($loop <= 2) {
      if(App\billingOrderDetails::where('order_id',$single->orderID)->first()->actionStatus == 3){

      if (in_array($single->product_id , $topPId)) {
        $index = array_search($single->product_id, $topPId);
        $topQ[$index] = $topQ[$index]+1;
      }
      else{
        array_push($topPId, $single->product_id );
        array_push($topQ, 1);
      }
      $loop++;
      }
      }
    }

    // print_r($topPId);

    return view('welcome',compact('sliders', 'brand_banner','managepromotionalcateogry','brands','topQ','topPId'));
});

Route::get('/getBrandJson', 'CartController@getBrandJson')->name('getBrandJson');
Route::get('/searchByBrand/{id}', 'CartController@searchByBrand')->name('searchByBrand');


// Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home','CartController@home')->name('home')->middleware('auth')->middleware('verified');
// Route::get('/home', function ()
// {
//     $allProduct = App\product::all();
//     return view('home',compact('allProduct'));
// })->name('home');

Route::get('/notApproved', function(){
        return view('notApproved');
})->name('notApproved');

Route::get('/Banded', function(){
    return view('Banded');
})->name('Banded');

// Route::get('/deshboard', 'HomeController@deshboard')->name('deshboard')->middleware('verified')->middleware('userapproval');
// Route::get('/deshboard', 'HomeController@deshboard')->name('deshboard');
Route::get('/deshboard', 'CartController@home')->name('deshboard')->middleware('auth')->middleware('verified')->middleware('userrestriction');
//Category
Route::get('/manage_categories', 'HomeController@manage_categories')->name('manage_categories');
Route::post('/saveNewCategory', 'HomeController@saveNewCategory')->name('saveNewCategory');
Route::get('/editcategory', 'HomeController@editcategory');
Route::get('/deletecategory/{categoryId}', 'HomeController@deletecategory');
Route::get('/changeCategoryActivation/{categoryId}/{activaiton}', 'HomeController@changeCategoryActivation');
Route::get('/editcategory/{categoryId}', 'HomeController@editcategory');
Route::post('/updateCategory', 'HomeController@updateCategory')->name('updateCategory');
// Promotional Category
Route::get('/Manage_promotional_cateogry', 'HomeController@Manage_promotional_cateogry')->name('Manage_promotional_cateogry');
Route::post('/getCategorySearch', 'HomeController@getCategorySearch')->name('getCategorySearch');
Route::post('/new_promotional_cateogry', 'HomeController@new_promotional_cateogry')->name('new_promotional_cateogry');
Route::get('/removePromotionalCategory/{id}', 'HomeController@removePromotionalCategory')->name('removePromotionalCategory');


//sub category
Route::get('/manage_sub_categories', 'HomeController@manage_sub_categories')->name('manage_sub_categories');
Route::post('/saveNewSubCategory', 'HomeController@saveNewSubCategory')->name('saveNewSubCategory');
Route::post('/getSubCategory', 'HomeController@getSubCategory')->name('getSubCategory');

//Product
Route::get('/manage_product', 'HomeController@manage_product')->name('manage_product');
Route::post('/saveNewProduct', 'HomeController@saveNewProduct')->name('saveNewProduct');
Route::get('/changeProductActivation/{pId}/{activaiton}', 'HomeController@changeProductActivation');
Route::get('/deleteproduct/{pId}', 'HomeController@deleteproduct');
Route::get('/editProduct/{categoryId}', 'HomeController@editProduct');
Route::post('/updateProduct', 'HomeController@updateProduct')->name('updateProduct');
//Brand Admin
Route::get('/allBrand', 'HomeController@allBrand')->name('allBrand');
Route::post('/saveNewBrand', 'HomeController@saveNewBrand')->name('saveNewBrand');
Route::get('/brandRequest', 'HomeController@brandRequest')->name('brandRequest');
Route::get('/brandRequestChange/{id}/{status}', 'HomeController@brandRequestChange');
Route::get('/brandActivation/{id}/{status}', 'HomeController@brandActivation');
Route::post('/HotDealController', 'HomeController@getBrandSearch');
Route::get('/productApprovalChange/{id}/{status}', 'HomeController@productApprovalChange');

//Saler....................................................................................
// Route::get('/mysaler','HomeController@mysaler')->name('mysaler')->middleware('userrestriction');
Route::get('/mysaler','HomeController@mysaler')->name('mysaler');
Route::post('/addNewSaler', 'HomeController@addNewSaler')->name('addNewSaler');
Route::get('/salerApproval/{userid}/{approval}','HomeController@salerApproval')->name('salerApproval');
Route::get('/deleteSaler/{userid}','HomeController@deleteSaler')->name('deleteSaler');
Route::get('/allSalerProduct','HomeController@allSalerProduct')->name('allSalerProduct');
Route::get('/salerRegisterBrands','HomeController@salerRegisterBrands')->name('salerRegisterBrands');
Route::get('/salerRegisterBrands','HomeController@salerRegisterBrands')->name('salerRegisterBrands');
Route::get('/salerRegisterBrands','HomeController@salerRegisterBrands')->name('salerRegisterBrands');
Route::get('/brandRegisterApprove/{id}/{status}','HomeController@brandRegisterApprove')->name('brandRegisterApprove');
// New Admin..........
Route::get('/allAdmins','HomeController@allAdmins')->name('allAdmins');
Route::post('/addNewAdmin', 'HomeController@addNewAdmin')->name('addNewAdmin');
//Saler COntroller.........
Route::get('/saler/brand','SalerController@salerbrand')->name('salerbrand');
Route::post('/addNewBrand', 'SalerController@addNewBrand')->name('addNewBrand');
Route::post('/requestNewBrand', 'SalerController@requestNewBrand')->name('requestNewBrand');

//...........Cart....................................................................................
Route::get('/cart','CartController@cart')->name('cart');
Route::get('/cart/{coupon}','CartController@cartWithCoupon');

Route::get('/add/to/cart/{product_id}','CartController@addtocart')->name('addtocart');
Route::post('/updateCart',"CartController@updateCart")->name('updateCart');
Route::get('/clearCart','CartController@clearCart')->name('clearCart');
Route::get('/deleteCart/{cartId}','CartController@deleteCart');

// HotDeal Cart
Route::get('/hotDealCart','HotDealCartController@hotDealCart')->name('hotDealCart');
Route::get('/add/to/hotDealCart/{product_id}','HotDealCartController@addtohotDealCart')->name('addtohotDealCart');
Route::post('/updatehotDealCart',"HotDealCartController@updatehotDealCart")->name('updatehotDealCart');
Route::get('/clearHotDealCart','HotDealCartController@clearHotDealCart')->name('clearHotDealCart');
Route::get('/deletehotDealCart/{cartId}','HotDealCartController@deletehotDealCart');

//Cart CheckOut
Route::post('/checkOut','CartController@checkOut')->name('checkOut')->middleware('auth')->middleware('verified');
Route::post('/getCityName','CartController@getCityName')->name('getCityName');
//Place Order
Route::post('/placeOrder', 'CartController@placeOrder')->name('placeOrder');
//Security Pin
Route::get('/createSecurityPin','SecurityPinController@createSecurityPin')->name('createSecurityPin');
Route::get('/saveNewSecurityPin/{digit}/{generate}','SecurityPinController@saveNewSecurityPin')->name('saveNewSecurityPin');
Route::get('/unusedPin','SecurityPinController@unusedPin')->name('unusedPin');
Route::get('/removePin/{pinId}','SecurityPinController@removePin')->name('removePin');
Route::get('/userRegisteredPin','SecurityPinController@userRegisteredPin')->name('userRegisteredPin');
Route::get('/UserInformation','SecurityPinController@UserInformation')->name('UserInformation');

Route::get('/getSubCategory','CartController@getSubCategory');
//product View
Route::get('/product/view/{product_id}','CartController@productview');

//product search.....
Route::post('/searchFromMenu', 'CartController@searchFromMenu')->name('searchFromMenu');
Route::get('/shop/category/{id}', 'CartController@shopcategory')->name('shopcategory');
Route::get('/shop/sub_category/{id}', 'CartController@shopsub_category')->name('shopsub_category');


//Customer....................................
// Route::get('/customer/profile/','CustomerController@profile')->name('costomer_profile');
Route::get('/customer/profile/','CartController@profile')->name('costomer_profile');
Route::post('saveProfile','CartController@saveProfile')->name('saveProfile');
Route::post('checkOutBillingDetails','CartController@checkOutBillingDetails')->name('checkOutBillingDetails');

//Orders...............................................
Route::get('/myOrders', 'CartController@myOrders')->name('myOrders');
Route::get('/my/order/details/{orderID}', 'CartController@myorderdetails');
Route::get('/show/products/{orderID}', 'CartController@showproducts');
// Route::get('/myOrders', 'CartController@myOrders')->name('myOrders);


//Stripe..............................................
Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');


//Hot Deal............................................
Route::get('manageHotDeal', 'HotDealController@manageHotDeal')->name('manageHotDeal');
Route::post('getProductSearch', 'HotDealController@getProductSearch')->name('getProductSearch');
Route::post('addNewHotDeal', 'HotDealController@addNewHotDeal')->name('addNewHotDeal');
Route::get('hotDeal/Delete/{id}', 'HotDealController@hotDealDelete')->name('hotDealDelete');
Route::get('runHotdealChecker', 'HotDealController@runHotdealChecker')->name('runHotdealChecker');


//Front-End UI
Route::get('page/theme/settings/logo', 'UIController@logo')->name('logo');
Route::get('page/theme/settings/banner_popup', 'UIController@banner_popup')->name('banner_popup');
Route::get('page/theme/settings/slider_background', 'UIController@slider_background')->name('slider_background');
Route::get('page/theme/settings/brand_banner', 'UIController@brand_banner')->name('brand_banner');
Route::get('page/theme/settings/big_banner', 'UIController@big_banner')->name('big_banner');
Route::get('page/theme/settings/2ndbig_banner', 'UIController@big_banner_two')->name('big_banner_two');
//Front-End Save URL (POST)
Route::post('saveNewLogo', 'UIController@saveNewLogo')->name('saveNewLogo');
Route::post('saveNewBanner_popup', 'UIController@saveNewBanner_popup')->name('saveNewBanner_popup');
Route::post('saveNewSlider', 'UIController@saveNewSlider')->name('saveNewSlider');
Route::post('saveNewBrandBbanner', 'UIController@saveNewBrandBbanner')->name('saveNewBrandBbanner');
//Front-End Remove URL (GET)
Route::get('/theme/settings/logo/remove/{logoId}', 'UIController@removeLogo')->name('removeLogo');

//Front-End Activation URL (GET)
Route::get('/theme/settings/logo/activation/{logoId}/{logoActivation}', 'UIController@changeLogoActivation')->name('changeLogoActivation');
Route::get('/theme/settings/logo/delete/{logoId}', 'UIController@changeLogodelete')->name('changeLogodelete');

Route::get('/theme/settings/banner_popup/activation/{logoId}/{logoActivation}', 'UIController@changeBanner_popupActivation')->name('changeBanner_popupActivation');
Route::get('/theme/settings/banner_popup/delete/{logoId}', 'UIController@changeBanner_popupdelete')->name('changeBanner_popupdelete');

Route::get('/theme/settings/slider/activation/{logoId}/{logoActivation}', 'UIController@changesliderActivation')->name('changesliderActivation');
Route::get('/theme/settings/slider/detele/{logoId}', 'UIController@changesliderdelete')->name('changesliderdelete');

Route::get('/theme/settings/brand_banner/activation/{logoId}/{logoActivation}', 'UIController@changebrand_bannerActivation')->name('changebrand_bannerActivation');
Route::get('/theme/settings/brand_banner/detele/{logoId}', 'UIController@changebrand_bannerdelete')->name('changebrand_bannerdelete');

//thanksForOrdering page
Route::get('/thanksForOrdering', 'CartController@thanksForOrdering')->name('thanksForOrdering');


// Site Register links
Route::get('/vendor/register', 'vendorManberRegisterController@vendorRegister')->name('vendorRegister');
Route::post('vendorRegisterPost', 'vendorManberRegisterController@vendorRegisterPost')->name('vendorRegisterPost');

Route::get('/joinOrRegister', 'vendorManberRegisterController@joinOrRegister')->name('joinOrRegister');

Route::get('/mamber/register', 'vendorManberRegisterController@mamberRegister')->name('mamberRegister');
Route::post('memberRegisterPost', 'vendorManberRegisterController@memberRegisterPost')->name('memberRegisterPost');


// Wish List
Route::get('/wish/list', 'WishListController@wishlist')->name('wishlist');
Route::get('/add/to/wish/list/{product_id}', 'WishListController@addtowishlist')->name('addtowishlist');
Route::get('remove/from/wish/list/{product_id}', 'WishListController@removefromwishlist')->name('removefromwishlist');


// Socialite
Route::get('auth/google', 'SocialiteController@redirectToGoogle');
Route::get('auth/google/callback', 'SocialiteController@handleGoogleCallback');


Route::get('showInv', 'CartController@showInv');
Route::get('/aboutus', 'CustomerController@aboutus')->name('aboutus');
Route::get('/contact', 'CustomerController@contact')->name('contact');


// Coupon Route...................
Route::get('allCoupon', 'CouponController@allCoupon')->name('allCoupon');
Route::post('saveNewCoupon', 'CouponController@saveNewCoupon')->name('saveNewCoupon');
Route::get('couponActivation/{id}/{ac}', 'CouponController@couponActivation')->name('couponActivation');
Route::get('couponDelete/{id}', 'CouponController@couponDelete')->name('couponDelete');

Route::post('applyCoupon', 'CouponController@applyCoupon')->name('applyCoupon');
