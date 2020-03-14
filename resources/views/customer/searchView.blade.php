@extends('layouts.front_app')

@section("allContentHere")


@section('addCss')
  <style>
.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 25px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: #f9af51;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: #4CAF50;
  cursor: pointer;
}
</style>
@endsection










       <!-- Breadcrumb Start -->
        <div class="breadcrumb-area mt-30">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="d-flex align-items-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="#">Srarch Result</a></li>
                    </ul>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Breadcrumb End -->
        {{-- <!-- Blog Page Start Here -->
        <div class="blog ptb-100  ptb-sm-60">
            <div class="container">
                <div class="main-blog">
                    <div class="row">



                        @foreach ($afterSearch as $item)
                        <!-- Single Blog Start -->
                        <div class="col-lg-6 col-sm-12">
                           <div class="single-latest-blog">
                               <div class="blog-img">
                                   <a href="{{url('product/view')}}/{{$item->id}}"><img src="{{asset('/uploads/product')}}/{{$item->photo}}" alt="blog-image"></a>
                               </div>
                               <div class="blog-desc">
                                   <h4><a href="{{url('product/view')}}/{{$item->id}}">{{$item->product_name}}</a></h4>
                                    <ul class="meta-box d-flex">
                                        <li><a href="#"> By : {{App\Brand::findOrFail($item->brand)->brand_name}}</a></li>
                                    </ul>
                                    <p> Price : TK. {{$item->product_price}}</p>
                                    <a  class="readmore addCartBtn" href="#" data-addCart="{{url('add/to/cart')}}/{{$item->id}}">Add To Cart</a>
                               </div>

                           </div>
                        </div>
                        <!-- Single Blog End -->
                        @endforeach



                    </div>
                    <!-- Row End -->
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="pro-pagination">
                                    <ul class="blog-pagination">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                    <div class="product-pagination">
                                        <span class="grid-item-list">Showing 1 to 12 of 51 (5 Pages)</span>
                                    </div>
                                </div>
                                <!-- Product Pagination Info -->
                        </div>
                    </div>
                    <!-- Row End -->
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Blog Page End Here --> --}}



























































        <!-- Shop Page Start -->
        <div class="main-shop-page pt-100 pb-100 ptb-sm-60">
            <div class="container">
                <!-- Row End -->
                <div class="row">
                    <!-- Sidebar Shopping Option Start -->
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="sidebar">
                            <!-- Sidebar Electronics Categorie Start -->

                            @if ($sub_category)
                            <div class="electronics mb-40">
                                <h3 class="sidebar-title">{{ App\category::findOrFail(App\sub_category::findOrFail($sub_category)->categoryId)->category_name }}</h3>
                                <div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style">
                                    <ul>
                                        <li class="has-sub"><a href="#">{{App\sub_category::findOrFail($sub_category)->sub_category_name}}</a>
                                            <ul class="category-sub">
                                              @foreach (App\product::where('sub_category',$sub_category)->latest()->take(5)->get() as $element)
                                                <li><a href="{{url("product/view")}}/{{$element->id}}">{{$element->product_name}}</a></li>
                                              @endforeach
                                            </ul>
                                            <!-- category submenu end-->
                                        </li>
                                    </ul>
                                </div>
                                <!-- category-menu-end -->
                            </div>
                            @endif
                            <!-- Sidebar Electronics Categorie End -->
                            <!-- Price Filter Options Start -->
                            <div class="search-filter mb-40">
                                <h3 class="sidebar-title">filter by price</h3>
                                {{-- block --}}



                                <div class="slidecontainer">
                                  <input id="p_sidbar" type="range" min="1" max="100" value="1" class="slider" id="myRange">
                                  <p class="amount-range">৳<span class="p_max">All</span></p>
                                </div>


                            </div>
                            <!-- Price Filter Options End -->

                            <!-- Product Top Start -->
                            <div class="top-new mb-40">
                                <h3 class="sidebar-title">Top New</h3>
                                <div class="side-product-active owl-carousel">
                                    <!-- Side Item Start -->
                                    <div class="side-pro-item">
                                        <!-- Single Product Start -->
                                        @foreach (App\product::latest()->take(4)->get() as $element)
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="{{url("product/view")}}/{{$element->id}}">
                                                    <img class="primary-img" src="{{asset('uploads/product')}}/{{$element->photo}}" alt="single-product--">
                                                    <img class="secondary-img" src="{{asset('uploads/product')}}/{{$element->photo}}" alt="single-product--">
                                                </a>
                                                {{-- <div class="label-product l_sale">30---<span class="symbol-percent">%</span></div> --}}
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="{{url("product/view")}}/{{$element->id}}">{{$element->product_name}}</a></h4>
                                                <p><span class="price">Tk. {{$element->product_price}}</span></p>
                                                {{-- <p><span class="price">$130.45</span><del class="prev-price">180.50--</del></p> --}}
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        @endforeach
                                        <!-- Single Product End -->

                                    </div>
                                    <!-- Side Item End -->
                                    <!-- Side Item Start -->
                                    <div class="side-pro-item">
                                        <!-- Single Product Start -->
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img" src="img/products/41.jpg" alt="single-product">
                                                    <img class="secondary-img" src="img/products/42.jpg" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">Silver Work Lamp  Proin</a></h4>
                                                <p><span class="price">$80.45</span><del class="prev-price">$100.50</del></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                        <!-- Single Product Start -->
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img" src="img/products/36.jpg" alt="single-product">
                                                    <img class="secondary-img" src="img/products/35.jpg" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">Silver Work Lamp  Proin</a></h4>
                                                <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                        <!-- Single Product Start -->
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img" src="img/products/33.jpg" alt="single-product">
                                                    <img class="secondary-img" src="img/products/34.jpg" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">Lamp Proin Work  Silver </a></h4>
                                                <p><span class="price">$120.45</span><del class="prev-price">130.50</del></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                        <!-- Single Product Start -->
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img" src="img/products/31.jpg" alt="single-product">
                                                    <img class="secondary-img" src="img/products/32.jpg" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">Work Lamp Silver Proin</a></h4>
                                                <p><span class="price">$140.45</span><del class="prev-price">$150.50</del></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <!-- Side Item End -->
                                    <!-- Side Item Start -->
                                    <div class="side-pro-item">
                                        <!-- Single Product Start -->
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img" src="img/products/15.jpg" alt="single-product">
                                                    <img class="secondary-img" src="img/products/16.jpg" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">Lamp Work Silver Proin</a></h4>
                                                <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                        <!-- Single Product Start -->
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img" src="img/products/17.jpg" alt="single-product">
                                                    <img class="secondary-img" src="img/products/18.jpg" alt="single-product">
                                                </a>
                                                <div class="label-product l_sale">30<span class="symbol-percent">%</span></div>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">Silver Work Lamp  Proin</a></h4>
                                                <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                        <!-- Single Product Start -->
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img" src="img/products/23.jpg" alt="single-product">
                                                    <img class="secondary-img" src="img/products/24.jpg" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">Proin Work Lamp Silver </a></h4>
                                                <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                        <!-- Single Product Start -->
                                        <div class="single-product single-product-sidebar">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img" src="img/products/25.jpg" alt="single-product">
                                                    <img class="secondary-img" src="img/products/26.jpg" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">Work Lamp Silver Proin</a></h4>
                                                <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    <!-- Side Item End -->
                                </div>
                            </div>
                            <!-- Product Top End -->
                            <!-- Single Banner Start -->
                            <div class="col-img">
                                <a href="shop.html"><img src="img/banner/banner-sidebar.jpg" alt="slider-banner"></a>
                            </div>
                            <!-- Single Banner End -->
                        </div>
                    </div>
                    <!-- Sidebar Shopping Option End -->
                    <!-- Product Categorie List Start -->
                    <div class="col-lg-9 order-1 order-lg-2">
                        <!-- Grid & List View Start -->
                        <div class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
                            <div class="grid-list-view  mb-sm-15">
                                <ul class="nav tabs-area d-flex align-items-center">
                                    <li><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                    <li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                                </ul>
                            </div>
                            <!-- Toolbar Short Area Start -->
                            <div class="main-toolbar-sorter clearfix">
                                <div class="toolbar-sorter d-flex align-items-center">
                                    <label>Sort By:</label>
                                    <select class="sorter wide">
                                        <option value="Position">Relevance</option>
                                        <option value="Product Name">Neme, A to Z</option>
                                        <option value="Product Name">Neme, Z to A</option>
                                        <option value="Price">Price low to heigh</option>
                                        <option value="Price" selected>Price heigh to low</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Toolbar Short Area End -->
                            <!-- Toolbar Short Area Start -->
                            <div class="main-toolbar-sorter clearfix">
                                <div class="toolbar-sorter d-flex align-items-center">
                                    <label>Show:</label>
                                    <select class="sorter wide">
                                        <option value="12">12</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="75">75</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Toolbar Short Area End -->
                        </div>
                        <!-- Grid & List View End -->
                        <div class="main-categorie mb-all-40">
                            <!-- Grid & List Main Area End -->
                            <div class="tab-content fix">
                                <div id="grid-view" class="tab-pane fade show active">
                                    <div class="row">


                                    <script>
                                      let max_range = 0;
                                    </script>
                                    @foreach ($afterSearch as $item)
                                        <!-- Single Product Start -->
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                            <div class="single-product">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="{{url('product/view')}}/{{$item->id}}">
                                                        <img class="primary-img" src="{{asset('/uploads/product')}}/{{$item->photo}}" alt="single-product">
                                                        <img class="secondary-img" src="{{asset('/uploads/product')}}/{{$item->photo}}" alt="single-product">
                                                    </a>
                                                    <a  href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <div class="pro-info">
                                                        <h4><a href="product.html">{{$item->product_name}}</a></h4>
                                                        {{-- <p><span class="price">TK. {{$item->product_price}}</span><del class="prev-price">$400.50</del></p> --}}
                                                        <p>TK. <span class="price getP">{{$item->product_price}}</span></p>
                                                        <div class="label-product l_sale">30<span class="symbol-percent">%</span></div>
                                                    </div>
                                                    <div class="pro-actions">
                                                        <div class="actions-primary">
                                                            <a href="#" class="addCartBtn"  title="Add to Cart" data-addCart="{{url('add/to/cart')}}/{{$item->id}}"> + Add To Cart</a>
                                                        </div>
                                                        <div class="actions-secondary">
                                                            <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                            <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    @endforeach



                                    </div>
                                    <!-- Row End -->
                                </div>
                                <!-- #grid view End -->
                                <div id="list-view" class="tab-pane fade">





                                    @foreach ($afterSearch as $item)
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <div class="row">
                                            <!-- Product Image Start -->
                                            <div class="col-lg-4 col-md-5 col-sm-12">
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="{{asset('/uploads/product')}}/{{$item->photo}}" alt="single-product">
                                                        <img class="secondary-img" src="{{asset('/uploads/product')}}/{{$item->photo}}" alt="single-product">
                                                    </a>
                                                    <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                                     <span class="sticker-new">new</span>
                                                </div>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="col-lg-8 col-md-7 col-sm-12">
                                                <div class="pro-content hot-product2">
                                                    <h4><a href="product.html">{{$item->product_name}}</a></h4>
                                                    <p>TK. <span class="price getP">{{$item->product_price}}</span></p>
                                                    <p>{{$item->description}}</p>
                                                    <div class="pro-actions">
                                                        <div class="actions-primary">
                                                            <a href="#" title="" class="addCartBtn" data-addCart="{{url('add/to/cart')}}/{{$item->id}}" data-original-title="Add to Cart"> + Add To Cart</a>
                                                        </div>
                                                        <div class="actions-secondary">
                                                            <a href="compare.html" title="" data-original-title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                            <a href="wishlist.html" title="" data-original-title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                    @endforeach







                                </div>
                                <!-- #list view End -->
                                {{-- <div class="pro-pagination">
                                    <ul class="blog-pagination">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                    <div class="product-pagination">
                                        <span class="grid-item-list">Showing 1 to 12 of 51 (5 Pages)</span>
                                    </div>
                                </div> --}}
                                <!-- Product Pagination Info -->
                            </div>
                            <!-- Grid & List Main Area End -->
                        </div>
                    </div>
                    <!-- product Categorie List End -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Shop Page End -->




































































