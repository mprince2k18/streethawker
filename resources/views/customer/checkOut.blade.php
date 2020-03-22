@extends('layouts.front_app')
{{-- @section('sliderOrLogin') --}}
@section('allContentHere')




    {{-- {{error_reporting(0)}} --}}






        <!-- Breadcrumb Start -->
        <div class="breadcrumb-area mt-30">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="d-flex align-items-center">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><a href="{{url('checkOut')}}">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Breadcrumb End -->
        <!-- coupon-area start -->
        <div class="coupon-area pt-100 pt-sm-60">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="coupon-accordion">
                            <!-- ACCORDION START -->
                            @guest

                            <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                            <div id="checkout-login" class="coupon-content">
                                <div class="coupon-info">
                                    <p class="coupon-text">Please login with ouer E-mail & password</p>
                                     <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" required autocomplete="email" autofocus type="text" name="email" value="{{ old('email') }}" placeholder="Enter your email address..." id="input-email" class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input id="password"  type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                                @if (Route::has('password.request'))
                                                    <p class="lost-password">
                                                    <a href="{{ route('password.request') }}">
                                                        {{ __('Forgot Password?') }}
                                                    </a>
                                                    </p>
                                                @endif
                                            <input type="submit" value="Login" class="btn" style="background:red">
                                    </form>
                                </div>
                            </div>
                            @endguest
                            <!-- ACCORDION END -->
                            <!-- ACCORDION START -->
                            {{-- <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form action="{{ route('applyCoupon') }}" method="post">
                                        <p class="checkout-coupon">
                                            @csrf
                                            <input type="text" class="code" placeholder="Coupon code" />
                                            <input type="submit" value="Apply Coupon" />
                                        </p>
                                    </form>
                                </div>
                            </div> --}}
                            <!-- ACCORDION END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- coupon-area end -->
        <!-- checkout-area start -->
        <div class="checkout-area pb-100 pt-15 pb-sm-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">

                        <div class="checkbox-form mb-sm-40">
                            <h3>Billing Details</h3>
    {{--....................start checkout  --}}
                            <form action="{{route('checkOutBillingDetails')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="country-select clearfix mb-30">
                                        <label>Country <span class="required">*</span></label>
                                        <select class="wide" id="country" name="country_id">
                                            <option  value="0">select One *</option>
                                            @foreach ($allCounry as $item)
                                            <option  value="{{ $item->id }}">{{$item->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="country-select clearfix mb-30">
                                        <label>City <span class="required">*</span></label>
                                        <div id="pu"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list mb-sm-30">
                                        <label>First Name <span class="required">*</span></label>
                                        <input class="myvalidJS" type="text" name="userName" placeholder="First Name" value="{{Auth::user()->name}}" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list mb-30">
                                        <label>Company Name</label>
                                        <input class="myvalidJS" type="text" name="companyName" placeholder="Company Name" value="{{Auth::user()->company_or_industry}}" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input class="myvalidJS" type="text" placeholder="Street address" name="address" value="{{$customerInfo->address}}" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list mb-30">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input class="myvalidJS" type="text" name="zip" value="{{$customerInfo->zip}}" placeholder="Postcode / Zip" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input class="myvalidJS" name="email" value="{{Auth::user()->email}}" type="email" placeholder="Address" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                        <label>Phone  <span class="required">*</span></label>
                                        <input class="myvalidJS" type="text" name="phone" value="{{$customerInfo->phone}}" placeholder="Phone" />
                                    </div>
                                </div>
                                @guest
                                <div class="col-md-12">
                                    <div class="checkout-form-list create-acc mb-30">
                                        <input id="cbox" type="checkbox" />
                                        <label for="cbox">Create an account?</label>
                                    </div>
                                    <div id="cbox_info" class="checkout-form-list create-accounts mb-25">
                                        <p class="mb-10">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                        <label>Account password  <span class="required">*</span></label>
                                        <input type="password" placeholder="password" />
                                    </div>
                                </div>
                                @endguest
                                <div class="col-md-12">
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Order Notes</label>
                                        <textarea class="myvalidJS" name="orderNote" id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12">
                                <div class="order-notes">

                                    <div class="payment-method">
                                        <div class="form-check payment-method">
                                                <label class="toggle">
                                                    <input type="radio" name="paymentType" checked id="one" value="1"> <span class="label-text">Cash on delievery</span>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="toggle">
                                                    <input type="radio" name="paymentType" id="two" value="2"> <span class="label-text">Credit card</span>
                                                </label>
                                        </div>
                                    </div>

                                </div>
                                </div>
                                <div>
                                    <input type="hidden" name="dis" value="{{$dis}}">
                                    <input type="hidden" name="ship" value="{{$ship}}">
                                    <input type="hidden" name="sub" value="{{$sub}}">
                                    <input type="hidden" name="tot" value="{{$tot}}">
                                </div>
                                <div class="col-md-12">
                                    <button id="placeBtn" type="submit" class="btn btn-danger" type="">Checkout Now</button>
                                </div>
                            </div>
                            </form>
    {{-- ..................end checkout --}}

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                               Discount <span class="product-quantity"> </span>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount">৳{{$dis}}</span>
                                            </td>
                                        </tr>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                Ship<span class="product-quantity"> </span>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount">৳{{$ship}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">৳{{$sub}}</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order TotalDiscount</th>
                                            <td><span class=" total amount">৳{{$tot}}</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingone">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  Direct Bank Transfer
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingone" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingtwo">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          Cheque Payment
                                        </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingthree">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                          PayPal
                                        </button>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
                                            <div class="card-body">
                                                 <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->


@section('addNewScript')
    <script>
            $(document).ready(function () {
                checkValidation();
                let allField = document.querySelectorAll('.myvalidJS');
                // thisValidate();
            $('#country').change(function () {
                var country_id=$(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                type:'POST',
                url:'/getCityName',
                data: {country_id: country_id},
                    success: function (data) {
                        // $( "#company_upazilla" ).html(data);
                        // alert(data);

                        document.querySelector('#pu').innerHTML=`
                            <select class="form-control" id="city" name="city_id">
                            ${data}
                            </select>
                        `;
                        checkValidation();
                        thisValidate();
                    }
                });
            });

            function checkValidation() {
                // if ($('#country').val() == '0' || $('#city').val() == 'City/Town *' || $('#country').val() == null || $('#city').val() == null) {
                if ($('#country').val() == '0' || $('#country').val() == null) {
                    document.getElementById('placeBtn').disabled = true;
                }
                else{
                    document.getElementById('placeBtn').disabled = false;
                }
            }
            $('.myvalidJS').keyup(function () {
                thisValidate();
            });

            function thisValidate() {
                allField.forEach(function (e) {
                    if (e.value == 0 || e.value == null || e.value == ' ') {
                        document.getElementById('placeBtn').disabled = true;
                    }
                    else{
                        document.getElementById('placeBtn').disabled = false;
                    }
                });
            }



        });
    </script>
@endsection






@endsection
