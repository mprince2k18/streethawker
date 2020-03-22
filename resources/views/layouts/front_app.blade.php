<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home || Truemart Responsive Html5 Ecommerce Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link rel="shortcut icon" href=" {{asset('frontEnd/img/favicon.ico')}} ">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/font-awesome.min.css')}}">
    <!-- Ionicons css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/ionicons.min.css')}}">
    <!-- linearicons css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/linearicons.css')}}">
    <!-- Nice select css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/nice-select.css')}}">
    <!-- Jquery fancybox css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/jquery.fancybox.css')}}">
    <!-- Jquery ui price slider css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/jquery-ui.min.css')}}">
    <!-- Meanmenu css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/meanmenu.min.css')}}">
    <!-- Nivo slider css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/nivo-slider.css')}}">
    <!-- Owl carousel css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/owl.carousel.min.css')}}">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/bootstrap.min.css')}}">
    <!-- Custom css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/default.css')}}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/style.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('frontEnd/css/responsive.css')}}">

    <!-- Modernizer js -->
    <script src="{{asset('frontEnd/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <link href="{{ asset('assets/tost/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('addCss')
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
</head>
    @php
            $allProduct = App\product::all();
            $sub_category = App\sub_category::all();
            // $category = App\category::all();
            // $category = App\category::orderBy('id', 'desc')->take(5)->get();
            // $category = App\category::latest()->take(10)->get();
            $category = App\category::take(10)->get();

            $all_my_carts = App\Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->get();
            $banner_popup  = App\Banner_popup::where('activation',1)->first('banner_popup')->banner_popup;
            if (!$banner_popup) {
                $banner_popup = "default.jpg";
            }
            $logo = App\Logo::where('activation',1)->first('logo')->logo;
            if (!$logo) {
                $logo = "default.png";
            }
    @endphp
<body>
    <!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

    <!-- Main Wrapper Start Here -->
    <div class="wrapper">
        <!-- Banner Popup Start -->
        <div class="popup_banner">
            <span class="popup_off_banner">×</span>
            <div class="banner_popup_area">
                    {{-- <img width="1920" height="150" src="{{asset('frontEnd/img/banner_popup/')}}/{{(App\Banner_popup::where('activation',1)->first('banner_popup'))->banner_popup}}" alt=""> --}}
                    <img width="1920" height="150" src="{{asset('frontEnd/img/banner_popup/')}}/{{$banner_popup}}" alt="No Image">
            </div>
        </div>
        <!-- Banner Popup End -->
       <!-- Newsletter Popup Start -->
        <div class="popup_wrapper">
            <div class="test">
                <span class="popup_off">Close</span>
                <div class="subscribe_area text-center mt-60">
                    <h2>Newsletter</h2>
                    <p>Subscribe to the Truemart mailing list to receive updates on new arrivals, special offers and other discount information.</p>
                    <div class="subscribe-form-group">
                        <form action="#">
                            <input autocomplete="off" type="text" name="message" id="message" placeholder="Enter your email address">
                            <button type="submit">subscribe</button>
                        </form>
                    </div>
                    <div class="subscribe-bottom mt-15">
                        <input type="checkbox" id="newsletter-permission">
                        <label for="newsletter-permission">Don't show this popup again</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter Popup End -->
        <!-- Main Header Area Start Here -->
        <header>
            <!-- Header Top Start Here -->
            <div class="header-top-area">
                <div class="container">
                    <!-- Header Top Start -->
                    <div class="header-top">
                        <ul>
                            {{-- <li><a href="#">Free Shipping on order over $99</a></li> --}}
                            <li><a href="{{ route('hotDealCart') }}"><i class="lnr lnr-cart"></i>Hot Deal Cart</a></li>
                            {{-- <li><a href="{{url('checkOut')}}">Checkout</a></li> --}}
                        </ul>
                        <ul>
                            {{-- <li><span>Language</span> <a href="#">English<i class="lnr lnr-chevron-down"></i></a>
                                <!-- Dropdown Start -->
                                <ul class="ht-dropdown">
                                    <li><a href="#"><img src="{{asset('frontEnd/img/header/1.jpg')}}" alt="language-selector">English</a></li>
                                    <li><a href="#"><img src="{{asset('frontEnd/img/header/2.jpg')}}" alt="language-selector">Francis</a></li>
                                </ul>
                                <!-- Dropdown End -->
                            </li> --}}
                            {{-- <li><span>Currency</span><a href="#"> USD $ <i class="lnr lnr-chevron-down"></i></a>
                                <!-- Dropdown Start -->
                                <ul class="ht-dropdown">
                                    <li><a href="#">&#36; USD</a></li>
                                    <li><a href="#"> € Euro</a></li>
                                    <li><a href="#">&#163; Pound Sterling</a></li>
                                </ul>
                                <!-- Dropdown End -->
                            </li> --}}
                            @auth
                              <li><a href="#">{{ Auth::user()->name }}<i class="lnr lnr-chevron-down"></i></a>
                            @else
                              <li><a href="#">My Account<i class="lnr lnr-chevron-down"></i></a>
                            @endauth
                                <!-- Dropdown Start -->
                                <ul class="ht-dropdown">
                                    @auth
                                    <li><a href="{{url('home')}}">Dashboard</a></li>
                                    <li><a href="{{route('costomer_profile')}}">Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    @else
                                    <li><a href="{{url('login')}}">Login</a></li>
                                    <li><a href="{{url('register')}}">Register</a></li>
                                    @endauth
                                </ul>
                                <!-- Dropdown End -->
                            </li>
                        </ul>
                    </div>
                    <!-- Header Top End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Header Top End Here -->
            <!-- Header Middle Start Here -->
            <div class="header-middle ptb-15">
                <div class="container">
                    <div class="row align-items-center no-gutters">
                        <div class="col-lg-3 col-md-12">
                            <div class="logo mb-all-30">
                                <a href="{{url('/')}}"><img width="214px" height="58px" src="{{asset('frontEnd/img/logo/')}}/{{$logo}}" alt="logo-image"></a>
                            </div>
                        </div>
                        <!-- Categorie Search Box Start Here -->
                        <div class="col-lg-5 col-md-8 ml-auto mr-auto col-10">
                            <div class="categorie-search-box">
                                <form action="searchFromMenu" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <select class="bootstrap-select" name="poscats">
                                            <option value="0">All categories</option>
                                            @foreach ($sub_category as $item)
                                                <option value="{{$item->id}}">{{$item->sub_category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="text" name="search" placeholder="I’m shopping for..." required>
                                    <button><i class="lnr lnr-magnifier"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- Categorie Search Box End Here -->
                        <!-- Cart Box Start Here -->
                        <div class="col-lg-4 col-md-12">
                            <div class="cart-box mt-all-30">
                                <ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
                                    <li><a href="{{url('cart')}}"><i class="lnr lnr-cart"></i><span class="my-cart"><span class="total-pro">{{ App\Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->count() }}</span><span>cart</span></span></a>
                                        <ul class="ht-dropdown cart-box-width">
                                            <li>







                                                @php
                                                    $totalPrice =0;
                                                @endphp
                                            @forelse ($all_my_carts as $item)

                                                <!-- Cart Box Start -->
                                                <div class="single-cart-box">
                                                    <div class="cart-img">
                                                        <a href="{{url('product/view')}}/{{App\product::findOrFail($item->product_id)->id}}"><img width="70px" height="70px" src="{{asset('uploads/product')}}/{{App\product::findOrFail($item->product_id)->photo}}" alt="cart-image"></a>
                                                        <span name="cartQuantity[]" class="pro-quantity cartQuantity">{{$item->product_quantity}}X</span>
                                                    </div>
                                                        @php
                                                            $totalPrice += (App\product::findOrFail($item->product_id)->product_price)*($item->product_quantity);
                                                        @endphp
                                                    <div class="cart-content">
                                                        <h6><a href="product.html">{{App\product::findOrFail($item->product_id)->product_name}}</a></h6>
                                                        <span class="cart-price">{{App\product::findOrFail($item->product_id)->product_price}}</span>
                                                        <span>Size: S , quantity : {{App\Cart::findOrFail($item->id)->product_quantity}}</span>
                                                        <span>Color: Yellow</span>
                                                    </div>
                                                    {{-- <a class="del-icone" href="{{url('deleteCart')}}/{{$item->id}}"><i class="ion-close"></i></a> --}}
                                                    <a class="del-icone delPro" href="" data-del="{{url('deleteCart')}}/{{$item->id}}"><i class="ion-close"></i></a>
                                                </div>
                                                <!-- Cart Box End -->
                                            @empty
                                            No data
                                            @endforelse








                                                <!-- Cart Footer Inner Start -->
                                                <div class="cart-footer">
                                                   <ul class="price-content">
                                                       <li>Subtotal <span>৳{{$totalPrice}}</span></li>
                                                       <li>Shipping <span>৳{{0.00}}</span></li>
                                                       <li>Taxes <span>৳0.00</span></li>
                                                       <li>Total <span>৳{{$totalPrice+0+0}}</span></li>
                                                   </ul>
                                                    <div class="cart-actions text-center">
                                                        <a class="cart-checkout" href="{{url('cart')}}">Checkout</a>
                                                    </div>
                                                </div>
                                                <!-- Cart Footer Inner End -->
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('wishlist') }}"><i class="lnr lnr-heart"></i><span class="my-cart"><span>Wish</span><span>list ({{ App\WishList::count() }})</span></span></a>
                                    </li>
                                    @auth
                                      <li><a href="{{ url('/home') }}"><i class="lnr lnr-user"></i><span class="my-cart"><span> <strong>{{ Auth::user()->name }}</strong></span></span></a>
                                    @else
                                      <li><a href="{{ url('/joinOrRegister') }}"><i class="lnr lnr-user"></i><span class="my-cart"><span> <strong>Sign in</strong> Or</span><span> Join My Site</span></span></a>
                                    @endauth



                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Cart Box End Here -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Header Middle End Here -->
            <!-- Header Bottom Start Here -->
            <div class="header-bottom  header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                         <div class="col-xl-3 col-lg-4 col-md-6 vertical-menu d-none d-lg-block">
                            <span class="categorie-title">Shop by Categories </span>
                            <!-- <nav class="d-none d-lg-block">
                                <ul class="header-bottom-list d-flex">
                                    <li class="active"><a href="index.html"class=categorie-title>HOME<i class="fa fa-angle-down"></i></a>
                                        <ul class="ht-dropdown">



                                                                          @foreach ($category as $item)
                                                                          @if ($item->activation == 1)


                                                                              <li><a href="{{url('shop/category')}}/{{$item->id}}"><span>
                                                                                  <img src="{{asset('frontEnd/img/vertical-menu')}}/{{$item->category_photo}} " alt="menu-icon" width="20px" height="20px">
                                                                                  </span> {{$item->category_name}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                                                                  <ul class="ht-dropdown megamenu first-megamenu">





                                                                                      <li class="single-megamenu">
                                                                                      @foreach ($sub_category as $sub)
                                                                                      @if ($item->id == $sub->categoryId)
                                                                                      @if ($loop->iteration % 2 != 0)
                                                                                      <ul id="bijor">
                                                                                          <li class="menu-tile">{{$sub->sub_category_name}}</li>
                                                                                          @foreach ($allProduct as $singleProduct)
                                                                                              @if ($singleProduct->sub_category === $sub->id)
                                                                                              <li><a href="{{url("product/view")}}/{{$singleProduct->id}}">{{$singleProduct->product_name}}</a></li>
                                                                                              @endif
                                                                                          @endforeach
                                                                                      </ul>
                                                                                      @endif
                                                                                      @endif
                                                                                      @endforeach
                                                                                      </li>
                                                                                      <li class="single-megamenu">
                                                                                      @foreach ($sub_category as $sub)
                                                                                      @if ($item->id == $sub->categoryId)
                                                                                      @if ($loop->iteration % 2 == 0)
                                                                                      <ul id="jor">
                                                                                          <li class="menu-tile">{{$sub->sub_category_name}}</li>
                                                                                          @foreach ($allProduct as $singleProduct)
                                                                                              @if ($singleProduct->sub_category === $sub->id)
                                                                                              <li><a href="{{url("product/view")}}/{{$singleProduct->id}}">{{$singleProduct->product_name}}</a></li>
                                                                                              @endif
                                                                                          @endforeach
                                                                                      </ul>
                                                                                      @endif
                                                                                      @endif
                                                                                      @endforeach
                                                                                      </li>



                                                                                      <li class="megamenu-img">
                                                                                      @foreach ($allProduct as $allp)
                                                                                      @foreach ($sub_category as $sub)
                                                                                      @if ($item->id == $sub->categoryId)
                                                                                          @if ($allp->sub_category == $sub->id)

                                                                                          <a href="shop.html"><img width="224" height="90" src="{{asset('uploads/brand')}}/{{App\Brand::find($allp->brand)->photo}}" alt="menu-image"></a>
                                                                                          @endif
                                                                                      @endif
                                                                                      @endforeach
                                                                                      @endforeach
                                                                                      </li>
                                                                                  </ul>
                                                                              </li>

                                                                          @endif
                                                                          @endforeach




                                        </ul>
                                    </li>

                                </ul>
                            </nav> -->
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-12 ">
                            <nav class="d-none d-lg-block">
                                <ul class="header-bottom-list d-flex">


                                    @foreach (App\category::latest()->take(6)->get() as $item)
                                    <li ><a href="{{ url('/shop/category') }}/{{ $item->id }}">{{ $item->category_name }}<i class="fa fa-angle-down"></i></a>
                                        <!-- Home Version Dropdown Start -->
                                        <ul class="ht-dropdown">
                                          @foreach (App\sub_category::all() as $subCategory)
                                            @if ($item->id == $subCategory->categoryId)
                                            <li><a href="{{ url('/shop/sub_category') }}/{{ $subCategory->id }}">{{ $subCategory->sub_category_name }}</a></li>
                                          @endif
                                          @endforeach
                                        </ul>
                                        <!-- Home Version Dropdown End -->
                                    </li>
                                  @endforeach



                                    <li><a href="{{ route('aboutus') }}">About us</a></li>
                                    <li><a href="{{ route('contact') }}">contact us</a></li>
                                </ul>
                            </nav>
                            <div class="mobile-menu d-block d-lg-none">
                                <nav>
                                    <ul>
                                      @foreach (App\category::latest()->take(6)->get() as $item)
                                        <li><a href="{{ url('/shop/category') }}/{{ $item->id }}">{{ $item->category_name }}</a>
                                            <!-- Home Version Dropdown Start -->
                                            <ul>
                                              @foreach (App\sub_category::all() as $subCategory)
                                                @if ($item->id == $subCategory->categoryId)
                                                <li><a href="{{ url('/shop/sub_category') }}/{{ $subCategory->id }}">{{ $subCategory->sub_category_name }}</a></li>
                                              @endif
                                              @endforeach
                                            </ul>
                                            <!-- Home Version Dropdown End -->
                                        </li>
                                      @endforeach
                                        <li><a href="{{ route('aboutus') }}">about us</a></li>
                                        <li><a href="{{ route('contact') }}">contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Header Bottom End Here -->
            <!-- Mobile Vertical Menu Start Here -->
            <div class="container d-block d-lg-none">
                <div class="vertical-menu mt-30">
                    <span class="categorie-title mobile-categorei-menu">Shop by Categories</span>
                    <nav>
                        <div id="cate-mobile-toggle" class="category-menu sidebar-menu sidbar-style mobile-categorei-menu-list menu-hidden ">
                            <ul>
                                @foreach($category as $item)
                                  @if ($item->activation == 1)
                                <li class="has-sub"><a href="#">{{ $item->category_name }}</a>
                                    <ul class="category-sub">
                                      @foreach($sub_category as $sub)
                                        @if ($item->id == $sub->categoryId && $sub->activation == 1)
                                        <li><a href="{{ url('shop/sub_category') }}/{{ $sub->id }}">{{$sub->sub_category_name}}</a></li>
                                      @endif
                                      @endforeach
                                    </ul>
                                </li>
                              @endif
                              @endforeach
                            </ul>
                        </div>
                        <!-- category-menu-end -->
                    </nav>
                </div>
            </div>
            <!-- Mobile Vertical Menu Start End -->
        </header>
        <!-- Main Header Area End Here -->
        <!-- Categorie Menu & Slider Area Start Here -->
        <div class="main-page-banner pb-50 off-white-bg">
            <div class="container">
                <div class="row">
                    <!-- Vertical Menu Start Here -->
                    <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                        <div class="vertical-menu mb-all-30">
                            <nav>
                                <ul class="vertical-menu-list test_open">















                                @foreach ($category as $item)

                                  @if ($loop->iteration <= 10 && $item->activation == 1)

                                    <li><a href="{{url('shop/category')}}/{{$item->id}}"><span>
                                        <img src="{{asset('frontEnd/img/vertical-menu')}}/{{$item->category_photo}} " alt="menu-icon" width="20px" height="20px">
                                        </span> {{$item->category_name}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <!-- Vertical Mega-Menu Start -->
                                        <ul class="ht-dropdown megamenu first-megamenu">





                                            <!-- Single Column Start -->
                                            <li class="single-megamenu">
                                            @foreach ($sub_category as $sub)
                                            @if ($item->id == $sub->categoryId)
                                            @if ($loop->iteration % 2 != 0)
                                            <ul id="bijor">
                                                <li class="menu-tile">{{$sub->sub_category_name}}</li>
                                                @foreach ($allProduct as $singleProduct)
                                                    @if ($singleProduct->sub_category === $sub->id)
                                                    <li><a href="{{url("product/view")}}/{{$singleProduct->id}}">{{$singleProduct->product_name}}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            @endif
                                            @endif
                                            @endforeach
                                            </li>
                                            <!-- Single Column End -->
                                            <li class="single-megamenu">
                                            @foreach ($sub_category as $sub)
                                            @if ($item->id == $sub->categoryId)
                                            @if ($loop->iteration % 2 == 0)
                                            <ul id="jor">
                                                <li class="menu-tile">{{$sub->sub_category_name}}</li>
                                                @foreach ($allProduct as $singleProduct)
                                                    @if ($singleProduct->sub_category === $sub->id)
                                                    <li><a href="{{url("product/view")}}/{{$singleProduct->id}}">{{$singleProduct->product_name}}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            @endif
                                            @endif
                                            @endforeach
                                            </li>
                                            <!-- Single Column End -->







                                            <!-- Single Megamenu Image Start -->
                                            <li class="megamenu-img">
                                            @foreach ($allProduct as $allp)
                                            @foreach ($sub_category as $sub)
                                            @if ($item->id == $sub->categoryId)
                                                @if ($allp->sub_category == $sub->id)

                                                <a href="#"><img width="224" height="90" src="{{asset('uploads/brand')}}/{{App\Brand::find($allp->brand)->photo}}" alt="menu-image"></a>
                                                @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                            </li>
                                            <!-- Single Megamenu Image End -->
                                        </ul>
                                        <!-- Vertical Mega-Menu End -->
                                    </li>

                                @endif
                                @endforeach













                                    <!-- More Categoies Start -->
                                    <li id="cate-toggle" class="category-menu v-cat-menu">
                                        <ul>
                                            <li class="has-sub"><a href="#">More Categories</a>
                                                <ul class="category-sub">
                                                  @foreach ($category as $item)
                                                    @if ($loop->iteration > 10 && $item->activation ==1)
                                                    <li><a href="{{url('shop/category')}}/{{$item->id}}"><span><img src="{{asset('frontEnd/img/vertical-menu')}}/{{$item->category_photo}}" alt="menu-icon" width="20px" height="20px"></span>{{$item->category_name}} </a></li>
                                                    @endif
                                                  @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- More Categoies End -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Vertical Menu End Here -->
                    <!-- Slider Area Start Here -->
                    <div class="col-xl-9 col-lg-8 slider_box">

                        @yield('sliderOrLogin')

                    </div>
                    <!-- Slider Area End Here -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Categorie Menu & Slider Area End Here -->

        @yield('allContentHere')

        <!-- Support Area Start Here -->
        <div class="support-area bdr-top">
            <div class="container">
                <div class="d-flex flex-wrap text-center">
                    <div class="single-support">
                        <div class="support-icon">
                            <i class="lnr lnr-gift"></i>
                        </div>
                        <div class="support-desc">
                            <h6>Great Value</h6>
                            <span>Nunc id ante quis tellus faucibus dictum in eget.</span>
                        </div>
                    </div>
                    <div class="single-support">
                        <div class="support-icon">
                            <i class="lnr lnr-rocket" ></i>
                        </div>
                        <div class="support-desc">
                            <h6>Whole Country Delivery</h6>
                            <span>Quisque posuere enim augue, in rhoncus diam dictum non</span>
                        </div>
                    </div>
                    <div class="single-support">
                        <div class="support-icon">
                           <i class="lnr lnr-lock"></i>
                        </div>
                        <div class="support-desc">
                            <h6>Safe Payment</h6>
                            <span>Duis suscipit elit sem, sed mattis tellus accumsan.</span>
                        </div>
                    </div>
                    <div class="single-support">
                        <div class="support-icon">
                           <i class="lnr lnr-enter-down"></i>
                        </div>
                        <div class="support-desc">
                            <h6>Shop Confidence</h6>
                            <span>Faucibus dictum suscipit eget metus. Duis  elit sem, sed.</span>
                        </div>
                    </div>
                    <div class="single-support">
                        <div class="support-icon">
                           <i class="lnr lnr-users"></i>
                        </div>
                        <div class="support-desc">
                            <h6>24/7 Customer Service</h6>
                            <span>Quisque posuere enim augue, in rhoncus diam dictum non.</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Support Area End Here -->
        <!-- Footer Area Start Here -->
        <footer class="off-white-bg2 pt-95 bdr-top pt-sm-55">
            <!-- Footer Top Start -->
            <div class="footer-top">
                <div class="container">
                    <!-- Signup Newsletter Start -->
                    <div class="row mb-60">
                         <div class="col-xl-7 col-lg-7 ml-auto mr-auto col-md-8">
                            <div class="news-desc text-center mb-30">
                                 <h3>Sign Up For Newsletters</h3>
                                 <p>Be the First to Know. Sign up for newsletter today</p>
                             </div>
                             <div class="newsletter-box">
                                 <form action="#">
                                      <input class="subscribe" placeholder="your email address" name="email" id="subscribe" type="text">
                                      <button type="submit" class="submit">subscribe!</button>
                                 </form>
                             </div>
                         </div>
                    </div>
                    <!-- Signup-Newsletter End -->
                    <div class="row">
                        <!-- Single Footer Start -->
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer mb-sm-40">
                                <h3 class="footer-title">Information</h3>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li><a href="about.html">About Us</a></li>
                                        <li><a href="#">Delivery Information</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="contact.html">Terms & Conditions</a></li>
                                        <li><a href="login.html">FAQs</a></li>
                                        <li><a href="login.html">Return Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Single Footer Start -->
                        <!-- Single Footer Start -->
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer mb-sm-40">
                                <h3 class="footer-title">Customer Service</h3>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li><a href="contact.html">Contact Us</a></li>
                                        <li><a href="#">Returns</a></li>
                                        <li><a href="#">Order History</a></li>
                                        <li><a href="wishlist.html">Wish List</a></li>
                                        <li><a href="#">Site Map</a></li>
                                        <li><a href="#">Gift Certificates</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Single Footer Start -->
                        <!-- Single Footer Start -->
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer mb-sm-40">
                                <h3 class="footer-title">Extras</h3>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li><a href="#">Newsletter</a></li>
                                        <li><a href="#">Brands</a></li>
                                        <li><a href="#">Gift Certificates</a></li>
                                        <li><a href="#">Affiliate</a></li>
                                        <li><a href="#">Specials</a></li>
                                        <li><a href="#">Site Map</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Single Footer Start -->
                        <!-- Single Footer Start -->
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer mb-sm-40">
                                <h3 class="footer-title">My Account</h3>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li><a href="contact.html">Contact Us</a></li>
                                        <li><a href="#">Returns</a></li>
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="#">Order History</a></li>
                                        <li><a href="wishlist.html">Wish List</a></li>
                                        <li><a href="#">Newsletter</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Single Footer Start -->
                        <!-- Single Footer Start -->
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-footer mb-sm-40">
                                <h3 class="footer-title">My Account</h3>
                                <div class="footer-content">
                                    <ul class="footer-list address-content">
                                        <li><i class="lnr lnr-map-marker"></i> Address: 169-C, Technohub, Dubai Silicon Oasis.</li>
                                        <li><i class="lnr lnr-envelope"></i><a href="#"> mail Us: Support@truemart.com </a></li>
                                        <li>
                                            <i class="lnr lnr-phone-handset"></i> Phone: (+800) 123 456 789)
                                        </li>
                                    </ul>
                                    <div class="payment mt-25 bdr-top pt-30">
                                        <a href="#"><img class="img" src="{{asset('frontEnd/img/payment/1.png')}}" alt="payment-image"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Footer Start -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Footer Top End -->
            <!-- Footer Middle Start -->
            <div class="footer-middle text-center">
                <div class="container">
                    <div class="footer-middle-content pt-20 pb-30">
                            <ul class="social-footer">
                                <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><img src="{{asset('frontEnd/img/icon/social-img1.png')}}" alt="google play"></a></li>
                                <li><a href="#"><img src="{{asset('frontEnd/img/icon/social-img2.png')}}" alt="app store"></a></li>
                            </ul>
                    </div>
                </div>
                <!-- Container End -->
            </div>
            <!-- Footer Middle End -->
            <!-- Footer Bottom Start -->
            <div class="footer-bottom pb-30">
                <div class="container">

                     <div class="copyright-text text-center">
                        <p>Copyright © {{ date('Y') }} <a target="_blank" href="https://streethawker.com.bd">Street Hawker</a> All Rights Reserved.</p>
                     </div>
                </div>
                <!-- Container End -->
            </div>
            <!-- Footer Bottom End -->
        </footer>
        <!-- Footer Area End Here -->
        <!-- Quick View Content Start -->
        <div class="main-product-thumbnail quick-thumb-content">
            <div class="container">
                <!-- The Modal -->
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Main Thumbnail Image Start -->
                                    <div class="col-lg-5 col-md-6 col-sm-5">
                                        <!-- Thumbnail Large Image start -->
                                        <div class="tab-content">
                                            <div id="thumb1" class="tab-pane fade show active">
                                                <a data-fancybox="images" href="{{asset('frontEnd/img/products/35.jpg')}}"><img class="pQuickImg"  src="{{asset('frontEnd/img/products/35.jpg')}}" alt="product-view"></a>
                                            </div>
                                            <div id="thumb2" class="tab-pane fade">
                                                <a data-fancybox="images" href="{{asset('frontEnd/img/products/13.jpg')}}"><img class="pQuickImg"  src="{{asset('frontEnd/img/products/13.jpg')}}" alt="product-view"></a>
                                            </div>
                                            <div id="thumb3" class="tab-pane fade">
                                                <a data-fancybox="images" href="{{asset('frontEnd/img/products/15.jpg')}}"><img class="pQuickImg"  src="{{asset('frontEnd/img/products/15.jpg')}}" alt="product-view"></a>
                                            </div>
                                            <div id="thumb4" class="tab-pane fade">
                                                <a data-fancybox="images" href="{{asset('frontEnd/img/products/4.jpg')}}"><img class="pQuickImg"  src="{{asset('frontEnd/img/products/4.jpg')}}" alt="product-view"></a>
                                            </div>
                                            <div id="thumb5" class="tab-pane fade">
                                                <a data-fancybox="images" href="{{asset('frontEnd/img/products/5.jpg')}}"><img class="pQuickImg"  src="{{asset('frontEnd/img/products/5.jpg')}}" alt="product-view"></a>
                                            </div>
                                        </div>
                                        <!-- Thumbnail Large Image End -->
                                        <!-- Thumbnail Image End -->
                                        <div class="product-thumbnail mt-20">
                                            <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                                <a class="active" data-toggle="tab" href="#thumb1"><img class="pQuickImg" src="{{asset('frontEnd/img/products/35.jpg')}}" alt="product-thumbnail"></a>
                                                <a data-toggle="tab" href="#thumb2"><img class="pQuickImg" src="{{asset('frontEnd/img/products/13.jpg')}}" alt="product-thumbnail"></a>
                                                <a data-toggle="tab" href="#thumb3"><img class="pQuickImg" src="{{asset('frontEnd/img/products/15.jpg')}}" alt="product-thumbnail"></a>
                                                <a data-toggle="tab" href="#thumb4"><img class="pQuickImg" src="{{asset('frontEnd/img/products/4.jpg')}}" alt="product-thumbnail"></a>
                                                <a data-toggle="tab" href="#thumb5"><img class="pQuickImg" src="{{asset('frontEnd/img/products/5.jpg')}}" alt="product-thumbnail"></a>
                                            </div>
                                        </div>
                                        <!-- Thumbnail image end -->
                                    </div>
                                    <!-- Main Thumbnail Image End -->
                                    <!-- Thumbnail Description Start -->
                                    <div class="col-lg-7 col-md-6 col-sm-7">
                                        <div class="thubnail-desc fix mt-sm-40">
                                            {{-- <h3 class="product-header">Printed Summer Dress</h3> --}}
                                            <h3 class="product-header" id="pQuickName">here</h3>
                                            <div class="pro-price mtb-30">
                                                {{-- <p class="d-flex align-items-center"><span  class="prev-price">16.51</span><span class="price" id="pQuickPrice">$15.19</span><span class="saving-price">save 8%</span></p> --}}
                                                <p class="d-flex align-items-center"><span class="price" id="pQuickPrice">00</span></p>
                                            </div>
                                            <p class="mb-20 pro-desc-details" id="pQuickDis">Long printed dress with thin adjustable straps. V-neckline and wiring under the bust with ruffles at the bottom of the dress.</p>
                                            <div class="product-size mb-20 clearfix">
                                                <label>Size</label>
                                                <select class="">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                </select>
                                            </div>
                                            <div class="color mb-20">
                                                <label>color</label>
                                                <ul class="color-list">
                                                    <li>
                                                        <a class="orange active" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="paste" href="#"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="box-quantity d-flex">
                                                {{-- <form action="#">
                                                    <input class="quantity mr-40" type="number" min="1" value="1">
                                                </form> --}}
                                                <a class="add-cart" href="cart.html" id="pQuickAdd">add to cart</a>
                                            </div>
                                            <div class="pro-ref mt-15">
                                                <p><span class="in-stock"><i class="ion-checkmark-round"></i> IN STOCK</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Thumbnail Description End -->
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="custom-footer">
                                <div class="socila-sharing">
                                    <ul class="d-flex">
                                        <li>share</li>
                                        <li><a href="www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="www.google.com"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
                                        <li><a href="www.pinterest.com"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View Content End -->
    </div>
    <!-- Main Wrapper End Here -->

    <!-- jquery 3.2.1 -->
    <script src="{{asset('frontEnd/js/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Countdown js -->
    <script src="{{asset('frontEnd/js/jquery.countdown.min.js')}}"></script>
    <!-- Mobile menu js -->
    <script src="{{asset('frontEnd/js/jquery.meanmenu.min.js')}}"></script>
    <!-- ScrollUp js -->
    <script src="{{asset('frontEnd/js/jquery.scrollUp.js')}}"></script>
    <!-- Nivo slider js -->
    <script src="{{asset('frontEnd/js/jquery.nivo.slider.js')}}"></script>
    <!-- Fancybox js -->
    <script src="{{asset('frontEnd/js/jquery.fancybox.min.js')}}"></script>
    <!-- Jquery nice select js -->
    <script src="{{asset('frontEnd/js/jquery.nice-select.min.js')}}"></script>
    <!-- Jquery ui price slider js -->
    <script src="{{asset('frontEnd/js/jquery-ui.min.js')}}"></script>
    <!-- Owl carousel -->
    <script src="{{asset('frontEnd/js/owl.carousel.min.js')}}"></script>

    <script type="text/javascript" src="http://techmytip.com/demos/smoothproducts/js/smoothproducts.min.js"></script>
    <!-- Bootstrap popper js -->
    <script src="{{asset('frontEnd/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('frontEnd/js/bootstrap.min.js')}}"></script>
    <!-- Plugin js -->
    <script src="{{asset('frontEnd/js/plugins.js')}}"></script>
    <!-- Main activaion js -->
    <script src="{{asset('frontEnd/js/main.js')}}"></script>
    {{-- Toaster --}}
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- Toasterend --}}
    <script>
        @if(Session::has('greenStatus'))
                    toastr.success("{{ Session::get('greenStatus') }}");
        @endif
    </script>
    <script>

        $('.delPro').click(e => {
            e.preventDefault();
            let element = e.target.parentElement.dataset.del;
            // console.log(element);
            let xhr = new XMLHttpRequest();
            xhr.open('get',element,true);
            xhr.send();
            window.location.reload();
        });
    </script>
    @yield('js')

        {{-- @if(Session::has('redStatus'))
        toastr.error("{{ Session::get('redStatus') }}");
        @endif --}}
    </script>
    <script>
        @if(Session::has('yellowStatus'))
                    toastr.warning("{{ Session::get('yellowStatus') }}");
        @endif
    </script>
    <script>
        @if(Session::has('redStatus'))
              toastr.error("{{ Session::get('redStatus') }}");
        @endif
    </script>
    <script>
        @if($errors->all())
                toastr.error("Error Occared ! Please Check The Form Requirements 😢");
                @foreach ($errors->all() as $item)
                toastr.warning("{{ $item }}");
                @endforeach
                @endif
    </script>
    <script>


    $('.lnr-magnifier').on('click',function (e) {
      let singleProduct = e.target.parentElement.parentElement.parentElement;
      let imageDiv = e.target.parentElement.parentElement;
      let productImage = imageDiv.children[0].children[0].src;//
      // console.log(singleProduct);
      console.clear();
      // console.log(productImage);
      let proInfo = singleProduct.children[1].children[0];
      let proName = proInfo.children[0].children[0].textContent;
      let proPrice = proInfo.children[1].children[0].textContent;
      // console.log();
      document.getElementById('pQuickName').innerHTML = proName;
      document.getElementById('pQuickAdd').href = singleProduct.children[1].children[1].children[0].children[0].href;
      document.getElementById('pQuickPrice').innerHTML = proPrice;
      // document.querySelector('.pQuickImg').src = productImage;
      // document.querySelector('.pQuickImg').src = productImage;
      // $(".pQuickImg").src(productImage);
      let allQDiv = document.querySelectorAll('.pQuickImg');
      allQDiv.forEach(item => {
        item.src = productImage;
      });
    });


    </script>
    <script>

    $('body').ready(function () {
      // runHotdealChecker
      let mainUrl = window.location.origin;
      let  rq = mainUrl+"/runHotdealChecker";
      // console.clear();
      // console.log(rq);
      var xhr = new XMLHttpRequest();


      setInterval(function () {
        xhr.open('get', rq, true);
        xhr.onload = function() {
            if (this.status === 200) {
                // console.log("Status : " + this.status);
                // var resposce = JSON.parse(this.responseText);
                // var result = document.getElementById('result');
                // var content = '';
                // resposce.forEach(function(data) {
                //     content += `<h1>${data.title}</h1><p>${data.body}</p>`;
                // });
                // result.innerHTML = content;
            }
            else{
              console.log("Some Error "+ this.status);
            }
        }
        xhr.send();
      }, 30000);
    });

    </script>
    <script>
      let mainUrl = window.location.origin+'/';
      let currentUrl = window.location.href;

      if (mainUrl != currentUrl) {
        document.querySelector('.test_open').style.display = 'none';
      }
    </script>
@yield('addNewScript');

</body>

</html>
