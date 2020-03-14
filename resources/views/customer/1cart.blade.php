@extends('layouts.front_app')

@section('allContentHere')










                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                @php
                    $totalPrice =0;
                @endphp




                <div class="container">


                            <table class="table table-bordered table-dark">
                        <thead>
                          <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Quantiry</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                            var checkUpdateBtn = 0;
                        </script>
                        <form action="{{Route('updateCart')}}" method="post">
                            @csrf
                        @forelse ($all_my_carts as $item)
                        <tr>
                            <th scope="row">{{App\product::findOrFail($item->product_id)->product_name}}</th>
                            <td>{{App\product::findOrFail($item->product_id)->product_price}}</td>
                            @php
                                $totalPrice += (App\product::findOrFail($item->product_id)->product_price)*($item->product_quantity);
                            @endphp
                            <td><img src="{{asset('uploads/product')}}/{{App\product::findOrFail($item->product_id)->photo}}" alt="no photo" width="50px"></td>
                            <input type="hidden" class="productId" name="productId[]" value="{{$item->product_id}}">
                            <td><input type="number" class="cartQuantity" name="cartQuantity[]" value="{{$item->product_quantity}}"></td>
                            <td>{{(App\product::findOrFail($item->product_id)->product_price)*($item->product_quantity)}}</td>
                            <td><a class="btn btn-danger" href="{{url('deleteCart')}}/{{$item->id}}">Remove</a></td>
                            <script>
                                checkUpdateBtn++;
                            </script>
                        </tr>
                        @empty
                        No data
                        @endforelse
                    </tbody>
                </table>
                                <tr>
                                    <button id="updateBtn" type="submit" class="form-control btn btn-success">Update Cart</button>
                                </tr>
                            </form>
                </div>

                <div class="input-group">
                        <h3 type="text" class="form-control text-center">Total Amount : </h3>
                        <h3 type="text" class="form-control text-center">{{$totalPrice}}</h3>
                </div><br>
                <div class="input-group">
                    <div>
                        <a href="{{Route("clearCart")}}" id="clearCart" class="btn btn-info form-control">Clear Cart</a>
                    </div>
                    <div>
                        <form action="{{ url('checkOut') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sub" id="sub" value="{{ $totalPrice }}"> {{--subTotal--}}
                                <input type="hidden" name="ship" id="ship" value="{{ 0 }}"> {{--shiping amount--}}
                                {{-- <input type="hidden" name="dis" id="dis" value="{{ ($totalPrice*($percentage))/100 }}"> discount --}}
                                <input type="hidden" name="dis" id="dis" value="{{ ($totalPrice*(0))/100 }}"> {{--discount--}}
                                {{-- <input type="hidden" name="tot" id="tot" value="{{ $totalPrice-(($totalPrice*($percentage))/100) }}"> after discount price is --}}
                                <input type="hidden" name="tot" id="tot" value="{{ $totalPrice-(($totalPrice*(0))/100) }}">
                                <button name="checkOutBtn" class="btn btn-dark form-control">Proceed to checkout</button>
                        </form>
                    </div>
                </div>








                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addNewScript')
    <script>
        $(document).ready(function () {

            if (checkUpdateBtn == 0) {
                document.getElementById("updateBtn").disabled = true;
                // document.getElementById("clearCart").disabled = true;
            }
            function updateValidation(e) {
                if (e.target.value <=0) {
                    // alert("quantity must be minimum 1");
                    // e.target.value = 1;
                    e.target.style.border = "2px solid red";
                    document.getElementById("updateBtn").disabled = true;
                }
                else{
                    e.target.style.border = "none";
                    document.getElementById("updateBtn").disabled = false;
                }
            }


            $('.cartQuantity').keyup(function (e) {
                updateValidation(e);
            });

            $('.cartQuantity').change(function (e) {
                updateValidation(e);
            });
        });
    </script>












@endsection
