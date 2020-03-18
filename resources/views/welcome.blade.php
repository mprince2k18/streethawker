@extends('layouts.front_app')

@section('sliderOrLogin')

<div class="slider-wrapper theme-default">
    <!-- Slider Background  Image Start-->
    <div id="slider" class="nivoSlider">
        @foreach ($sliders as $item)
            <a href="JavaScript : void(0)"><img width="899" height="409" src="{{asset('frontEnd/img/slider')}}/{{$item->slider_background}}" data-thumb="{{asset('frontEnd/img/slider/1.jpg')}}" alt="" title="#htmlcaption" /></a>
        @endforeach
    </div>
    <!-- Slider Background  Image Start-->
</div>
@endsection
@section('allContentHere')

@php
    $allProduct = App\product::orderBy('created_at', 'desc');
    $sub_category = App\sub_category::orderBy('created_at', 'desc')->get();
    $category = App\category::all();
    $hotDeal = App\HotDeal::all();
@endphp
<!-- Categorie Menu & Slider Area End Here -->
<!-- Brand Banner Area Start Here -->
<div class="image-banner pb-50 off-white-bg">
    <div class="container">
        <div class="col-img">
            <a href="javascript : void(0)"><img width="1169" height="60" src="{{asset('frontEnd/img/brand_banner')}}/{{$brand_banner}}" alt="image banner"></a>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Brand Banner Area End Here -->
