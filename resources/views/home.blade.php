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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard



                <a href="{{__('cart')}}" class="btn btn-info rounded-circle">
                        {{ App\Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->count() }}
                </a>




                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!








                        <div class="container">


                            <table class="table table-bordered table-dark">
                        <thead>
                          <tr>
                            <th scope="col">SR</th>
                            {{-- <th scope="col">user_id</th> --}}
                            <th scope="col">product_name</th>
                            <th scope="col">category</th>
                            <th scope="col">product_price</th>
                            <th scope="col">description</th>
                            <th scope="col">point</th>
                            <th scope="col">approval</th>
                            <th scope="col">approvedby</th>
                            <th scope="col">activation</th>
                            <th scope="col">photo</th>
                            <th scope="col">add cart</th>
                        </tr>
                    </thead>
                    @php
                        $sr = 0;
                    @endphp
                    <tbody>
                        @forelse ($allProduct as $item)
                        @if ($item->approval != 0 && $item->activation != 0)
                        @php
                            $sr++;
                        @endphp
                        <tr>
                        <th>{{$sr}}</th>
                            {{-- <th scope="row">{{App\user::findOrFail($item->user_id)->name}}</th> --}}
                            <td>{{$item->product_name}}</td>
                            <td>{{App\category::findOrFail($item->category)->category_name}}</td>
                            <td>{{$item->product_price}}</td>
                            <td><textarea cols="5" rows="5">{{$item->description}}</textarea></td>
                            <td>{{$item->point}}</td>
                            <td>{{$item->approval}}</td>
                            <td>{{$item->approvedby}}</td>
                            <td>{{$item->activation}}</td>
                            <td><img src=" {{asset('uploads/product')}}/{{$item->photo}} " alt="no image" width="50px"></td>
                            <td><a class="btn btn-success" href="{{__('add/to/cart')}}/{{$item->id}}">add to cart</a></td>
                        </tr>
                        @endif
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>











                </div>
            </div>
        </div>
    </div>
</div>
@endsection
