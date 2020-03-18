@extends('layouts.front_app')

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
<div class="about-us p-100 pt-sm-60">
     <div class="container">
         <div class="row">
             <div class="col-lg-6">
                 <div class="sidebar-img mb-all-30">
                     <img src="http://preview.hasthemes.com/truemart/img/blog/10.jpg" alt="single-blog-img">
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="about-desc">
                     <h3 class="mb-10 about-title">About our success story</h3>
                     <p class="mb-20">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
                     <p class="mb-20">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo volup.</p>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu nisi ac mi malesuada vestibulum. Phasellus tempor nunc eleifend cursus molestie. Mauris lectus arcu, pellentesque at sodales sit amet, condimentum id nunc. Donec ornare mattis suscipit. Praesent fermentum accumsan vulputate.</p>
                     <a href="#" class="return-customer-btn read-more">read more</a>
                 </div>
             </div>
         </div>
     </div>
     <!-- Container End -->
 </div>
       <!-- Product Thumbnail End -->




@endsection
