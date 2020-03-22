@extends('layouts.front_app')

@section('sliderOrLogin')














        <!-- Breadcrumb Start -->
        <div class="breadcrumb-area mt-30">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="d-flex align-items-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="cart.html">Cart</a></li>
                    </ul>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Breadcrumb End -->
        <!-- Cart Main Area Start -->

        <div class="cart-main-area ptb-100 ptb-sm-60">
          <div class="container">
          <!-- ACCORDION START -->
          <div class="coupon-accordion">
          <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
          <div id="checkout_coupon" class="coupon-checkout-content">
              <div class="coupon-info">
                  <form action="{{ route('applyCoupon') }}" method="post">
                      <p class="checkout-coupon">
                          @csrf
                          <input type="text" class="code" name="coupon" placeholder="Coupon code" />
                          <input type="submit" value="Apply Coupon" />
                      </p>
                  </form>
              </div>
          </div>
          </div>
          <!-- ACCORDION END -->


                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <!-- Form Start -->

                            <!-- Table Content Start -->
                            <div class="table-content table-responsive mb-45">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <script>
                                            var checkUpdateBtn = 0;
                                        </script>
                                         @php
                                            $totalPrice =0;
                                            $tempTotal =0;
                                            $tempTotalDis =0;
                                            $dis = 0;
                                        @endphp
                                        <form action="{{ route('updateCart') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @forelse ($all_my_carts as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img src="{{asset('uploads/product')}}/{{App\product::findOrFail(App\HotDeal::findOrFail($item->hotdeal_id)->product)->photo}}" alt="cart-image" /></a>
                                            </td>
                                            <td class="product-name"><a href="#">{{App\product::findOrFail(App\HotDeal::findOrFail($item->hotdeal_id)->product)->product_name}}</a></td>
                                            @php
                                                // ৳{{ ($totalPrice*($dis))/100 }}
                                                $tempTotal = (App\product::findOrFail(App\HotDeal::findOrFail($item->hotdeal_id)->product)->product_price)-(App\product::findOrFail(App\HotDeal::findOrFail($item->hotdeal_id)->product)->product_price)*(App\HotDeal::findOrFail($item->hotdeal_id)->rate)/100;
                                                $tempTotalDis += (App\product::findOrFail(App\HotDeal::findOrFail($item->hotdeal_id)->product)->product_price)*(App\HotDeal::findOrFail($item->hotdeal_id)->rate)/100;
                                                // $totalPrice += (App\product::findOrFail(App\HotDeal::findOrFail($item->hotdeal_id)->product)->product_price)*($item->product_quantity);
                                                $dis +=$tempTotalDis*($item->product_quantity);
                                                $totalPrice += $tempTotal*($item->product_quantity);
                                            @endphp
                                            <td class="product-price"><span class="amount">৳{{ $tempTotal }} </span></td>

                                            <input type="hidden" class="productId" name="productId[]" value="{{App\HotDeal::findOrFail($item->hotdeal_id)->product}}">

                                            <td class="product-quantity">

                                                <input type="number" readonly class="cartQuantity" name="cartQuantity[]" value="{{$item->product_quantity}}" />

                                            </td>

                                                {{-- $totalPrice-(($totalPrice*($dis))/100)  --}}
                                            <td class="product-subtotal">৳{{$tempTotal*($item->product_quantity)}}</td>
                                            <td class="product-remove"> <a href="{{url('deletehotDealCart')}}/{{$item->id}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                        <script>
                                            checkUpdateBtn++;
                                        </script>
                                        </tr>
                                        @empty
                                        No data
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table Content Start -->
                            <div class="row">
                               <!-- Cart Button Start -->
                                <div class="col-md-8 col-sm-12">
                                    <div class="buttons-cart">
                                        {{-- <button type="submit" value="Update Cart" /> --}}
                                        {{-- <button type="submit" class="btn btn-dark">Update Cart</button> --}}
                        </form>


                        <a href="{{url('/')}}">Continue Shopping</a>
                        <a href="{{Route("clearHotDealCart")}}" id="clearCart" class="btn btn-info form-control">Clear Cart</a>
                                    </div>
                                </div>
                                <!-- Cart Button Start -->
                                <!-- Cart Totals Start -->
                                <div class="col-md-4 col-sm-12">
                                    <div class="cart_totals float-md-right text-md-right">
                                        <h2>Cart Totals</h2>
                                        <br />
                                        <table class="float-md-right">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    {{-- <th>Subtotal</th>
                                                    <td><span class="amount">৳{{ $totalPrice }}</span></td> --}}
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th>Shiping</th>
                                                    <td><span class="amount">৳{{ 0 }}</span></td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th>Total Discount </th>
                                                    {{-- <td><span class="amount">৳{{ ($totalPrice*($dis))/100 }}</span></td> --}}
                                                    <td><span class="amount">৳{{ $dis}}</span></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td>
                                                        {{-- <strong><span class="amount">৳{{ $totalPrice-(($totalPrice*($dis))/100) }}</span></strong> --}}
                                                        <strong><span class="amount">৳{{ $totalPrice }}</span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        {{-- <a href="#">Proceed to Checkout</a> --}}
                                        <form action="{{ url('checkOut') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="sub" id="sub" value="{{ $totalPrice }}"> {{--subTotal--}}
                                            <input type="hidden" name="ship" id="ship" value="{{ 0 }}"> {{--shiping amount--}}
                                            {{-- <input type="hidden" name="dis" id="dis" value="{{ ($totalPrice*($percentage))/100 }}"> discount --}}
                                            <input type="hidden" name="dis" id="dis" value="{{ $dis }}"> {{--discount--}}
                                            {{-- <input type="hidden" name="tot" id="tot" value="{{ $totalPrice-(($totalPrice*($percentage))/100) }}"> after discount price is --}}
                                            <input type="hidden" name="tot" id="tot" value="{{ $totalPrice}}">
                                                    <div class="wc-proceed-to-checkout">
                                                        <button name="checkOutBtn" class="btn btn-dark">Proceed to checkout</button>
                                                        {{-- <a href="#" type="submit">Proceed to Checkout</a> --}}
                                                    </div>
                                                </form>
                                    </div>
                                </div>
                                <!-- Cart Totals End -->
                            </div>
                            <!-- Row End -->

                        <!-- Form End -->
                    </div>
                </div>
                 <!-- Row End -->
            </div>
        </div>
        <!-- Cart Main Area End -->













@endsection