@section('js')
    <script>
        $('.addCartBtn').click(e => {
            e.preventDefault();
            let element = e.target.dataset.addcart;
            let xhr = new XMLHttpRequest();
            xhr.open('get',element,true);
            xhr.send();
            window.location.reload();
        });
    </script>
    <script>
      // let p_sidbar = document.getElementById('p_sidbar');
      let allPrices = document.querySelectorAll('.getP');
      let pMax = 0;
      for (var i = 0; i < allPrices.length; i++) {
        if (Number(allPrices[i].textContent) > pMax) {
          pMax = allPrices[i].textContent;
          document.getElementById('p_sidbar').max=pMax;
        }
      }

      $('#p_sidbar').change(() => {
        let max = $('#p_sidbar').val();
        // console.log($('#p_sidbar').val());
        document.querySelector('.p_max').innerHTML = max;



      console.clear();
      for (var i = 0; i < allPrices.length; i++) {
        let pElement = allPrices[i].parentElement.parentElement.parentElement.parentElement;
        let pPrince = allPrices[i].textContent;
        if(pPrince > Number(max)){
          if (Number(max) <=1) {
            pElement.style.display="block";
            document.querySelector('.p_max').innerHTML = "All";
          }
          else{
          pElement.style.display="none";
          }
        }
        else {
          pElement.style.display="block";
        }
      }


      });

    </script>
@endsection







@endsection
