@extends('layouts.front_app')
@section('addCss')
  <style>
  * {box-sizing: border-box;}

  .img-magnifier-container {
    position:relative;
  }

  .img-magnifier-glass {
    position: absolute;
    /* border: 3px solid #000; */
    border-radius: 50%;
    cursor: none;
    background: transparent;
    /*Set the size of the magnifier glass:*/
    width: 150px;
    height: 150px;
  }
  </style>
  <script>
function magnify(imgID, zoom) {
  var img, glass, w, h, bw;
  img = document.getElementById(imgID);
  /*create magnifier glass:*/
  glass = document.createElement("DIV");
  glass.setAttribute("class", "img-magnifier-glass");
  /*insert magnifier glass:*/
  img.parentElement.insertBefore(glass, img);
  /*set background properties for the magnifier glass:*/
  glass.style.backgroundImage = "url('" + img.src + "')";
  glass.style.backgroundRepeat = "no-repeat";
  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
  bw = 3;
  w = glass.offsetWidth / 2;
  h = glass.offsetHeight / 2;
  /*execute a function when someone moves the magnifier glass over the image:*/
  glass.addEventListener("mousemove", moveMagnifier);
  img.addEventListener("mousemove", moveMagnifier);
  /*and also for touch screens:*/
  glass.addEventListener("touchmove", moveMagnifier);
  img.addEventListener("touchmove", moveMagnifier);
  function moveMagnifier(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    x = pos.x;
    y = pos.y;
    /*prevent the magnifier glass from being positioned outside the image:*/
    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
    if (x < w / zoom) {x = w / zoom;}
    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
    if (y < h / zoom) {y = h / zoom;}
    /*set the position of the magnifier glass:*/
    glass.style.left = (x - w) + "px";
    glass.style.top = (y - h) + "px";
    /*display what the magnifier glass "sees":*/
    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
</script>
@endsection
@section('allContentHere')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="index.html">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li class="active"><a href="product.html">Products</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->

<!-- Product Thumbnail Start -->
       <div class="main-product-thumbnail ptb-100 ptb-sm-60">
           <div class="container">
               <div class="thumb-bg">
                   <div class="row">
                       <!-- Main Thumbnail Image Start -->
                       <div class="col-lg-5 mb-all-40">
                           <!-- Thumbnail Large Image start -->
                           <div class="tab-content">
                               <div id="thumb1" class="tab-pane fade show active img-magnifier-container">
                                   <a data-fancybox="images" href="{{ asset('uploads/product') }}/{{ $product->photo }}"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" id="myImage1" alt="product-view"></a>
                               </div>
                               <div id="thumb2" class="tab-pane fade">
                                   <a data-fancybox="images" href="{{ asset('uploads/product') }}/{{ $product->photo }}"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" id="myImage2" alt="product-view"></a>
                               </div>
                               <div id="thumb3" class="tab-pane fade">
                                   <a data-fancybox="images" href="{{ asset('uploads/product') }}/{{ $product->photo }}"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" id="myImage3" alt="product-view"></a>
                               </div>
                               <div id="thumb4" class="tab-pane fade">
                                   <a data-fancybox="images" href="{{ asset('uploads/product') }}/{{ $product->photo }}"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" id="myImage4" alt="product-view"></a>
                               </div>
                               <div id="thumb5" class="tab-pane fade">
                                   <a data-fancybox="images" href="{{ asset('uploads/product') }}/{{ $product->photo }}"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" id="myImage5" alt="product-view"></a>
                               </div>
                           </div>
                           <!-- Thumbnail Large Image End -->
                           <!-- Thumbnail Image End -->
                           <div class="product-thumbnail mt-15">
                               <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                   <a class="active" data-toggle="tab" href="#thumb1"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="product-thumbnail"></a>
                                   <a data-toggle="tab" href="#thumb2"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="product-thumbnail"></a>
                                   <a data-toggle="tab" href="#thumb3"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="product-thumbnail"></a>
                                   <a data-toggle="tab" href="#thumb4"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="product-thumbnail"></a>
                                   <a data-toggle="tab" href="#thumb5"><img src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="product-thumbnail"></a>
                               </div>
                           </div>
                           <!-- Thumbnail image end -->
                       </div>
                       <!-- Main Thumbnail Image End -->
                       <!-- Thumbnail Description Start -->
                       <div class="col-lg-7">
                           <div class="thubnail-desc fix">
                               <h3 class="product-header">{{ $product->product_name }}</h3>
                               <div class="rating-summary fix mtb-10">
                                   <div class="rating">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star-o"></i>
                                       <i class="fa fa-star-o"></i>
                                       <i class="fa fa-star-o"></i>
                                   </div>
                                   <div class="rating-feedback">
                                       <a href="#">(1 review)</a>
                                       <a href="#">add to your review</a>
                                   </div>
                               </div>
                               <div class="pro-price mtb-30">
                                   <p class="d-flex align-items-center">
                                     {{-- <span class="prev-price">16.51</span> --}}
                                     <span class="price">৳{{ $product->product_price }}</span>
                                     {{-- <span class="saving-price">save 8%</span> --}}
                                   </p>
                               </div>
                               <p class="mb-20 pro-desc-details">{{ $product->description }}</p>
                               <div class="product-size mb-20 clearfix">
                                   <label>Size</label>
                                   <select class="">
                                     <option>S</option>
                                     <option>M</option>
                                     <option>L</option>
                                   </select>
                               </div>
                               <div class="color clearfix mb-20">
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
                               <div class="box-quantity d-flex hot-product2">
                                   <form action="#">
                                       <input class="quantity mr-15" type="number" min="1" value="1">
                                   </form>
                                   <div class="pro-actions">
                                       <div class="actions-primary">
                                           <a href="{{url('add/to/cart')}}/{{$product->id}}" title="" data-original-title="Add to Cart"> + Add To Cart</a>
                                       </div>
                                       <div class="actions-secondary">
                                           {{-- <a href="compare.html" title="" data-original-title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a> --}}
                                           <a href="{{ url('add/to/wish/list') }}/{{$product->id}}" title="" data-original-title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                       </div>
                                   </div>
                               </div>
                               <div class="pro-ref mt-20">
                                   <p><span class="in-stock"><i class="ion-checkmark-round"></i> IN STOCK</span></p>
                               </div>
                               <div class="socila-sharing mt-25">
                                   <ul class="d-flex">
                                       <li>share</li>
                                       <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
                                       <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <!-- Thumbnail Description End -->
                   </div>
                   <!-- Row End -->
               </div>
           </div>
           <!-- Container End -->
       </div>
       <!-- Product Thumbnail End -->


       <!-- Product Thumbnail Description Start -->
       <div class="thumnail-desc pb-100 pb-sm-60">
           <div class="container">
               <div class="row">
                   <div class="col-sm-12">
                       <ul class="main-thumb-desc nav tabs-area" role="tablist">
                           <li><a class="active" data-toggle="tab" href="#dtail">Product Details</a></li>
                           <li><a data-toggle="tab" href="#review">Reviews 1</a></li>
                       </ul>
                       <!-- Product Thumbnail Tab Content Start -->
                       <div class="tab-content thumb-content border-default">
                           <div id="dtail" class="tab-pane fade show active">
                               <p>{{ $product->description }}</p>
                           </div>
                           <div id="review" class="tab-pane fade">
                               <!-- Reviews Start -->
                               <div class="review border-default universal-padding">
                                   <div class="group-title">
                                       <h2>customer review</h2>
                                   </div>
                                   <h4 class="review-mini-title">Truemart</h4>
                                   <ul class="review-list">
                                       <!-- Single Review List Start -->
                                       <li>
                                           <span>Quality</span>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star-o"></i>
                                           <i class="fa fa-star-o"></i>
                                           <label>Truemart</label>
                                       </li>
                                       <!-- Single Review List End -->
                                       <!-- Single Review List Start -->
                                       <li>
                                           <span>price</span>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star-o"></i>
                                           <i class="fa fa-star-o"></i>
                                           <i class="fa fa-star-o"></i>
                                           <label>Review by <a href="https://themeforest.net/user/hastech">Truemart</a></label>
                                       </li>
                                       <!-- Single Review List End -->
                                       <!-- Single Review List Start -->
                                       <li>
                                           <span>value</span>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star-o"></i>
                                           <label>Posted on 7/20/18</label>
                                       </li>
                                       <!-- Single Review List End -->
                                   </ul>
                               </div>
                               <!-- Reviews End -->
                               <!-- Reviews Start -->
                               <div class="review border-default universal-padding mt-30">
                                   <h2 class="review-title mb-30">You're reviewing: <br><span>Faded Short Sleeves T-shirt</span></h2>
                                   <p class="review-mini-title">your rating</p>
                                   <ul class="review-list">
                                       <!-- Single Review List Start -->
                                       <li>
                                           <span>Quality</span>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star-o"></i>
                                           <i class="fa fa-star-o"></i>
                                       </li>
                                       <!-- Single Review List End -->
                                       <!-- Single Review List Start -->
                                       <li>
                                           <span>price</span>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star-o"></i>
                                           <i class="fa fa-star-o"></i>
                                           <i class="fa fa-star-o"></i>
                                       </li>
                                       <!-- Single Review List End -->
                                       <!-- Single Review List Start -->
                                       <li>
                                           <span>value</span>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star"></i>
                                           <i class="fa fa-star-o"></i>
                                       </li>
                                       <!-- Single Review List End -->
                                   </ul>
                                   <!-- Reviews Field Start -->
                                   <div class="riview-field mt-40">
                                       <form autocomplete="off" action="#">
                                           <div class="form-group">
                                               <label class="req" for="sure-name">Nickname</label>
                                               <input type="text" class="form-control" id="sure-name" required="required">
                                           </div>
                                           <div class="form-group">
                                               <label class="req" for="subject">Summary</label>
                                               <input type="text" class="form-control" id="subject" required="required">
                                           </div>
                                           <div class="form-group">
                                               <label class="req" for="comments">Review</label>
                                               <textarea class="form-control" rows="5" id="comments" required="required"></textarea>
                                           </div>
                                           <button type="submit" class="customer-btn">Submit Review</button>
                                       </form>
                                   </div>
                                   <!-- Reviews Field Start -->
                               </div>
                               <!-- Reviews End -->
                           </div>
                       </div>
                       <!-- Product Thumbnail Tab Content End -->
                   </div>
               </div>
               <!-- Row End -->
           </div>
           <!-- Container End -->
       </div>
       <!-- Product Thumbnail Description End -->

       <!-- Realted Products Start Here -->
        <div class="hot-deal-products off-white-bg pt-100 pb-90 pt-sm-60 pb-sm-50">
            <div class="container">
               <!-- Product Title Start -->
               <div class="post-title pb-30">
                   <h2>Realted Products</h2>
               </div>
               <!-- Product Title End -->
                <!-- Hot Deal Product Activation Start -->
                <div class="hot-deal-active owl-carousel">
                    <!-- Single Product Start -->
                    <div class="single-product">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a href="product.html">
                                <img class="primary-img" src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="single-product">
                                <img class="secondary-img" src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="single-product">
                            </a>
                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="product.html">Eames and Vortex Side</a></h4>
                                <p><span class="price">$160.45</span></p>
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
                        <span class="sticker-new">new</span>
                    </div>
                    <!-- Single Product End -->
                    <!-- Single Product Start -->
                    <div class="single-product">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a href="product.html">
                                <img class="primary-img" src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="single-product">
                                <img class="secondary-img" src="{{ asset('uploads/product') }}/{{ $product->photo }}" alt="single-product">
                            </a>
                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="product.html">Work Lamp Silver Proin</a></h4>
                                <p><span class="price">৳320.45</span> <del class="prev-price">৳330.50</del></p>
                                <div class="label-product l_sale">15<span class="symbol-percent">%</span></div>
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
                                <img class="primary-img" src="img/products/21.jpg" alt="single-product">
                                <img class="secondary-img" src="img/products/22.jpg" alt="single-product">
                            </a>
                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="product.html">Gpoly and Bark Eames Style</a></h4>
                                <p><span class="price">৳150.30</span> <del class="prev-price">৳105.50</del></p>
                                <div class="label-product l_sale">22<span class="symbol-percent">%</span></div>
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
                                <img class="primary-img" src="img/products/22.jpg" alt="single-product">
                                <img class="secondary-img" src="img/products/23.jpg" alt="single-product">
                            </a>
                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="product.html">Poly and Bark Vortex Side</a></h4>
                                <p><span class="price">৳90.45</span></p>
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
                        <span class="sticker-new">new</span>
                    </div>
                    <!-- Single Product End -->
                     <!-- Single Product Start -->
                    <div class="single-product">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a href="product.html">
                                <img class="primary-img" src="img/products/8.jpg" alt="single-product">
                                <img class="secondary-img" src="img/products/9.jpg" alt="single-product">
                            </a>
                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="product.html">Eames and Bark  Style</a></h4>
                                <p><span class="price">৳90.45</span><del class="prev-price">৳100.50</del></p>
                                <div class="label-product l_sale">20<span class="symbol-percent">%</span></div>
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
                                <img class="primary-img" src="img/products/15.jpg" alt="single-product">
                                <img class="secondary-img" src="img/products/16.jpg" alt="single-product">
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
                                <img class="primary-img" src="img/products/13.jpg" alt="single-product">
                                <img class="secondary-img" src="img/products/14.jpg" alt="single-product">
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
                                <img class="primary-img" src="img/products/1.jpg" alt="single-product">
                                <img class="secondary-img" src="img/products/7.jpg" alt="single-product">
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
                <!-- Hot Deal Product Active End -->

            </div>
            <!-- Container End -->
        </div>
        <!-- Realated Products End Here -->


@endsection

@section('addNewScript')
  <script>
  /* Initiate Magnify Function
  with the id of the image, and the strength of the magnifier glass:*/
  magnify("myImage1", 3);
  magnify("myImage2", 3);
  magnify("myImage3", 3);
  magnify("myImage4", 3);
  magnify("myImage5", 3);
  </script>
@endsection