<!-- Hot Deal Products Start Here -->
<div class="hot-deal-products off-white-bg pb-90 pb-sm-50">
    <div class="container">
        <!-- Product Title Start -->
        <div class="post-title pb-30">
            <h2>hot deals</h2>
        </div>
        <!-- Product Title End -->
        <!-- Hot Deal Product Activation Start -->
        <div class="hot-deal-active owl-carousel">









                    @foreach ($hotDeal as $item)
                    <!-- Single Product Start -->
                    <div class="single-product">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a href="{{ url('product/view') }}/{{ App\product::findOrFail($item->product)->id }}">
                                <img class="primary-img" src="{{asset('uploads/product')}}/{{App\product::findOrFail($item->product)->photo}}" alt="single-product">
                                <img class="secondary-img" src="{{asset('uploads/product')}}/{{App\product::findOrFail($item->product)->photo}}" alt="single-product">
                            </a>
                            <div class="countdown" data-countdown="{{$item->deadline}}"></div>
                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="product.html">{{App\product::findOrFail($item->product)->product_name}}</a></h4>
                                <p><span class="price">৳{{ (App\product::findOrFail($item->product)->product_price) - (((App\product::findOrFail($item->product)->product_price)*$item->rate))/100 }}</span><del class="prev-price">TK. {{App\product::findOrFail($item->product)->product_price}}</del></p>
                                <div class="label-product l_sale">{{$item->rate}}<span class="symbol-percent">%</span></div>
                            </div>
                            <div class="pro-actions">
                                <div class="actions-primary">
                                    <a href="{{__('add/to/hotDealCart')}}/{{$item->id}}" title="Add to Cart">+ Add To HotDeal Cart</a>
                                </div>
                                {{-- <div class="actions-secondary">
                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                    <a href="{{ url('add/to/wish/list') }}/{{$item->product}}" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Product Content End -->
                        @if ($item->newInfo ==1)
                            <span class="sticker-new">new</span>
                        @endif
                    </div>
                    <!-- Single Product End -->
                    @endforeach




                </div>
                <!-- Hot Deal Product Active End -->

            </div>
            <!-- Container End -->
        </div>
        <!-- Hot Deal Products End Here -->
        <!-- Hot Deal Products End Here -->

        <!-- Big Banner Start Here -->
        <div class="big-banner mt-100 pb-85 mt-sm-60 pb-sm-45">
            <div class="container banner-2">

                @foreach ($managepromotionalcateogry as $element)
                <div class="banner-box">
                    <div class="col-img">
                        <a href="{{url('shop/category')}}/{{$element->category_id}}"><img width="224" height="359" src="{{asset('frontEnd/img/categories/')}}/{{$element->relationWithCategory->category_big_photo}}" alt="banner 3"></a>
                    </div>
                </div>
              @endforeach

            </div>
            <!-- Container End -->
        </div>
        <!-- Big Banner End Here -->
        <!-- Arrivals Products Area Start Here -->
        <div class="arrivals-product pb-85 pb-sm-45">
            <div class="container">
                <div class="main-product-tab-area">
                    <div class="tab-menu mb-25">
                        <div class="section-ttitle">
                            <h2>New Arrivals</h2>
                       </div>
                        <!-- Nav tabs -->
                        <ul class="nav tabs-area" role="tablist">
                            @php
                                    $allProduct = App\product::all();
                                    $sub_category = App\sub_category::latest()->take(10)->get();
                                    $category = App\category::all();
                                    @endphp
                            @foreach ($sub_category  as $singleSub)
                            <li class="nav-item">
                                @if ($loop->index == 0)
                                <a class="nav-link active" data-toggle="tab" href="#subCategory{{$singleSub->id}}">{{$singleSub->sub_category_name}}</a>
                                @else
                                <a class="nav-link" data-toggle="tab" href="#subCategory{{$singleSub->id}}">{{$singleSub->sub_category_name}}</a>
                                @endif
                            </li>
                            @endforeach
                        </ul>

                    </div>

                    <!-- Tab Contetn Start -->
                    <div class="tab-content">
                        @foreach ($sub_category  as $singleSub)
                        @if ($loop->index == 0)
                        <div id="subCategory{{$singleSub->id}}" class="tab-pane active">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="electronics-pro-active owl-carousel">
                                <!-- Double Product Start -->
                                @foreach ($allProduct as $item)
                                @if ($item->sub_category == $singleSub->id)
                                <div class="double-product">

                                    <div class="single-product">
                                        <!-- Product Image Start aun aun aun-->
                                        <div class="pro-img">
                                            <a href="{{url('product/view')}}/{{$item->id}}">
                                                <img class="primary-img" src="{{asset('uploads/product')}}/{{$item->photo}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('uploads/product')}}/{{$item->photo}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="product.html">{{$item->product_name}}</a></h4>
                                                <p><span class="price">৳{{$item->product_price}}</span>
                                                    {{-- <del class="prev-price">$400.50</del> --}}
                                                </p>
                                                {{-- <div class="label-product l_sale">30<span class="symbol-percent">%</span></div> --}}
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="{{__('add/to/cart')}}/{{$item->id}}" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="{{ url('add/to/wish/list') }}/{{$item->id}}" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                        <span class="sticker-new">new</span>
                                    </div>

                                </div>
                                @endif
                                @endforeach
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                        @else
                        <div id="subCategory{{$singleSub->id}}" class="tab-pane fade">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="electronics-pro-active owl-carousel">
                                <!-- Double Product Start -->
                                @foreach ($allProduct as $item)
                                @if ($item->sub_category == $singleSub->id)
                                <div class="double-product">

                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{url('product/view')}}/{{$item->id}}">
                                                <img class="primary-img" src="{{asset('uploads/product')}}/{{$item->photo}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('uploads/product')}}/{{$item->photo}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{url('product/view')}}/{{$item->id}}">{{$item->product_name}}</a></h4>
                                                <p><span class="price">৳{{$item->product_price}}</span>
                                                    {{-- <del class="prev-price">$400.50</del> --}}
                                                </p>
                                                <div class="label-product l_sale">30<span class="symbol-percent">%</span></div>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="{{url('add/to/cart')}}/{{$item->id}}" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="{{ url('add/to/wish/list') }}/{{$item->id}}" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                        <span class="sticker-new">new</span>
                                    </div>

                                </div>
                                @endif
                                @endforeach
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <!-- Tab Content End -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Arrivals Products Area End Here -->
        <!-- Arrivals Products Area Start Here -->
        <div class="second-arrivals-product pb-45 pb-sm-5">
            <div class="container">
                <div class="main-product-tab-area">


                    {{-- <div class="tab-menu mb-25">
                        <div class="section-ttitle">
                            <h2>Best Seller</h2>
                       </div>


                        <!-- Nav tabs -->
                        <ul class="nav tabs-area" role="tablist">
                            <li class="nav-item">


                                <a class="nav-link active" data-toggle="tab" href="#electronics2">best</a>

                            </li>
                        </ul>

                    </div> --}}

                    <!-- Tab Contetn Start -->
                    <div class="tab-content">
                        <div id="fshion2" class="tab-pane fade">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="best-seller-pro-active owl-carousel">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{url('product/view')}}/{{$item->id}}">
                                                <img class="primary-img" src="{{asset('frontEnd/img/products/1.jpg')}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('frontEnd/img/products/2.jpg')}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{url('product/view')}}/{{$item->id}}">Work Lamp Silver Proin</a></h4>
                                                <p><span class="price">৳320.45</span></p>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="cart.html" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                     <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{url('product/view')}}/{{$item->id}}">
                                                <img class="primary-img" src="{{asset('frontEnd/img/products/3.jpg')}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('frontEnd/img/products/4.jpg')}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{url('product/view')}}/{{$item->id}}">Gpoly and Bark Eames Style</a></h4>
                                                <p><span class="price">৳150.30</span></p>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="cart.html" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{url('product/view')}}/{{$item->id}}">
                                                <img class="primary-img" src="{{asset('frontEnd/img/products/5.jpg')}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('frontEnd/img/products/6.jpg')}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="product.html">Poly and Bark Vortex Side</a></h4>
                                                <p><span class="price">৳150.45</span></p>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="cart.html" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                     <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="{{asset('frontEnd/img/products/8.jpg')}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('frontEnd/img/products/9.jpg')}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="product.html">Eames and Bark  Style</a></h4>
                                                <p><span class="price">৳180.45</span></p>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="cart.html" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="{{asset('frontEnd/img/products/11.jpg')}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('frontEnd/img/products/12.jpg')}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="product.html">Eames and Vortex Side</a></h4>
                                                <p><span class="price">৳160.45</span></p>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="cart.html" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                     <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="{{asset('frontEnd/img/products/15.jpg')}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('frontEnd/img/products/16.jpg')}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="product.html">Bark Vortex Side Eames</a></h4>
                                                <p><span class="price">৳84.45</span></p>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="cart.html" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="{{asset('frontEnd/img/products/13.jpg')}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('frontEnd/img/products/14.jpg')}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="product.html">Poly and Bark Vortex Side</a></h4>
                                                <p><span class="price">৳95.45</span></p>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="cart.html" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                     <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img" src="{{asset('frontEnd/img/products/1.jpg')}}" alt="single-product">
                                                <img class="secondary-img" src="{{asset('frontEnd/img/products/7.jpg')}}" alt="single-product">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="product.html">Poly and Bark Vortex Side</a></h4>
                                                <p><span class="price">৳84.45</span></p>
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    <a href="cart.html" title="Add to Cart"> + Add To Cart</a>
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                    </div>
                    <!-- Tab Content End -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Arrivals Products Area End Here -->
        <!-- Like Products Area Start Here -->
        <div class="like-product ptb-95 off-white-bg pt-sm-50 pb-sm-55 ">
            <div class="container">
                <div class="like-product-area">
                    <h2 class="section-ttitle2 mb-30">You May Like </h2>
                    <!-- Arrivals Product Activation Start Here -->
                    <div class="like-pro-active owl-carousel">
                        <!-- Double Product Start -->

                        @php
                          $allYouMayLikeStart = App\product::latest()->take(25)->get();
                        @endphp
                        @foreach ($allYouMayLikeStart as $item)





                        <div class="double-product">
                            <!-- Single Product Start -->
                            <div class="single-product">
                                <!-- Product Image Start -->
                                <div class="pro-img">
                                    <a href="{{url('product/view')}}/{{$item->id}}">
                                        <img class="primary-img" src="{{asset('uploads/product')}}/{{$item->photo}}" alt="single-product">
                                        <img class="secondary-img" src="{{asset('uploads/product')}}/{{$item->photo}}" alt="single-product">
                                    </a>
                                    <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                </div>
                                <!-- Product Image End -->
                                <!-- Product Content Start -->
                                <div class="pro-content">
                                    <div class="pro-info">
                                        <h4><a href="{{url('product/view')}}/{{$item->id}}">{{$item->product_name}}</a></h4>
                                        <p><span class="price"> ৳{{$item->product_price}} </span></p>
                                        {{-- <p><span class="price">$84.45</span><del class="prev-price">${{$item->product_price}}</del></p> --}}
                                        {{-- <div class="label-product l_sale">20<span class="symbol-percent">%</span></div> --}}
                                    </div>
                                    <div class="pro-actions">
                                        <div class="actions-primary">
                                            <a href="{{__('add/to/cart')}}/{{$item->id}}" title="Add to Cart"> + Add To Cart</a>
                                        </div>
                                        <div class="actions-secondary">
                                            <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                            <a href="{{ url('add/to/wish/list') }}/{{$item->id}}" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Content End -->
                            </div>

                        </div>


                        @endforeach
                        <!-- Double Product End -->
                    </div>
                    <div class="like-pro-active owl-carousel">
                        <!-- Double Product Start -->

                        @php
                          $allYouMayLikeStart = App\product::take(25)->get();
                        @endphp
                        @foreach ($allYouMayLikeStart as $item)


                          <div class="double-product">
                              <!-- Single Product Start -->
                              <div class="single-product">
                                  <!-- Product Image Start -->
                                  <div class="pro-img">
                                      <a href="{{url('product/view')}}/{{$item->id}}">
                                          <img class="primary-img" src="{{asset('uploads/product')}}/{{$item->photo}}" alt="single-product">
                                          <img class="secondary-img" src="{{asset('uploads/product')}}/{{$item->photo}}" alt="single-product">
                                      </a>
                                      <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                  </div>
                                  <!-- Product Image End -->
                                  <!-- Product Content Start -->
                                  <div class="pro-content">
                                      <div class="pro-info">
                                          <h4><a href="{{url('product/view')}}/{{$item->id}}">{{$item->product_name}}</a></h4>
                                          <p><span class="price">৳{{$item->product_price}}</span></p>
                                          {{-- <p><span class="price">$84.45</span><del class="prev-price">${{$item->product_price}}</del></p> --}}
                                          {{-- <div class="label-product l_sale">20<span class="symbol-percent">%</span></div> --}}
                                      </div>
                                      <div class="pro-actions">
                                          <div class="actions-primary">
                                              <a href="{{__('add/to/cart')}}/{{$item->id}}" title="Add to Cart"> + Add To Cart</a>
                                          </div>
                                          <div class="actions-secondary">
                                              <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                              <a href="{{ url('add/to/wish/list') }}/{{$item->id}}" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Product Content End -->
                              </div>

                          </div>


                        @endforeach
                        <!-- Double Product End -->
                    </div>
                    <!-- Arrivals Product Activation End Here -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Lile Products Area End Here -->
        <!-- Brand Banner Area Start Here -->
        <div class="main-brand-banner pt-95 pb-100 pt-sm-55 pb-sm-60">
            <div class="container">
                <div class="section-ttitle mb-20">
                    <h2>Best Seller</h2>
               </div>
                <div class="row no-gutters">
                    <div class="col-lg-3">
                        @if ( count($topPId) >= 1 )
                          <a href="{{ url('product/view') }}/{{ App\product::findOrFail($topPId[0])->id }}">
                        <div class="col-img">
                            <img src="{{asset('uploads/product')}}/{{App\product::findOrFail($topPId[0])->photo}}" alt="">
                        </div>
                        </a>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <!-- Brand Banner Start -->
                        <div class="brand-banner owl-carousel" id="brandMainDiv">

                            @foreach($brands as $item)
                            <div class="single-brand">
                                <a href="{{ url('searchByBrand') }}/{{ $item->id }}"><img height="299" width="334" src="{{asset('uploads/brand')}}/{{$item->photo}}" alt="brand-image"></a>
                            </div>
                            @endforeach

                        </div>
                        <!-- Brand Banner End -->

                    </div>
                    <div class="col-lg-3">
                        @if ( count($topPId) >= 2 )
                        <a href="{{ url('product/view') }}/{{ App\product::findOrFail($topPId[1])->id }}">
                        <div class="col-img">
                            <img src="{{asset('uploads/product')}}/{{App\product::findOrFail($topPId[1])->photo}}" alt="">
                        </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Brand Banner Area End Here -->
        <div class="big-banner pb-100 pb-sm-60">
            <div class="container big-banner-box">
                <div class="col-img">
                    <a href="#">
                    <img src="{{asset('frontEnd/img/banner/5.jpg')}}" alt="">
                    </a>
                </div>
                <div class="col-img">
                    <a href="#">
                    <img src="{{asset('frontEnd/img/banner/h1-banner3.jpg')}}" alt="">
                    </a>
                </div>
            </div>
            <!-- Container End -->
        </div>
@endsection

@section('addNewScript')
  <script>


  // let jsonUrl = window.location.origin+'/getBrandJson';
  //
  //
  //
  // fetch(jsonUrl)
  //   .then(function(responce) {
  //       return responce.json();
  //   })
  //   .then(function(data) {
  //       let html = '';
  //       let inner  = '';
  //       let brandCount = 1;
  //       console.log(data);
  //
  //       data.forEach(function(item) {
  //           // html += `<a target="_blank" href="${item.download_url}">Image</a>${item.author}<br>`;
  //
  //           html += `<div class="single-brand">
  //                     <a href="#"><img height="299" width="334" src="${window.location.origin}/frontEnd/img/brand/3.jpg" alt="brand-image"></a>
  //                   </div>`;
  //       });
  //       console.log(html);
  //       // document.getElementById('brandMainDiv').innerHTML = html;
  //   })
  //   .catch(function(data) {
  //       console.log(data);
  //   });

  </script>
@endsection
