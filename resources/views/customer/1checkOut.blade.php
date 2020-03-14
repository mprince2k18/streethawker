@extends('layouts.app')
<style>
    @import url(https://fonts.googleapis.com/css?family=Raleway);

*, *:before, *:after{
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing:border-box;
  box-sizing: border-box;
}

body{
  background: #f9f9f9;
  font-size: 16px;
  font-family: 'Raleway', sans-serif;
}

.main-title{
  color: #2d2d2d;
  text-align: center;
  text-transform: capitalize;
  padding: 0.7em 0;
}

.container{
  padding: 1em 0;
  float: left;
  width: 50%;
}
@media screen and (max-width: 640px){
  .container{
    display: block;
    width: 100%;
  }
}

@media screen and (min-width: 900px){
  .container{
    width: 33.33333%;
  }
}

.container .title{
  color: #1a1a1a;
  text-align: center;
  margin-bottom: 10px;
}

.content {
  position: relative;
  width: 90%;
  max-width: 400px;
  margin: auto;
  overflow: hidden;
}

.content .content-overlay {
  background: rgba(0,0,0,0.7);
  position: absolute;
  height: 99%;
  width: 100%;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  opacity: 0;
  -webkit-transition: all 0.4s ease-in-out 0s;
  -moz-transition: all 0.4s ease-in-out 0s;
  transition: all 0.4s ease-in-out 0s;
}

.content:hover .content-overlay{
  opacity: 1;
}

.content-image{
  width: 100%;
}

.content-details {
  position: absolute;
  text-align: center;
  padding-left: 1em;
  padding-right: 1em;
  width: 100%;
  top: 50%;
  left: 50%;
  opacity: 0;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  -webkit-transition: all 0.3s ease-in-out 0s;
  -moz-transition: all 0.3s ease-in-out 0s;
  transition: all 0.3s ease-in-out 0s;
}

.content:hover .content-details{
  top: 50%;
  left: 50%;
  opacity: 1;
}

.content-details h3{
  color: #fff;
  font-weight: 500;
  letter-spacing: 0.15em;
  margin-bottom: 0.5em;
  text-transform: uppercase;
}

.content-details p{
  color: #fff;
  font-size: 0.8em;
}

.fadeIn-bottom{
  top: 80%;
}

.fadeIn-top{
  top: 20%;
}

.fadeIn-left{
  left: 20%;
}

.fadeIn-right{
  left: 80%;
}
</style>
@section('content')

	<!-- Page -->
	<div class="page-area cart-page spad">
		<div class="container">
            <form class="checkout-form" action="{{Route('placeOrder')}}" method="POST">
                @csrf
				<div class="row">
					<div class="col-lg-6">
						<h4 class="checkout-title">Billing Address / Shiping Address</h4>
						<div class="row">
							<div class="col-md-12">
								<input class="form-control" name="customer_name" type="text" placeholder="Name *" value="{{ Auth::user()->name }}">
							</div>
							<div class="col-md-12">
								<input class="form-control" name="company" type="text" placeholder="Company *" value="Xubisoft">
                                <input class="form-control" name="address" type="text" placeholder="Address *" value="House-19 Road-1, Dhaka 1230">
                                <input class="form-control" name="zip_code" type="text" placeholder="Zipcode *" value="1203">
								<select class="form-control" id="country" name="country_id">
                                    <option>Country *</option>
                                    @foreach ($allCounry as $item)
                                    <option class="form-control" value="{{ $item->id }}">{{$item->name}}</option>
                                    @endforeach
								</select>
								<select class="form-control" id="city" name="city_id">
									<option class="form-control">City/Town *</option>
								</select>
								<input class="form-control" name="customer_phone" type="text" placeholder="Phone no *" value="01755681741">
                            <input class="form-control" name="customer_email" type="email" placeholder="Email Address *" value="{{Auth::user()->email}}">



							</div>
						</div>
					</div>

                    <div class="col-lg-6">
						<div class="order-card">
							<div class="order-details">
								<div class="od-warp">
									<h4 class="checkout-title">Your order</h4>
									<table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Discount</td>
                                                    <td>${{ $dis }}</td>
                                                    <input type="hidden" name="discount" value="{{ $dis }}">
                                                </tr>
                                                <tr>
                                                    <td>SubTotal</td>
                                                    <td>${{ $sub }}</td>
                                                    <input type="hidden" name="subtotal" value="{{ $sub }}">
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <td>Shipping</td>
                                                    <td>${{ $ship }}</td>
                                                    <input type="hidden" name="shipping" value="{{ $ship }}">
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <th>${{ $tot }}</th>
                                                    <input type="hidden" name="total_amount" value="{{ $tot }}">
                                                </tr>
                                            </tfoot>
                                        </table>
								</div>
								<div class="payment-method">

                                    <div class="form-check payment-method">
                                            <label class="toggle">
                                                <input type="radio" name="toggle" checked id="one" value="1"> <span class="label-text">Cash on delievery</span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="toggle">
                                                <input type="radio" name="toggle" id="two" value="2"> <span class="label-text">Credit card</span>
                                            </label>
                                    </div>


								</div>
							</div>
							<button id="placeBtn" type="submit" class="btn btn-info">Place Order</button>
						</div>
                    </div>
				</div>
			</form>
		</div>
	</div>
	<!-- Page -->

@section('addCss')
    <style>
            @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

            body{
                padding: 50px;
            }

            label{
                position: relative;
                cursor: pointer;
                color: #666;
                /* font-size: 30px; */
            }

            input[type="checkbox"], input[type="radio"]{
                position: absolute;
                right: 9000px;
            }

            /*Check box*/
            input[type="checkbox"] + .label-text:before{
                content: "\f096";
                font-family: "FontAwesome";
                speak: none;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height: 1;
                -webkit-font-smoothing:antialiased;
                width: 1em;
                display: inline-block;
                margin-right: 5px;
            }

            input[type="checkbox"]:checked + .label-text:before{
                content: "\f14a";
                color: #2980b9;
                animation: effect 250ms ease-in;
            }

            input[type="checkbox"]:disabled + .label-text{
                color: #aaa;
            }

            input[type="checkbox"]:disabled + .label-text:before{
                content: "\f0c8";
                color: #ccc;
            }

            /*Radio box*/

            input[type="radio"] + .label-text:before{
                content: "\f10c";
                font-family: "FontAwesome";
                speak: none;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height: 1;
                -webkit-font-smoothing:antialiased;
                width: 1em;
                display: inline-block;
                margin-right: 5px;
            }

            input[type="radio"]:checked + .label-text:before{
                content: "\f192";
                color: #8e44ad;
                animation: effect 250ms ease-in;
            }

            input[type="radio"]:disabled + .label-text{
                color: #aaa;
            }

            input[type="radio"]:disabled + .label-text:before{
                content: "\f111";
                color: #ccc;
            }

            /*Radio Toggle*/

            .toggle input[type="radio"] + .label-text:before{
                content: "\f204";
                font-family: "FontAwesome";
                speak: none;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height: 1;
                -webkit-font-smoothing:antialiased;
                width: 1em;
                display: inline-block;
                margin-right: 10px;
            }

            .toggle input[type="radio"]:checked + .label-text:before{
                content: "\f205";
                color: #16a085;
                animation: effect 250ms ease-in;
            }

            .toggle input[type="radio"]:disabled + .label-text{
                color: #aaa;
            }

            .toggle input[type="radio"]:disabled + .label-text:before{
                content: "\f204";
                color: #ccc;
            }


            @keyframes effect{
                0%{transform: scale(0);}
                25%{transform: scale(1.3);}
                75%{transform: scale(1.4);}
                100%{transform: scale(1);}
            }
    </style>
@endsection
@section('addNewScript')
    <script>
            $(document).ready(function () {
                checkValidation();
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
                        document.getElementById('city').innerHTML=data;
                        checkValidation();
                    }
                });
            });

            function checkValidation() {
                if ($('#country').val() == 'Country *' || $('#city').val() == 'City/Town *' || $('#country').val() == null || $('#city').val() == null) {
                    document.getElementById('placeBtn').disabled = true;
                }
                else{
                    document.getElementById('placeBtn').disabled = false;
                }
            }
        });
    </script>
@endsection

@endsection
